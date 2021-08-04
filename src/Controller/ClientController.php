<?php

namespace App\Controller;

use App\Entity\Panne;
use App\Entity\Client;
use App\Entity\Dossier;
use App\Entity\Materiel;
use App\Form\ClientType;
use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class ClientController extends AbstractController
{

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

   /**
      * Editer la fiche d'un client avec redirection sur le dossier
      * @Route("listedossier/{id}/editclient/{idclient}", name="editclient")
      * @ParamConverter("client", options={"mapping" : {"idclient" : "id"}} )
      * @ParamConverter("dossier", options={"mapping" : {"id" : "id"}} )
      *
      */
      public function editclient(Client $client, Request $request, EntityManagerInterface $manager, Dossier $dossier){
        $user= $this->getUser();
        $formClient = $this->createForm(ClientType::class ,$client);
        $formClient->handleRequest($request);
        if($formClient->isSubmitted() && $formClient->isValid()){
            $manager->persist($client);
            $manager->flush();
            return $this->redirectToRoute('detaildossier', ['id' => $dossier->getId()]);
        }
        return $this->render('admin/client/editClient.html.twig', [
            'clientform' => $formClient->createView(),
            'user' => $user
        ]);
    }

     /**
      * Editer la fiche d'un client avec redirection sur la création de materiel
      * @Route("/editclient/{idclient}", name="editficheclient")
      * @ParamConverter("client", options={"mapping" : {"idclient" : "id"}} )
      *
      */
    public function editficheclient(Client $client, Request $request, EntityManagerInterface $manager){
        $user= $this->getUser();
        $formClient = $this->createForm(ClientType::class ,$client);
        $formClient->handleRequest($request);
        if($formClient->isSubmitted() && $formClient->isValid()){
            $manager->persist($client);
            $manager->flush();
            return $this->redirectToRoute('addmateriel', ['id' => $client->getId()]);
        }
        return $this->render('admin/client/editClient.html.twig', [
            'clientform' => $formClient->createView(),
            'user' => $user
        ]);
    }

    /**
      * Editer la fiche d'un client avec redirection sur la création de materiel
      * @Route("/editclient/{idclient}/materiel/{idmateriel}", name="editclientbypanne")
      * @ParamConverter("client", options={"mapping" : {"idclient" : "id"}} )
      * @ParamConverter("materiel", options={"mapping" : {"idmateriel" : "id"}} )
      */
      public function editclientbypanne(Client $client, Request $request, EntityManagerInterface $manager, Materiel $materiel){
        $user= $this->getUser();
        $formClient = $this->createForm(ClientType::class ,$client);
        $formClient->handleRequest($request);
        if($formClient->isSubmitted() && $formClient->isValid()){
            $manager->persist($materiel);
            $manager->persist($client);
            $manager->flush();
            return $this->redirectToRoute('addpanne', [ 'id' => $client->getId() ,'idmateriel' => $materiel->getId()]);
        }
        return $this->render('admin/client/editClient.html.twig', [
            'clientform' => $formClient->createView(),
            'user' => $user
        ]);
    }

    /**
      * Editer la fiche d'un client avec redirection sur la création de materiel
      * @Route("/editclient/{idclient}/materiel/{idmateriel}", name="editclientbydossier")
      * @ParamConverter("client", options={"mapping" : {"idclient" : "id"}} )
      * @ParamConverter("materiel", options={"mapping" : {"idmateriel" : "id"}} )
      * @ParamConverter("panne", options={"mapping" : {"idpanne" : "id"}} )
      */
      public function editclientbydossier(Client $client, Request $request, EntityManagerInterface $manager, Materiel $materiel, Panne $panne){
        $user= $this->getUser();
        $formClient = $this->createForm(ClientType::class ,$client);
        $formClient->handleRequest($request);
        if($formClient->isSubmitted() && $formClient->isValid()){
            $manager->persist($panne);
            $manager->persist($materiel);
            $manager->persist($client);
            $manager->flush();
            return $this->redirectToRoute('adddossier', [ 'idclient' => $client->getId() ,'idmateriel' => $materiel->getId(), 'idpanne' => $panne->getId()]);
        }
        return $this->render('admin/client/editClient.html.twig', [
            'clientform' => $formClient->createView(),
            'user' => $user
        ]);
    }
    
}
