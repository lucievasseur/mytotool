<?php

namespace App\Controller;

use App\Entity\Tache;
use App\Repository\ListeTachesRepository;
use App\Repository\UtilisateurRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class TaskController extends AbstractController
{
    #[Route('/task', name: 'create_task', methods: ['POST'])]
    public function create(Request $request, ManagerRegistry $registry, SessionInterface $session, ListeTachesRepository $listeTachesRepository, UtilisateurRepository $utilisateurRepository): JsonResponse
    {
        if (!$request->request->get('nom') && !$request->request->get('listId') ) {
            return new JsonResponse(['error' => 'Veuillez renseigner un nom'], Response::HTTP_BAD_REQUEST);
        }

        $task = new Tache();
        $task->setTitre($request->request->get('nom'));
        $task->setListeTache($listeTachesRepository->find($request->request->get('listId')));

        $entityManager = $registry->getManager();
        $entityManager->persist($task);
        $entityManager->flush();

        return new JsonResponse(['message' => 'Task created'], Response::HTTP_CREATED);

    }

    #[Route('/task', name: 'update_task', methods: ['PATCH'])]
    public function update(Request $request, ManagerRegistry $registry, SessionInterface $session, ListeTachesRepository $listeTachesRepository, UtilisateurRepository $utilisateurRepository): JsonResponse
    {
        if (!$request->request->get('nom') && !$request->request->get('listId') ) {
            return new JsonResponse(['error' => 'Veuillez renseigner un nom'], Response::HTTP_BAD_REQUEST);
        }

        $task = new Tache();
        $task->setTitre($request->request->get('nom'));
        $task->setListeTache($listeTachesRepository->find($request->request->get('listId')));

        $entityManager = $registry->getManager();
        $entityManager->persist($task);
        $entityManager->flush();

        return new JsonResponse(['message' => 'Task created'], Response::HTTP_CREATED);

    }

    #[Route('/task', name: 'delete_task', methods: ['DELETE'])]
    public function delete(Request $request, ManagerRegistry $registry, SessionInterface $session, ListeTachesRepository $listeTachesRepository, UtilisateurRepository $utilisateurRepository): JsonResponse
    {
        if (!$request->request->get('nom') && !$request->request->get('listId') ) {
            return new JsonResponse(['error' => 'Veuillez renseigner un nom'], Response::HTTP_BAD_REQUEST);
        }

        $task = new Tache();
        $task->setTitre($request->request->get('nom'));
        $task->setListeTache($listeTachesRepository->find($request->request->get('listId')));

        $entityManager = $registry->getManager();
        $entityManager->remove($task);
        $entityManager->flush();

        return new JsonResponse(['message' => 'Task created'], Response::HTTP_CREATED);

    }
}

