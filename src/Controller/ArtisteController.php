<?php

namespace App\Controller;

use App\Repository\ArtisteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArtisteController extends AbstractController
{
    /**
     * @Route('/artistes', name: 'artistes', methodes={"GET"})
     */
    public function listeArtistes(ArtisteRepository $repo)
    {
        $artistes=$repo->findAll();
        return $this->render('artiste/index.html.twig', [
            'lesArtistes' => $artistes
        ]);
    }

    /**
     * @Route('/artiste/{id}', name: "ficheArtiste", methodes={"GET"})
     */
    public function ficheArtiste(Artiste $artiste)
    {
        
        return $this->render('artiste/ficheArtiste.html.twig', [
            'leArtiste' => $artiste,
        ]);
    }
}
