<?php

namespace App\Controller;

use App\Manager\UserManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\NativePasswordHasher;
use Symfony\Component\Routing\Attribute\Route;
use App\Manager\ConnexionManager;
use Symfony\Component\HttpFoundation\Request;

class ConnexionController extends AbstractController
{
    public function __construct(
        private UserManager $user_manager,
    ) { }

    #[Route('/connexion', name: 'app_connexion')]
    public function index(): Response
    {
        return $this->render('connexion/index.html.twig');
    }

    #[Route('/connected', name: 'app_connected')]
    public function connected(Request $request, NativePasswordHasher $password_hasher): Response
    {
        $identite = $request->get('identite-pourf');
        $pswd = $request->get('pswd-pourf');

        $user = $this->user_manager->findUser($identite);

        if (!$user) {
            return $this->render('connexion/index.html.twig', [
                'error' => 'Utilisateur non trouvé',
            ]);
        }

        if ($password_hasher->verify($user['pswd_user'], $pswd)) {
            return $this->render('home/index.html.twig', [
                'user' => $user,
            ]);
        } else {
            return $this->render('connexion/index.html.twig', [
                'error' => 'Mot de passe incorrect',
            ]);
        }
    }
}
