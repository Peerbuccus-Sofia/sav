<?php

namespace App\Controller;

use App\Entity\Piece;
use App\Form\AddPieceType;
use App\Form\EditPieceType;
use App\Repository\PieceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PieceController extends AbstractController
{

    /**
     * function retournant la liste des pièces en stock
     */
    function pieces(PieceRepository $repo){
        $lespieces = $repo->findAll();
        $pieces = [];
        foreach($lespieces as $unepiece){
            if($unepiece->getEtat() == 'en stock'){
                $pieces[]=$unepiece;
            }
        }
        return $pieces;
    }

     /**
     * Liste des pièces disponible
     * @Route("/piece", name="listepiece")
     */
    public function listepiece(PieceRepository $repo){
        $user = $this->getUser();
        //$pieces = $this->pieces($repo);
        $etat = 'en stock';
        $pieces = $repo->piecedispo($etat);
        return $this->render('piece/listepiece.html.twig', [
            'pieces' => $pieces,
            'user' => $user
        ]);
    }

    /**
     * Ajouter une pièce au stock
     * @Route("/addpiece", name="addpiece")
     */
    public function addpiece(EntityManagerInterface $manager, Request $request){
        $route = "addpiece";
        $user = $this->getUser();
        $piece = new Piece;
        $formpiece = $this->createForm(AddPieceType::class, $piece);
        $formpiece->handleRequest($request);
        if($formpiece->isSubmitted() && $formpiece->isValid()){
            $piece->setQuantite(1);
            $manager->persist($piece);
            $manager->flush();
            return $this->redirectToRoute('listepiece');
        }
        return $this->render('piece/addpiece.html.twig', [
            'pieceform' => $formpiece->createView(),
            'user' => $user,
            'route' => $route
        ]);
    }

    /**
     * Update piece
     * @Route("/listepiece/{id}", name="updatepiece")
     */
    public function updatepiece(EntityManagerInterface $manager, Request $request, Piece $piece){
        $user = $this->getUser();
        $route = "updatepiece";
        $formpiece = $this->createForm(EditPieceType::class, $piece);
        $formpiece->handleRequest($request);
        if($formpiece->isSubmitted() && $formpiece->isValid()){
            $piece->setUpdatedUp(new \DateTime('now'));
            if($piece->getQuantite()>0){
                  $piece->setEtat('en stock');
            }  
            else { 
                $piece->setEtat('indisponible');
            }      
            $manager->persist($piece);
            $manager->flush();
            return $this->redirectToRoute('listepiece');
        }
        return $this->render('piece/editpiece.html.twig', [
            'pieceform' => $formpiece->createView(),
            'user' => $user,
            'route' => $route,
            'piece' => $piece
        ]);
    }

     /**
     * @Route("piece/{id}", name="deletepiece", methods="DELETE")
     * @Method("DELETE")
     */
    public function deletepiece(Request $request, EntityManagerInterface $manager, Piece $piece){
        dump('supp');
        if ($this->isCsrfTokenValid('delete'.$piece->getId(), $request->get('_token'))){
            $manager->remove($piece);
            $manager->flush();
            $this->addFlash('success', 'La pièce a été supprimées avec succès');
        }
        return $this->redirectToRoute('listepiece');
        $this->addFlash('success', 'La pièce a été supprimées avec succès');

        
    }


    /**
     * Piece a acheter
     * @Route("/piecebuy", name="piecebuy")
     */
    public function piecebuy(){
        $user = $this->getUser();
        
    }
}
