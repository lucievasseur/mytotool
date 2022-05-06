<?php

namespace App\Controller;

use App\Repository\UtilisateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'login')]
    public function index(Request $request, UtilisateurRepository $utilisateurRepository, SessionInterface $session): Response
    {
        if($session->get('utilisateur')) {
            return $this->redirectToRoute('home');
        }

        if($request->isMethod('post')) {
            $identifiant = $request->request->get('identifiant');
            $utilisateur = $utilisateurRepository->findOneby(['identifiant' => $identifiant]);

            if($utilisateur != null) {
                //On enregistre les informations de l'utilisateur dans la session
                $session->set('utilisateur', $utilisateur);
                //On redirige vers la page d'accueil
                return $this->redirectToRoute('home');
            }

            $this->addFlash('error', 'identifiant incorrect');
        }

        return $this->render('login/index.html.twig', [
            'controller_name' => 'LoginController',
        ]);
    }

    #[Route('/logout', name: 'logout')]
    public function logout(SessionInterface $session): Response
    {
        $session->clear();
        return $this->redirectToRoute('login');
    }

}
