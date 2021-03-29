<?php

namespace App\Controller;

use App\Entity\Dossier;
use App\Entity\Employe;
use App\Entity\Materiel;
use App\Form\EditUserType;
use App\Repository\PanneRepository;
use App\Repository\DossierRepository;
use App\Repository\EmployeRepository;
use App\Repository\MaterielRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/", name="admin_")
 */

class AdminController extends AbstractController
{

    /**
     * Liste des utilisateurs du site
     * @Route("/utilisateurs", name="utilisateurs")
     */
    public function usersList(EmployeRepository $repo)
    {
        $users = $repo->findAll();
        return $this->render("admin/users/users.html.twig", [
            'users' => $users
        ]);
    }

    /**
     * Modifier un utilisateur/employé
     * @Route("/utilisateurs/modifier/{id}", name="editusers")
     */
    public function edituser(Employe $employe, Request $request, EntityManagerInterface $manager)
    {
        $form = $this->createForm(EditUserType::class, $employe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($employe);
            $manager->flush();

            $this->addFlash('message', 'L\'employ&eacute; ' . $employe->getNom() . ' ' . $employe->getPrenom() . ' a &eacute;t&eacute; modifi&eacute; avec succ&egrave;s');
            return $this->redirectToRoute('admin_utilisateurs');
        }

        return $this->render('admin/users/editusers.html.twig', [
            'userform' => $form->createView()
        ]);
    }

    /**
     * @Route("/listedossier", name="accueil")
     */
    public function accueil(DossierRepository $repo): Response
    {
        $dossiers = $repo->infodossier();
        $user = $this->getUser();
        return $this->render('admin/dossiers/listedossier.html.twig', [
            'user' => $user,
            'dossiers' => $dossiers,
        ]);
    }

    /**
     * Retourne les informations complète concernant un dossier
     * @Route("listedossier/{num}", name="detaildossier")
     */
    public function detaildossier(Dossier $dossier, PanneRepository $repo)
    {
        $user = $this->getUser();
        $panne = $repo->infopanne($dossier->getNum());
        return $this->render('admin/dossiers/detaildossier.html.twig', [
            'user' => $user,
            'dossier' => $dossier,
            'panne' => $panne
        ]);
    }
}
