<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Manager\ConnexionManager;

class ConnexionController extends AbstractController
{
    public function __construct(
        private ConnexionManager $connexionManager,
    ) { }

    #[Route('/connexion', name: 'app_connexion')]
    public function index(): Response
    {
        return $this->render('connexion/index.html.twig',[
            'test' => $this->connexionManager->test(),
        ]);
    }
}
