<?php

namespace App\Controller;

use App\Manager\FactionManager;
use App\Manager\InscriptionManager;
use App\Security\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\NativePasswordHasher;
use Symfony\Component\Routing\Attribute\Route;

class InscriptionController extends AbstractController
{
    public function __construct(
        private InscriptionManager $inscription_manager,
        private FactionManager    $faction_manager,
    ) { }

    #[Route('/inscription', name: 'app_inscription')]
    public function index(): Response
    {
        $datas = $this->faction_manager->getFactions();

        foreach ($datas as &$data) {
            if (isset($data['grades_faction'])) {
                $data['grades_faction'] = json_decode($data['grades_faction'], true);
            }
            if (isset($data['capacities_faction'])) {
                $data['capacities_faction'] = json_decode($data['capacities_faction'], true);
            }
        }

        return $this->render('inscription/index.html.twig', [
            'factions' => $datas,
        ]);
    }

    #[Route('/inscrit', name: 'app_inscrit', methods: ['POST'])]
    public function inscrit(
        Request $request,
        NativePasswordHasher $passwordHasher,
        Security $security
    ): Response
    {
        $identite = $request->get('name-user');
        $pswd = $request->get('pswd-user');
        $faction = $request->get('faction-user');
        $capacity = $request->get('capacity-user');
        $grade = $request->get('grade-user');

        $hashedPswd = $passwordHasher->hash($pswd);

        try {
            $this->inscription_manager->inscription($identite, $hashedPswd, $capacity, $grade, $faction);
            $id_user = $this->inscription_manager->getNewUser($identite, $capacity, $grade, $faction);

            $user = new User([
                'id_user' => $id_user,
                'name_user' => $identite,
                'pswd_user' => $hashedPswd,
                'id_faction' => $faction,
                'grade_user' => $grade,
                'capacity_user' => $capacity,
            ]);

            $security->login($user);

            return $this->redirectToRoute('app_home');
        } catch (\Exception $e) {
            return $this->redirectToRoute('app_inscription');
        }
    }
}
