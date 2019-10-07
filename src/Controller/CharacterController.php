<?php

namespace App\Controller;

use App\Entity\Character;
use App\Form\CharacterType;
use App\Service\CharacterService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\ServiceUnavailableHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CharacterController
 * @package App\Controller
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
    public function rollNew(CharacterService $characterService, Request $request, Session $session)
    {
        $newCharacter = $characterService->rollNew(
            $request->query->has('roll-drawback'),
            $request->query->has('roll-ancestry'),
            $request->query->has('unlink-alignment')
        );

        $cToken = uniqid();
        $session->set($cToken, $newCharacter);

        return $this->json($newCharacter, Response::HTTP_OK, ['X-Character-Token' => $cToken], ['groups' => ['view']]);
    }

    /**
     * @Route("/save", name="_save", methods={"POST"})
     */
    public function save(Request $request, Session $session, EntityManagerInterface $entityManager)
    {
        if (!$request->headers->has('X-Character-Token')) {
            throw new BadRequestHttpException('Missing required HTTP Header: X-Character-Token.');
        }

        $cToken = $request->headers->get('X-Character-Token');
        if (!$session->has($cToken)) {
            throw new NotFoundHttpException();
        }

        $character = $session->get($cToken);
        if (!$character instanceof Character) {
            throw new ServiceUnavailableHttpException();
        }

        $newCharacterName = $request->request->get('name', null);
        if (null === $newCharacterName) {
            throw new BadRequestHttpException('Name is mandatory.');
        }

        //todo handle mercy rule
        $entityManager->persist($character);
        $entityManager->flush();

        return $this->json($character, Response::HTTP_CREATED);
    }

    /**
     * Action that allow client preflight.
     * todo: handle prflights with listner maybe?
     * @Route("/save", name="_save_preflight", methods={"OPTIONS"})
     */
    public function savePreflight()
    {
        return new Response(NULL, Response::HTTP_NO_CONTENT);
    }

    /**
     * @Route("/{id}", name="_show", methods={"GET"})
     */
    public function show(Character $character)
    {
        return $this->json($character, Response::HTTP_OK, [], ['groups' => ['view']]);
    }
}
