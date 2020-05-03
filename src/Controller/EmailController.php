<?php

namespace App\Controller;

use App\Entity\Email;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class EmailController extends AbstractController {
    public function newEmail(Request $request,\Swift_Mailer $mailer) {
        $add=new Email();
        $form=$this->createFormBuilder($add)
            ->add('efrom',EmailType::class,['label'=>'From',])
            ->add('eto',EmailType::class,['label'=>'To',])
            ->add('esubject',TextType::class,['label'=>'Subject'])
            ->add('ebody',TextType::class,['label'=>'Body'])
            ->add('send',SubmitType::class,['label'=>'Send mail'])
            ->getForm();

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $add=$form->getData();

            $entityManager=$this->getDoctrine()->getManager();
            $entityManager->persist($add);
            $entityManager->flush();
            $this->sendMail($add,$mailer);
            return $this->redirectToRoute('home');
        }

        return $this->render('newEmail.html.twig',[
            'form'=>$form->createView(),
        ]);

    }

    public function sendMail(Email $email,\Swift_Mailer $mailer) {
        $message=(new \Swift_Message($email->getESubject()))
            ->setFrom($email->getEFrom())
            ->setTo($email->getETo())
            ->setBody($email->getEBody());
        $mailer->send($message);
    }
}