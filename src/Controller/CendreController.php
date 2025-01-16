<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\ExpressionLanguage\Expression;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted(new Expression('
    (is_granted("ROLE_FACTION_1") 
    and is_granted("ROLE_CENDRE MORTUAIRE")) 
    or is_granted("ROLE_LUNE INF")
    or is_granted("ROLE_LUNE SUP")
'))]
#[Route('/cendre-mortuaire')]
class CendreController extends AbstractController
{
    #[Route('/informations-generales', name: 'app_cendre_informations_generales')]
    public function InformationsGenerales(): Response
    {
        return $this->render('cendre/informations_generales.html.twig');
    }

    #[Route('/generation-cendres', name: 'app_cendre_generation_cendres')]
    public function GenerationCendres(): Response
    {
        return $this->render('cendre/generation_cendres.html.twig');
    }

    #[Route('/manipulation&controle', name: 'app_cendre_manipulation_controle')]
    public function ManipulationControle(): Response
    {
        return $this->render('cendre/manipulation_controle.html.twig');
    }

    #[Route('/capacites', name: 'app_cendre_capacites')]
    public function Capacites(): Response
    {
        return $this->render('cendre/capacites.html.twig');
    }

    #[Route('/aspect-psychologique', name: 'app_cendre_aspect_psychologique')]
    public function AspectPsychologique(): Response
    {
        return $this->render('cendre/aspect_psychologique.html.twig');
    }

    #[Route('/code', name: 'app_cendre_code')]
    public function Code(): Response
    {
        return $this->render('cendre/code.html.twig');
    }

    #[Route('/connaissances', name: 'app_cendre_connaissances')]
    public function Connaissances(): Response
    {
        return $this->render('cendre/connaissances.html.twig');
    }
}
