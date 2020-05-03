<?php


namespace App\Controller;


use App\Entity\Mail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class MailController extends AbstractController
{

    public function newMail(Request $request,\Swift_Mailer $mailer){
        //$mail = new Mail();
        

        $form = $this->createFormBuilder()
            ->add('receiver', TextType::class, ['label' => 'Receiver'])
            ->add('address', TextType::class, ['label' => 'Address'])
            ->add('content', TextType::class, ['label' => 'Content'])
            ->add('awb', TextType::class, ['label' => 'Awb'])
            ->add('save', SubmitType::class, ['label' => 'Send Mail'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $mail = $form->getData();

            $body = "You have a new order that will be brought to you to the address " . $mail[ 'address' ] . " with the contents of " . $mail[ 'content' ] . '. The AWB is: ' . $mail[ 'awb' ] . '.';

            $message = (new \Swift_Message('Hello!'))
                ->setFrom('ana.bratucu@gmail.com')
                ->setTo($mail[ 'receiver' ])
                ->setBody($body,'text/plain');

            $mailer->send($message);
            //$entityManager->persist($mail);
           // $entityManager->flush();

        }
        return $this->render('newMail.html.twig', array('form'=>$form->createView()));
    }
}