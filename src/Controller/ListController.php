<?php

namespace App\Controller;

use App\Entity\ListeTaches;
use App\Repository\ListeTachesRepository;
use App\Repository\UtilisateurRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class ListController extends AbstractController
{
    #[Route('/list', name: 'create_list', methods: ['POST'])]
    public function create(Request $request, ManagerRegistry $registry, SessionInterface $session, UtilisateurRepository $utilisateurRepository): JsonResponse
    {
        if (!$request->request->get('nom')) {
            return new JsonResponse(['error' => 'Veuillez renseigner un nom'], Response::HTTP_BAD_REQUEST);
        }

        $list = new ListeTaches();
        $list->setNom($request->request->get('nom'));
        $list->setUtilisateur($utilisateurRepository->find($session->get('utilisateur')->getId()));

        $entityManager = $registry->getManager();
        $entityManager->persist($list);
        $entityManager->flush();

        return new JsonResponse(['id' => $list->getId()], Response::HTTP_CREATED);

    }

    #[Route('/list/{listId}', name: 'afficher_tache')]
    public function listDetail(?string $listId, SessionInterface $session, ListeTachesRepository $listeTachesRepository): Response
    {

        $listeTaches = $listeTachesRepository->findBy(['utilisateur' => $session->get('utilisateur')]);
        $list = $listeTachesRepository->find($listId);


        return $this->render('list/index.html.twig', [
            'controller_name' => 'ListController',
            'user' => $session->get('utilisateur'),
            'listeTaches' => $listeTaches,
            'listeDetails' => $list,
        ]);
    }
}

