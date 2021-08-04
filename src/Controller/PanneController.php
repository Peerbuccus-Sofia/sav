<?php

namespace App\Controller;

use App\Entity\Panne;
use App\Entity\Client;
use App\Entity\Materiel;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class PanneController extends AbstractController
{
    /**
     * Formulaire panne
     * @Route("/depotmateriel/client/{id}/materiel/{idmateriel}/panne", name="addpanne")
     * @ParamConverter("client", options={"mapping" : {"id" : "id"}} )
     * @ParamConverter("materiel", options={"mapping"={"idmateriel": "id" }})
     */
    public function addpanne(Request $request, EntityManagerInterface $manager, Client $client, Materiel $materiel){
        $user = $this->getUser();
        $panne = new Panne;
        $formPanne = $this->createForm(AddPanneType::class, $panne);
        $formPanne->handleRequest($request);

        //save panne
        if($formPanne->isSubmitted() && $formPanne->isValid()){
            $panne->setMateriel($materiel);
            $manager->persist($panne);
            $manager->flush();
            return $this->redirectToRoute('adddossier', [ 'id' => $client->getId(), 'idmateriel' => $materiel->getId(), 'idpanne' => $panne->getId()]);                
        }
        return $this->render('admin/depotmateriel/panne/addPanne.html.twig', [
            'client' => $client,
            'materiel' => $materiel,
            'panneform' => $formPanne->createView(),
            'user' => $user
        ]);
    }   
}
