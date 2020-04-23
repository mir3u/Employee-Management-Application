<?php


namespace App\Controller;


use App\Entity\Bill;
use App\Entity\User;
use App\Form\BillType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
//use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\DateTime;

class BillController extends AbstractController
{

    public function newBill(Request $request){
        $bill = new Bill();
        $time = new \DateTime();
        $timezone = new \DateTimeZone('Europe/Bucharest');
        $time->setTimezone($timezone);
        $time->format('H:i:s \O\n Y-m-d');
        $bill->setDeadline($time);
        $form =  $form = $this->createForm(BillType::class, $bill);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bill = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $bill->setPayment(0);
            $entityManager->persist($bill);
            $entityManager->flush();

            return $this->redirectToRoute('listBills');
        }
        return $this->render('newBill.html.twig', array('form'=>$form->createView()));
    }

    public function listBills(Request $request){
        /** @var Bill[] $bills */
        $bills = $this->getDoctrine()
            ->getRepository(Bill::class)
            ->findAll();


        usort($bills,function($first,$second){
            return $first->getPayment() < $second->getPayment();
        });

//        die(var_dump($bills));

        return $this->render('listBills.html.twig', ['bills' => $bills]);

    }

    public function editBill(Request $request, $id){
        $bill  = $this->getDoctrine()
            ->getRepository(Bill::class)
            ->findOneBy(['id' => $id]);

        $form =  $form = $this->createForm(BillType::class, $bill);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bill = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($bill);
            $entityManager->flush();

            return $this->redirectToRoute('listBills');
        }
        return $this->render('newBill.html.twig', array('form'=>$form->createView()));

    }

    public function deleteBill(Request $request, $id){
        $em = $this->getDoctrine()->getManager();
        $bill  = $this->getDoctrine()
            ->getRepository(Bill::class)
            ->findOneBy(['id' => $id]);
        $em->remove($bill);
        $em->flush();

        return $this->redirectToRoute('listBills');
    }

    public function payBill(Request $request, $id){
        $em = $this->getDoctrine()->getManager();

        /** @var Bill $bill */
        $bill  = $this->getDoctrine()
            ->getRepository(Bill::class)
            ->findOneBy(['id' => $id]);
        $bill->setPayment(1);

        $em->persist($bill);
        $em->flush();

        return $this->redirectToRoute('listBills');
    }
}