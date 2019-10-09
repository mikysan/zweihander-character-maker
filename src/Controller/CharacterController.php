<?php

namespace App\Controller;

use App\Entity\Character;
use App\Service\CharacterService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Cache\Adapter\AdapterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\ServiceUnavailableHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Cache\ItemInterface;

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
        $tokenGenerator = function () {
            return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
                // 32 bits for "time_low"
                mt_rand(0, 0xffff), mt_rand(0, 0xffff),

                // 16 bits for "time_mid"
                mt_rand(0, 0xffff),

                // 16 bits for "time_hi_and_version",
                // four most significant bits holds version number 4
                mt_rand(0, 0x0fff) | 0x4000,

                // 16 bits, 8 bits for "clk_seq_hi_res",
                // 8 bits for "clk_seq_low",
                // two most significant bits holds zero and one for variant DCE1.1
                mt_rand(0, 0x3fff) | 0x8000,

                // 48 bits for "node"
                mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
            );
        };

        // We actually use cache as temp storage
        $cToken = $tokenGenerator();
        $newCharacter = $cache->get('c_'.$tokenGenerator(), function (ItemInterface $item) use ($characterService, $request) {
            $item->expiresAfter(86400); //expires after 1 day.

            return $characterService->rollNew(
                $request->query->has('roll-drawback'),
                $request->query->has('roll-ancestry'),
                $request->query->has('unlink-alignment')
            );
        });

        return $this->json($newCharacter, Response::HTTP_OK, ['X-Character-Token' => $cToken], ['groups' => ['view']]);
    }

    /**
     * @Route("/save", name="_save", methods={"POST"})
     */
    public function save(Request $request, AdapterInterface $cache, EntityManagerInterface $entityManager)
    {
        if (!$request->headers->has('X-Character-Token')) {
            throw new BadRequestHttpException('Missing required HTTP Header: X-Character-Token.');
        }

        $cToken = 'c_'.$request->headers->get('X-Character-Token');
        if (!$cache->hasItem($cToken)) {
            throw new NotFoundHttpException();
        }
        $character = $cache->get($cToken, function () {
            throw new ServiceUnavailableHttpException();
        });

        if (!$character instanceof Character) {
            throw new ServiceUnavailableHttpException();
        }

        $newCharacterName = $request->request->get('name', null);
        if (null === $newCharacterName) {
            throw new BadRequestHttpException('Name is mandatory.');
        }
        $character->setName($newCharacterName);

        //todo handle mercy rule
        $entityManager->persist($character);
        $entityManager->flush();
        $cache->deleteItem($cToken);

        return $this->json($character, Response::HTTP_CREATED);
    }

    /**
     * Action that allow client preflight.
     * todo: handle prflights with listner maybe?
     *
     * @Route("/save", name="_save_preflight", methods={"OPTIONS"})
     */
    public function savePreflight()
    {
        return new Response(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * @Route("/{id}", name="_show", methods={"GET"})
     */
    public function show(Character $character)
    {
        return $this->json($character, Response::HTTP_OK, [], ['groups' => ['view']]);
    }
}
