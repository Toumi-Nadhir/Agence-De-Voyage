<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use App\Form\VolType;
use App\Entity\Vol;

use Symfony\Component\HttpFoundation\Request;

class VolController extends AbstractController
{
    /**
     * @Route("/vol", name="vol")
     */
    public function index(): Response
    {
        return $this->render('vol/vol.html.twig', [
            'controller_name' => 'VolController',
        ]);
    }

    /**
     * @Route("/volList", name="volList")
     */
    public function readvol()
    {
        $repository = $this->getDoctrine()->getRepository(Vol::class);
        $Vols = $repository->findAll();

        return $this->render('vol/listeVol.html.twig', [
            'Vols' => $Vols,
        ]);
    }

    /**
     * @Route("/creat-vol", name="create")
     */
    public function create(Request $request)
    {
        $Vol = new Vol();
        $form = $this->createForm(VolType ::class, $Vol);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $Vol = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($Vol);
            $em->flush();
            return $this->redirectToRoute('volList');
        }
        return $this->render('vol/create.html.twig', [
            'formA' => $form->createView()
        ]);
    }

    /**
     * @Route("/edit_vol/{id}", name="edit_vol")
     */
    public function edit(\Symfony\Component\HttpFoundation\Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $Vol = $em->getRepository(Vol::class)->find($id);
        $form = $this->createForm(VolType::class, $Vol);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('volList');

        }

        return $this->render('vol/modifierVol.html.twig', array("formA" => $form->createView()));


    }

    /**
     * @Route("/deletevol/{id}",name="delete_vol")
     */
    public function delete(Request $request, $id) {
        $Vol= $this->getDoctrine()->getRepository(Vol::class)->find($id);


        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($Vol);
        $entityManager->flush();

        $response = new Response();
        $response->send();
        return $this->redirectToRoute('volList');
    }

    /**
     * @Route("/detail_vol/{id}", name="detail")
     */
    public function detailVol(\Symfony\Component\HttpFoundation\Request $req, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $vol = $em->getRepository(Vol::class)->find($id);


        return $this->render('vol/detail.html.twig', array(
            'id' => $vol->getId(),
            'etat' => $vol->getEtat(),
            'depart' => $vol->getDepart(),
            'arrive' => $vol->getArrive(),
            'duree' => $vol->getDuree(),
            'destination'=>$vol->getDestination(),
            'place' => $vol->getPlace()
        ));
    }
}
