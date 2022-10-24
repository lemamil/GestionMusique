<?php

namespace App\Controller;

use App\Entity\Album;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AlbumController extends AbstractController
{
    /**
     * @Route('/albums', name: 'albums', methodes={"GET"})
     */
    public function listealbums(AlbumRepository $repo)
    {
        $albums=$repo->findBy(['date'=>2006],['nom'=>'asc']);
        return $this->render('album/listeAlbums.html.twig', [
            'lesAlbums' => $albums
        ]);
    }

    /**
     * @Route('/album/{id}', name: "ficheAlbum", methodes={"GET"})
     */
    public function fichealbum(album $album)
    {
        
        return $this->render('album/fichealbum.html.twig', [
            'leAlbum' => $album
        ]);
    }
}
