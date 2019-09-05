<?php

namespace App\Controller;

use App\Entity\Character;
use App\Service\CharacterService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CharacterController
 * @package App\Controller
 * @Route("/character", name="character")
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
    public function rollNew(CharacterService $characterService, Request $request)
    {
        return $this->json($characterService->rollNew(
            $request->query->has('roll-drawback'),
            $request->query->has('roll-ancestry'),
            $request->query->has('unlink-alignment')
        ), Response::HTTP_OK, [], ['groups' => ['view']]);
    }

    /**
     * @Route("/save", name="_save", methods={"POST"})
     */
    public function save()
    {
        //todo form etc
    }

    /**
     * @Route("/{id}", name="_show", methods={"GET"})
     */
    public function show(Character $character)
    {
        return $this->json($character, Response::HTTP_OK, [], ['groups' => ['view']]);
    }
}
