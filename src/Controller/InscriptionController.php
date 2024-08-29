<?php

namespace App\Controller;

use App\Manager\GradeManager;
use App\Manager\InscriptionManager;
use App\Manager\SouffleManager;
use App\Security\LoginFormAuthenticator;
use App\Security\User;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\NativePasswordHasher;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

class InscriptionController extends AbstractController
{
    public function __construct(
        private SouffleManager $souffle_manager,
        private GradeManager $grade_manager,
        private InscriptionManager $inscription_manager
    ) { }

    #[Route('/inscription', name: 'app_inscription')]
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();

        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('inscription/index.html.twig', [
            'souffles' => $this->souffle_manager->getBreathings(),
            'grades' => $this->grade_manager->getGrades(),
        ]);
    }

    #[Route('/inscrit', name: 'app_inscrit', methods: ['POST'])]
    public function inscrit(
        Request $request,
        NativePasswordHasher $passwordHasher,
        UserAuthenticatorInterface $userAuthenticator,
        LoginFormAuthenticator $authenticator,
        Security $security
    ): Response
    {
        $identite = $request->get('identite-pourf');
        $pswd = $request->get('pswd-pourf');
        $souffle = $request->get('souffle-pourf');
        $grade = $request->get('grade-pourf');

        $hashedPswd = $passwordHasher->hash($pswd);

        $this->inscription_manager->inscription($identite, $hashedPswd, $souffle, $grade);
        $id_user = $this->inscription_manager->getNewUser($identite, $souffle, $grade);

        $user = new User([
            'id_user' => $id_user,
            'name_user' => $identite,
            'pswd_user' => $hashedPswd,
            'id_grade' => $grade,
            'id_souffle' => $souffle,
        ]);

        $security->login($user);

        return $this->redirectToRoute('app_home');
    }
}
