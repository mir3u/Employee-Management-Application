<?php


namespace App\Controller;


use App\Entity\Mail;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class MailController extends AbstractController
{

    public function addMail(Request $request,\Swift_Mailer $mailer){
        //$mail = new Mail();
        $session = $request->getSession();
        $companyName = $session->get('user');

        $company = $this->getDoctrine()
            ->getRepository(User::class)
            ->findOneBy(['username' => $companyName]);
        if ($session->get('user') === null) {
            return $this->redirectToRoute('login');
        }

        $mail = new Mail();
        $form = $this->createFormBuilder($mail)
            ->add('receiverName', TextType::class, ['label' => 'Receiver Name'])
            ->add('receiverEmail', TextType::class, ['label' => 'Receiver Email'])
            ->add('address', TextType::class, ['label' => 'Address'])
            ->add('content', TextType::class, ['label' => 'Content'])
            ->add('awb', TextType::class, ['label' => 'Awb'])
            ->add('save', SubmitType::class, ['label' => 'Send Mail'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $mail = $form->getData();

            try {

                $body = "You have a new order that will be brought to you to the address " . $mail[ 'address' ] . " with the contents of " . $mail[ 'content' ] . '. The AWB is: ' . $mail[ 'awb' ] . '.';

                $message = (new \Swift_Message('Hello!'))
                    ->setFrom('ana.bratucu@gmail.com')
                    ->setTo($mail[ 'receiver' ])
                    ->setBody($body,'text/plain');

                $mailer->send($message);

                $mail->setUser($company);
                $entityManager->persist($mail);
                $entityManager->flush();
            }catch (\Swift_TransportException $e){
                echo $e;
            }

            return $this->redirectToRoute("listMail");
        }
        return $this->render('newMail.html.twig', array('form'=>$form->createView()));
    }

    public function listMail(Request $request){
        $session = $request->getSession();
        $companyName = $session->get('user');

        $company = $this->getDoctrine()
            ->getRepository(User::class)
            ->findOneBy(['username' => $companyName]);
        if ($session->get('user') === null) {
            return $this->redirectToRoute('login');
        }

        /** @var Mail[] $bills */
        $mail = $this->getDoctrine()
            ->getRepository(Mail::class)
            ->findBy(['user' => $company]);

        return $this->render('listMail.html.twig', ['mail' => $mail]);
    }

    public function editMail(Request $request, $id){
        $mail  = $this->getDoctrine()
            ->getRepository(Bill::class)
            ->findOneBy(['id' => $id]);

        $form = $this->createFormBuilder($mail)
            ->add('receiverName', TextType::class, ['label' => 'Receiver Name'])
            ->add('receiverEmail', TextType::class, ['label' => 'Receiver Email'])
            ->add('receiver', TextType::class, ['label' => 'Receiver'])
            ->add('address', TextType::class, ['label' => 'Address'])
            ->add('content', TextType::class, ['label' => 'Content'])
            ->add('awb', TextType::class, ['label' => 'Awb'])
            ->add('save', SubmitType::class, ['label' => 'Send Mail'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $mail = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($mail);
            $entityManager->flush();

            return $this->redirectToRoute('listBills');
        }
        return $this->render('newMail.html.twig', array('form'=>$form->createView()));

    }

    public function deleteMail(Request $request, $id){
        $em = $this->getDoctrine()->getManager();
        $mail  = $this->getDoctrine()
            ->getRepository(Mail::class)
            ->findOneBy(['id' => $id]);
        $em->remove($mail);
        $em->flush();

        return $this->redirectToRoute('listMail');
    }
}