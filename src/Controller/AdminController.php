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
use App\Repository\PanneRepository;
use App\Repository\PieceRepository;
use App\Repository\ClientRepository;
use App\Repository\DossierRepository;
use App\Repository\EmployeRepository;
use App\Repository\MaterielRepository;
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
     * @Route("/listedossier/{num}", name="detaildossier")
     */
    public function detaildossier(Dossier $dossier, PanneRepository $repo, DossierRepository $repodossier)
    {
       $panne= $repo->infopanne($dossier->getMateriel()->getId());
        $dos = $repodossier->infodossier($dossier->getNum());
        $user = $this->getUser();
        return $this->render('admin/dossiers/detaildossier.html.twig', [
            'user' => $user,
            'dossier' => $dossier,
            'pannes' => $panne,
            'dos' => $dos
        ]);
    }

    /**
     * Retourne la liste des clients 
     * @Route("/listeclient", name="listeclient")
     */
    public function listeclient(ClientRepository $repo){
        $user = $this->getUser();
        $client = $repo->findAll();
        return $this->render('admin/client/listeclient.html.twig', [
            'user' => $user,
            'clients' => $client
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
        }
        return $this->render('admin/depotmateriel/materiel/addMateriel.html.twig', [
            'matform' => $formMateriel->createView(),
            'user' => $user,
            'client' => $client
        ]);

    }

    /**
     * Formulaire panne
     * @Route("/depotmateriel/client/{id}/materiel/{idmateriel}/panne", name="addpanne")
     * @ParamConverter("client", options={"mapping" : {"id" : "id"}} )
     * @ParamConverter("materiel", options={"mapping"={"idmateriel": "id" }})
     */
    public function addpanne(Request $request, EntityManagerInterface $manager, MaterielRepository $repoMat){
        $user = $this->getUser();
        
        $panne = new Panne;
        $formPanne = $this->createForm(AddPanneType::class, $panne);
        $formPanne->handleRequest($request);

        $tabMat = $repoMat->findAll();
        $lastmateriel = $tabMat[count($tabMat)-1];
        //dump($lastmateriel->getId());
        //save panne
        if($formPanne->isSubmitted() && $formPanne->isValid()){
            $panne->setMateriel($lastmateriel);
            //$panne->setPiece();
            $manager->persist($panne);
            $manager->flush();
            return $this->redirectToRoute('adddossier');                
        }
        return $this->render('admin/depotmateriel/panne/addPanne.html.twig', [
            'panneform' => $formPanne->createView(),
            'user' => $user
        ]);
    }   

    /**
     * Ajout de piece manquante
     * @Route("/panne{id}/piece", name="addpiece")
     */
    


    /**
     * Formulaire dossier
     * @Route("/depotmateriel/client/{id}/materiel/{idmateriel}/panne/{idpanne}", name="adddossier" )
     * 
     */
    public function dossier(Request $request, EntityManagerInterface $manager){

    }
    
}
