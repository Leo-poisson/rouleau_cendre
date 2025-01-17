<?php

namespace App\Controller;

use App\Manager\UserManager;
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
    public function __construct(
        private UserManager $user_manager,
    ) {  }

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

    #[Route('/rituel-engendrement', name: 'app_cendre_rituel_engendrement')]
    public function RituelEngendrement(): Response
    {
        return $this->render('cendre/rituel_engendrement.html.twig');
    }

    #[Route('/principes-cloitre', name: 'app_cendre_principes_cloitre')]
    public function PrincipesCloitre(): Response
    {
        return $this->render('cendre/principes_cloitre.html.twig');
    }

    #[Route('/rite-retour-origines', name: 'app_cendre_rite_retour_origines')]
    public function RiteRetourOrigines(): Response
    {
        return $this->render('cendre/rite_retour_origines.html.twig');
    }

    #[Route('/nuit-cendrée', name: 'app_cendre_nuit_cendree')]
    public function NuitCendree(): Response
    {
        return $this->render('cendre/nuit_cendree.html.twig');
    }

    #[Route('/effectif', name: 'app_cendre_effectif')]
    public function Effectif(): Response
    {;
        return $this->render('cendre/effectif.html.twig', [
            'members' => $this->user_manager->GetMembers(1, 'Cendre Mortuaire'),
        ]);
    }
}
