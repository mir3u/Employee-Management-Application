<?php


namespace App\Controller;


use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\HttpFoundation\Request;
class RegisterController extends  AbstractController
{
    public function register(Request $request)
    {
        $register = new User();
        $form = $this->createFormBuilder($register)
            ->add('firstname', TextType::class)
            ->add('lastname', TextType::class)
            ->add('username', TextType::class)
            ->add('password', RepeatedType::class, array(
                'type' => PasswordType::class,
                'invalid_message' => 'The password fields must match.',
                'options' => array('attr' => array('class' => 'password-field')),
                'required' => true,
                'first_options' => array('label' => 'Password'),
                'second_options' => array('label' => 'Repeat Password'),
            ))
            ->add('email', EmailType::class)
            ->add('save', SubmitType::class, ['label' => 'Register'])
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $register = $form->getData();
//            if(empty($register->getFirstname())){
//                return $this->redirectToRoute('errorPage', [
//                    'error' => "add a first name ",
//                ]);
//            }elseif(empty($register->getLastname())){
//                return $this->redirectToRoute('errorPage', [
//                    'error' => "add a last name "
//                ]);
//            }
//            elseif(empty($register->getUsername())){
//                return $this->redirectToRoute('errorPage', [
//                    'error' => "add a username "]);
//            }
//            elseif(empty($register->getPassword())){
//                return $this->redirectToRoute('errorPage', [
//                    'error' => "add a password "]);
//            }
//            elseif(empty($register->getEmail())){
//                return $this->redirectToRoute('errorPage', [
//                    'error' =>"add a email "]);
//            }
//            elseif(strlen($register->getPassword())<4){
//
//                return $this->redirectToRoute('errorPage', [
//                    'error' => "password too short "]);
//            }

            if(!filter_var($register->getEmail(), FILTER_VALIDATE_EMAIL)) {
                return $this->redirectToRoute('errorPage', [
                    'error' => "bad email "]);
            }else{
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($register);
                $entityManager->flush();
                return $this->redirectToRoute('home');}
        }else{

            return $this->render('register.html.twig', [
                'form' => $form->createView(),
            ]);}

    }
}