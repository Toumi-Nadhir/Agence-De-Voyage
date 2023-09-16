<?php

namespace App\Controller;

use App\Entity\Voiture;
use App\Form\VoitureType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VoitureController extends AbstractController
{
    /**
     * @Route("/voiture", name="voiture_list")
     */
    public function index(): Response
    {
        $res = $this->getDoctrine()->getManager()->getRepository(voiture::class)->findAll();
        return $this->render('voiture/listvoiture.html.twig',array('voitures'=>$res));
    }
    /**
     * @Route("/addvoiture", name="add")
     */
    public function addvoiture(\Symfony\Component\HttpFoundation\Request  $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $voiture = new voiture();
        $form= $this->createForm(voitureType::class,$voiture);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $voiture=$form->getData();
            // $file=$admin->getImage();
            $file = $form->get('image')->getData();
            $fileName=md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('upload_directory'), $fileName);
            $voiture->setImage($fileName);
            /*
             * Add product
             */
            $em->persist($voiture);
            /*
             * Commit
             */
            $em->flush();

            return  $this->redirectToRoute('voiture_list');

        }

        return $this->render('voiture/Addvoiture.html.twig',array("f"=>$form->createView()));

    }
    /**
     * @Route("/editvoiture/{id}", name="edit_voiture")
     * Method({"GET", "POST"})
     */
    public function edit(\Symfony\Component\HttpFoundation\Request  $request, $id) {
        $em= $this->getDoctrine()->getManager();
        $voiture = $em->getRepository(voiture::class)->find($id);
        $form = $this->createForm(voitureType::class,$voiture);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            //upload image
            $uploadFile = $form['image']->getData(); // valeur  image
            $filename = md5(uniqid()) . '.' .$uploadFile->guessExtension();//crypter image

            $uploadFile->move($this->getParameter('kernel.project_dir').'/public/uploads/produit_image',$filename);


            $voiture->setImage($filename);
            $em->flush();

            return $this->redirectToRoute('voiture_list');

        }

        return $this->render('voiture/edit.html.twig',array("f"=>$form->createView()));
    }


    /**
     * @Route("/deletevoiture/{id}",name="delete_voiture")
     */
    public function delete(Request $request, $id) {
        $voiture= $this->getDoctrine()->getRepository(voiture::class)->find($id);


        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($voiture);
        $entityManager->flush();

        $response = new Response();
        $response->send();
        return $this->redirectToRoute('voiture_list');
    }
    /**
     * @Route("/detailvoiture/{id}", name="detail_voiture")
     */
    public function detailvoiture(\Symfony\Component\HttpFoundation\Request $req, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $voiture = $em->getRepository(voiture::class)->find($id);


        return $this->render('voiture/detailvoiture.html.twig', array(
            'id' => $voiture->getId(),
            'serie' => $voiture->getserie(),
            'marque' => $voiture->getmarque(),
            'model' => $voiture->getmodel(),
            'prix' => $voiture->getprix(),
            'description' => $voiture->getdescription(),
            'couleur' => $voiture->getcouleur(),
            'image'=>$voiture->getImage()

        ));
    }

}
