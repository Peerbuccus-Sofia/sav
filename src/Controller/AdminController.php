<?php

namespace App\Controller;

use App\Entity\Panne;
use App\Entity\Client;
use App\Entity\Dossier;
use App\Entity\Employe;
use App\Entity\Materiel;
use App\Form\ClientType;
use App\Form\AddPanneType;
use App\Form\EditUserType;
use App\Form\AddDossierType;
use App\Form\AddMaterielType;
use App\Form\AddTypedossierType;
use App\Repository\PanneRepository;
use App\Repository\ClientRepository;
use App\Repository\DossierRepository;
use App\Repository\EmployeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


class AdminController extends AbstractController
{
    
    /**
     * Liste des utilisateurs du site
     * @Route("/utilisateurs", name="utilisateurs")
     * @IsGranted("ROLE_ADMIN")
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
     * @IsGranted("ROLE_ADMIN")
     */
    public function edituser(Employe $employe, Request $request, EntityManagerInterface $manager)
    {
        $form = $this->createForm(EditUserType::class, $employe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($employe);
            $manager->flush();

            $this->addFlash('message', 'L\'employ&eacute; ' . $employe->getNom() . ' ' . $employe->getPrenom() . ' a &eacute;t&eacute; modifi&eacute; avec succ&egrave;s');
            return $this->redirectToRoute('utilisateurs');
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
        // $dossiers = $repo->findAll();
        $dossiers = $repo->infodossiers();
        $user = $this->getUser();
        return $this->render('admin/dossiers/listedossier.html.twig', [
            'user' => $user,
            'dossiers' => $dossiers,
        ]);
    }

    /**
     * Retourne les informations complète concernant un dossier
     * @Route("/listedossier/{id}", name="detaildossier")
     */
    public function detaildossier(Request $request, EntityManagerInterface $manager, Dossier $dossier, PanneRepository $repo, DossierRepository $repodossier)
    {
       $panne= $repo->infopanne($dossier->getMateriel()->getId());
        // $dos = $repodossier->infodossier($dossier->getId());
        $formdossier = $this->createForm(AddTypedossierType::class, $dossier);
        $formdossier->handleRequest($request);
        if ($formdossier->isSubmitted() && $formdossier->isValid()){
            $manager->persist($dossier);
            $manager->flush();
            $this->redirectToRoute('detaildossier', ['id' => $dossier->getId()]);
        }
        $user = $this->getUser();
        return $this->render('admin/dossiers/detaildossier.html.twig', [
            'dossierform' => $formdossier->createView(),
            'user' => $user,
            'dossier' => $dossier,
            'pannes' => $panne,
            // 'dos' => $dos
        ]);
    }


//Formulaire dépôt de matériel
    
    /**
     * Formulaire du client
     * @Route("/depotmateriel/client", name="addclient")
     */
    public function addclient(Request $request, EntityManagerInterface $manager){
        $user = $this->getUser();
        $client = new Client;
        $formClient = $this->createForm(ClientType::class, $client);
        $formClient->handleRequest($request);
        if($formClient->isSubmitted() && $formClient->isValid()){
            $manager->persist($client);
            $manager->flush();
            return $this->redirectToRoute('addmateriel', ['id' => $client->getId()]);
        }
        return $this->render('admin/depotmateriel/client/addClient.html.twig', [
            'clientform' => $formClient->createView(),
            'user' => $user
        ]);
    }

    /**
     * Formulaire du materiel
     * @Route("/depotmateriel/client/{id}/materiel/", name="addmateriel")
     */
    public function addmateriel(Request $request, EntityManagerInterface $manager, Client $client){
        $user = $this->getUser();
        $materiel = new Materiel;
        $formMateriel = $this->createForm(AddMaterielType::class, $materiel);
        $formMateriel->handleRequest($request);
        if($formMateriel->isSubmitted() && $formMateriel->isValid()){
            $materiel->setEtat(0);
            $manager->persist($materiel);
            $manager->flush();
            return $this->redirectToRoute('addpanne', [ 'id' => $client->getId() ,'idmateriel' => $materiel->getId()]);
            //return $this->redirectToRoute('diagnostic', [ 'id' => $client->getId() ,'idmateriel' => $materiel->getId()]);
        }
        return $this->render('admin/depotmateriel/materiel/addMateriel.html.twig', [
            'matform' => $formMateriel->createView(),
            'user' => $user,
            'client' => $client
        ]);

    }

    

    /**
     * Formulaire dossier
     * @Route("/depotmateriel/client/{id}/materiel/{idmateriel}/panne/{idpanne}/dossier", name="adddossier" )
     * @ParamConverter("client", options={"mapping" : {"id" : "id"}} )
     * @ParamConverter("materiel", options={"mapping"={"idmateriel": "id" }}) 
     * @ParamConverter("pannes", options={"mapping"={"idpanne": "id" }})
     */
    public function dossier(Request $request, EntityManagerInterface $manager,Client $client, Materiel $materiel, Panne $pannes){
        $user = $this->getUser();
        $dossier = new Dossier;
        $formDossier = $this->createForm(AddDossierType::class, $dossier);
        $formDossier->handleRequest($request);
        //save dossier
        if($formDossier->isSubmitted() && $formDossier->isValid()){
            $dossier->setClient($client);
            $dossier->setMateriel($materiel);
            $dossier->setEmploye($user);
            $manager->persist($dossier);
            $manager->flush();
            return $this->redirectToRoute('detaildossier', [ 'id' => $dossier->getId()]);                
        }
        return $this->render('admin/depotmateriel/dossier/addDossier.html.twig', [
            'dossierform' => $formDossier->createView(),
            'user' => $user,
            'pannes' => $pannes,
            'client' => $client,
            'materiel' => $materiel
        ]);

    }
    
      /**
     * Ajout de piece manquante
     * @Route("/panne{id}/piece", name="addpiece")
     */

     
    
}
