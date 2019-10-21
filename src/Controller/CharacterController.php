<?php

namespace App\Controller;

use App\Entity\Character;
use App\Service\CharacterService;
use Ramsey\Uuid\Uuid;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Cache\Adapter\AdapterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CharacterController.
 *
 * @Route("/characters", name="character")
 */
class CharacterController extends AbstractController
{
    /**
     * @Route("/", name="_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager)
    {
        return $this->json($entityManager->getRepository(Character::class)->findAll(), Response::HTTP_OK, [], [
            'groups' => ['index'],
        ]);
    }

    /**
     * @Route("/roll-new", name="_roll_new", methods={"GET"})
     */
    public function rollNew(CharacterService $characterService, Request $request, AdapterInterface $cache)
    {
        // We actually use cache as temp storage
        $cToken = Uuid::uuid4();
        $newCharacter = $characterService->rollNew(
            $request->query->has('roll-drawback'),
            $request->query->has('roll-ancestry'),
            $request->query->has('unlink-alignment')
        );

        $newCharacterCacheItem = $cache->getItem('c_'.$cToken->toString());

        if (!$newCharacterCacheItem->isHit()) {
            $newCharacterCacheItem->set($newCharacter->dumpFactoryArguments());
            $newCharacterCacheItem->expiresAfter(86400);
            $cache->save($newCharacterCacheItem);
        }

        return $this->json($newCharacter, Response::HTTP_OK, ['X-Character-Token' => $cToken->toString()], ['groups' => ['view']]);
    }

    /**
     * @Route("/save", name="_save", methods={"POST", "OPTIONS"})
     */
    public function save(Request $request, AdapterInterface $cache, EntityManagerInterface $entityManager)
    {
        if (!$request->headers->has('X-Character-Token')) {
            throw new BadRequestHttpException('Missing required HTTP Header: X-Character-Token.');
        }

        $cToken = $request->headers->get('X-Character-Token');
        if (null === $cToken || is_array($cToken)) {
            throw new BadRequestHttpException('Required HTTP Header "X-Character-Token" must be sent only once.');
        }
        $newCharacterCacheItem = $cache->getItem('c_'.$cToken);

        if (!$newCharacterCacheItem->isHit()) {
            throw new NotFoundHttpException();
        }

        $character = Character::createByReferenceArray($newCharacterCacheItem->get(), $entityManager);
        if (!$character instanceof Character) {
            throw new NotFoundHttpException();
        }

        $payload = json_decode((string) $request->getContent(), true);
        $newCharacterName = $payload['name'] ?? null;
        if (null === $newCharacterName) {
            throw new BadRequestHttpException('Name is mandatory.');
        }
        $character->setName($newCharacterName);

        //todo handle mercy rule
        $entityManager->persist($character);
        $entityManager->flush();

        return $this->json($character, Response::HTTP_CREATED, [], ['groups' => ['view']]);
    }

    /**
     * @Route("/{id}", name="_show", methods={"GET"})
     */
    public function show(Character $character)
    {
        return $this->json($character, Response::HTTP_OK, [], ['groups' => ['view']]);
    }
}
