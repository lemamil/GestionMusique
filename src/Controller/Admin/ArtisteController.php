<?php

namespace App\Controller\Admin;

use App\Entity\Artiste;
use App\Form\ArtisteType;
use App\Repository\ArtisteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArtisteController extends AbstractController
{
   /**
     * @Route("/admin/artiste/ajout", name: "admin_artiste_ajout", methodes={"GET","MOST"})
     */
    public function ajoutArtiste(Request $request, EntityManagerInterface $manager)
    {

        $artiste=new Artiste();
        $form=$this->createForm(ArtisteType::class, $artiste);
        dump($artiste);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid() )
        {
            $manager->persist($artiste);
            $manager->flush();
            $this->addFlash("success","L'artiste a bien été ajouté" );
            return $this->redirectToRoute('admin_artistes');
        }
        
        return $this->render('admin/artiste/formAjoutArtiste.html.twig', [
            'formArtiste' => $form-createView()
        ]);
    }

    /**
     * @Route("/admin/artiste/modif/{id}", name: "admin_artiste_modif", methodes={"GET","MOST"})
     */
    public function modifArtiste(Artiste $artiste, Request $request, EntityManagerInterface $manager)
    {
        $form=$this->createForm(ArtisteType::class, $artiste);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid() )
        {
            $manager->persist($artiste);
            $manager->flush();
            $this->addFlash("success","L'artiste a bien été modifié" );
            return $this->redirectToRoute('admin_artistes');
        }
        
        return $this->render('admin/artiste/formModifArtiste.html.twig', [
            'formArtiste' => $form-createView()
        ]);
    }

    /**
     * @Route("/admin/artiste/suppression/{id}", name: "admin_artiste_suppression", methodes={"GET"})
     */
    public function suppressionArtiste(Artiste $artiste, EntityManagerInterface $manager)
    {
        $nbAlbums=$artiste->getAlbums()->count();
        if($nbAlbums->0){
            $this->addFlash("danger","Vous ne pouvez pas supprimer cet artiste car $nbAlbums album(s) y sont associés");
        }else{
            $manager->remove($artiste);
            $manager->flush();
            $this->addFlash("success","L'artiste a bien été supprimé" );
        }
        return $this->redirectToRoute('admin_artistes');
    }
}
