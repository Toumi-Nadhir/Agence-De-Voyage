<?php

namespace App\Controller;

use App\Entity\Admin;
use App\Entity\User;
use App\Form\LoginType;
use App\Form\RecuperermotdepasseType;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="user_index", methods={"GET"})
     */
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="user_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user=$form->getData();
           // $file=$admin->getImage();
            $file = $form->get('image')->getData();
            $fileName=md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('upload_directory'), $fileName);
            $user->setImage($fileName);

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_show", methods={"GET"})
     */
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="user_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user=$form->getData();
          //  $file=$admin->getImage();
            $file = $form->get('image')->getData();
            $fileName=md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('upload_directory'), $fileName);
            $user->setImage($fileName);

            $entityManager->flush();

            return $this->redirectToRoute('user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_delete", methods={"POST"})
     */
    public function delete(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/loginnn/a", name="login_userrrr", methods={"GET", "POST"})
     */
    public function login(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(LoginType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $userlogin = $this->getDoctrine()->getRepository(User::class)->findOneBy(["email"=>$user->getEmail(),"password"=>$user->getPassword()]) ;
            if (is_null($userlogin)){
                $adminLogin = $this->getDoctrine()->getRepository(Admin::class)->findOneBy(["email"=>$user->getEmail(),"password"=>$user->getPassword()]) ;
                if (is_null($adminLogin)){
                    return $this->redirectToRoute('login_userrrr');
                }else {
                    return $this->redirectToRoute('admin_index',[
                    ]);
                }
            }else{
                return $this->redirectToRoute('user_show',['id'=>$userlogin->getId()]);
            }
        }
        return $this->render('user/Login.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/rec/a", name="user_rec", methods={"GET", "POST"})
     */
    public function RECC(Request $request, EntityManagerInterface $entityManager,\Swift_Mailer $mailer): Response
    {
        $user = new User();
        $form = $this->createForm(RecuperermotdepasseType::class, $user);
        $form->handleRequest($request);

        if ( $form->isSubmitted() ) {
            $email = $user->getEmail() ;
            $XX = $this->getDoctrine()->getRepository(User::class)->findOneBy(['email'=>$email]) ;
            if(is_null($XX)){
                return $this->redirectToRoute('login_userrrr');
            }else{
                $message = (new \Swift_Message('User'))
                    ->setFrom('taabaniesprit@gmail.com')
                    ->setTo($user->getEmail())
                    ->setBody("votre mot de passe :".$XX->getPassword());
                $mailer->send($message) ;
                return $this->redirectToRoute('login_userrrr');
            }
        }
        return $this->render('user/Rec.html.twig', [
            'user' => $user,
            'form' => $form->createView(),

        ]);
    }




}
