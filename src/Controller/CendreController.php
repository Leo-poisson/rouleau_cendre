<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\ExpressionLanguage\Expression;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class CendreController extends AbstractController
{
    #[IsGranted(new Expression('
        (is_granted("ROLE_FACTION_1") 
        and is_granted("ROLE_CENDRE MORTUAIRE")) 
        or is_granted("ROLE_LUNE INF")
        or is_granted("ROLE_LUNE SUP")
    '))]
    #[Route('/cendre', name: 'app_cendre')]
    public function index(): Response
    {
        return $this->render('cendre/index.html.twig', [
            'controller_name' => 'CendreController',
        ]);
    }
}
