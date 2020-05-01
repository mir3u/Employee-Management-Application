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
            ->add('content', TextType::class, ['label' => 'Content'])
            ->add('awb', TextType::class, ['label' => 'Awb'])
            ->add('save', SubmitType::class, ['label' => 'Send Mail'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $mail = $form->getData();

            $message = (new \Swift_Message('Hello!'))
                ->setFrom('ana.bratucu@gmail.com')
                ->setTo($mail[ 'receiver' ])
                ->setBody($mail[ 'content' ],'text/plain');

            $mailer->send($message);
            

        }
        return $this->render('newMail.html.twig', array('form'=>$form->createView()));
    }
}