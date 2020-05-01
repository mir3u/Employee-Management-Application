<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Form\CustomerType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class CustomerController extends AbstractController {
    public function listCustomers(Request $request) {
        /** @var \App\Entity\Customer[] $companies */
        $customers=$this->getDoctrine()
            ->getRepository(Customer::class)
            ->findAll();

        return $this->render('listCustomers.html.twig',['customers'=>$customers]);

    }

    public function add(Request $request) {
        $add=new Customer();
        $form=$this->createFormBuilder($add)
            ->add('details',TextType::class,['label'=>'Details',])
            ->add('email',TextType::class,['label'=>'Email'])
            ->add('phoneNo',TextType::class,['label'=>'Phone number'])
            ->add('location',TextType::class,['label'=>'Location'])
            ->add('dueDate',DateType::class,['label'=>'Due Date'])
            ->add('feedback',TextType::class,['label'=>'Feedback','required'=>FALSE])
            ->add('save',SubmitType::class,['label'=>'Add customer'])
            ->getForm();

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $add=$form->getData();

            $entityManager=$this->getDoctrine()->getManager();
            $entityManager->persist($add);
            $entityManager->flush();
            return $this->redirectToRoute('listCustomers');
        }

        return $this->render('addCustomer.html.twig',[
            'form'=>$form->createView(),
        ]);

    }

    public function editCustomer(Request $request,$id) {
        $customer=$this->getDoctrine()
            ->getRepository(Customer::class)
            ->findOneBy(['id'=>$id]);

        $form=$form=$this->createForm(CustomerType::class,$customer);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $customer=$form->getData();
            $entityManager=$this->getDoctrine()->getManager();
            $entityManager->persist($customer);
            $entityManager->flush();

            return $this->redirectToRoute('listCustomers');
        }
        return $this->render('addCustomer.html.twig',['form'=>$form->createView()]);

    }

    public function deleteCustomer(Request $request,$id) {
        $em=$this->getDoctrine()->getManager();
        $customer=$this->getDoctrine()
            ->getRepository(Customer::class)
            ->findOneBy(['id'=>$id]);
        $em->remove($customer);
        $em->flush();

        return $this->redirectToRoute('listCustomers');
    }
}