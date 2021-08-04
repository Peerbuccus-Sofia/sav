<?php

namespace App\Controller;

use App\Entity\Panne;
use App\Entity\Client;
use App\Entity\Materiel;
use App\Form\AddMaterielType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class MaterielController extends AbstractController
{
    /**
     * Formulaire du materiel avec redirection sur la panne
     * @Route("client/{id}/editmateriel/{idmateriel}", name="editmateriel")
     * @ParamConverter("client", options={"mapping" : {"id" : "id"}} )
     * @ParamConverter("materiel", options={"mapping"={"idmateriel": "id" }})
     */
    public function editmateriel(Materiel $materiel ,Request $request, EntityManagerInterface $manager, Client $client){
        $user = $this->getUser();
        $formMateriel = $this->createForm(AddMaterielType::class, $materiel);
        $formMateriel->handleRequest($request);
        if($formMateriel->isSubmitted() && $formMateriel->isValid()){
            $materiel->setEtat(0);
            $manager->persist($materiel);
            $manager->flush();
            return $this->redirectToRoute('addpanne', [ 'id' => $client->getId() ,'idmateriel' => $materiel->getId()]);
        }
        return $this->render('materiel/editMateriel.html.twig', [
            'matform' => $formMateriel->createView(),
            'user' => $user,
            'client' => $client
        ]);

    }

    /**
     * Formulaire du materiel avec redirection sur la panne
     * @Route("client/{id}/editmateriel/{idmateriel}", name="editmaterielbydossier")
     * @ParamConverter("client", options={"mapping" : {"id" : "id"}} )
     * @ParamConverter("materiel", options={"mapping"={"idmateriel": "id" }})
     */
    public function editmaterielbydossier(Materiel $materiel ,Request $request, EntityManagerInterface $manager, Client $client, Panne $pannes){
        $user = $this->getUser();
        $formMateriel = $this->createForm(AddMaterielType::class, $materiel);
        $formMateriel->handleRequest($request);
        if($formMateriel->isSubmitted() && $formMateriel->isValid()){
            $materiel->setEtat(0);
            $manager->persist($materiel);
            $manager->flush();
            return $this->redirectToRoute('addpanne', [ 'id' => $client->getId() ,'idmateriel' => $materiel->getId()]);
        }
        return $this->render('materiel/editMateriel.html.twig', [
            'matform' => $formMateriel->createView(),
            'user' => $user,
            'client' => $client,
            'pannes' => $pannes
        ]);

    }

}
