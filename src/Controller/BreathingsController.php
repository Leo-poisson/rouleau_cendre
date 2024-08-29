<?php

namespace App\Controller;

use App\Manager\GradeManager;
use App\Manager\InscriptionManager;
use App\Manager\SouffleManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BreathingsController extends AbstractController
{
    public function __construct(
        private SouffleManager $souffle_manager,
        private GradeManager $grade_manager,
    ) { }

    #[Route('/breathings', name: 'app_breathings')]
    public function index(Security $security): Response
    {
        return $this->render('breathings/index.html.twig', [
            'souffles' => $this->souffle_manager->getBreathings(),
            'grades' => $this->grade_manager->getGrades(),
            'souffle_user' => $security->getUser()->getIdSouffle(),
        ]);
    }
}
