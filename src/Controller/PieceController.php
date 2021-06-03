<?php

namespace App\Controller;

use App\Repository\PieceRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PieceController extends AbstractController
{

     /**
     * Liste des pièces disponible
     * @Route("/piece", name="listepiece")
     */
    public function listepiece(PieceRepository $repo){
        $user = $this->getUser();
        $pieces = $repo->findAll();
        return $this->render('piece/listepiece.html.twig', [
            'pieces' => $pieces,
            'user' => $user
        ]);
    }

    /**
     * Piece a acheter
     * @Route("/piecebuy", name="piecebuy")
     */
    public function piecebuy(){
        $user = $this->getUser();
        
    }
}
