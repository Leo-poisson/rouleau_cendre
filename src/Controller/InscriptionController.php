<?php

namespace App\Controller;

use App\Manager\GradeManager;
use App\Manager\InscriptionManager;
use App\Manager\SouffleManager;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\NativePasswordHasher;
use Symfony\Component\Routing\Attribute\Route;

class InscriptionController extends AbstractController
{
    public function __construct(
        private SouffleManager $souffle_manager,
        private GradeManager $grade_manager,
        private InscriptionManager $inscription_manager
    ) { }

    #[Route('/inscription', name: 'app_inscription')]
    public function index(): Response
    {
        return $this->render('inscription/index.html.twig', [
            'souffles' => $this->souffle_manager->getBreathings(),
            'grades' => $this->grade_manager->getGrades(),
        ]);
    }

    /**
     * @throws \Doctrine\DBAL\Exception
     */
    #[Route('/inscrit', name: 'app_inscrit')]
    public function inscrit(Request $request, NativePasswordHasher $password_hasher): Response
    {
        $identite = $request->get('identite-pourf');
        $pswd = $request->get('pswd-pourf');
        $souffle = $request->get('souffle-pourf');
        $grade = $request->get('grade-pourf');

        $hashed_pswd = $password_hasher->hash($pswd);

        try {
            $this->inscription_manager->inscription($identite, $hashed_pswd, $souffle, $grade);
        } catch (Exception $e) {
            throw new Exception("Erreur lors de l'inscription", 0, $e);
        }

        return $this->redirectToRoute('app_connexion');
    }
}
