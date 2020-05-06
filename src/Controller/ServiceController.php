<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Entity\Service;
use App\Form\CustomerType;
use App\Form\ServiceType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class ServiceController extends AbstractController {
    public function listServices(Request $request) {
        /** @var \App\Entity\Service[] $services */
        $services=$this->getDoctrine()
            ->getRepository(Service::class)
            ->findAll();

        return $this->render('listServices.html.twig',['services'=>$services]);

    }

    public function add(Request $request) {
        $add=new Service();
        $form=$this->createFormBuilder($add)
            ->add('type',TextType::class,['label'=>'Type',])
            ->add('currency',TextType::class,['label'=>'Currency'])
            ->add('details',TextType::class,['label'=>'Details',])
            ->add('startDate',DateType::class,['label'=>'Start Date'])
            ->add('endDate',DateType::class,['label'=>'End  Date'])
            ->add('price',TextType::class,['label'=>'Price'])
            ->add('save',SubmitType::class,['label'=>'Add service'])
            ->getForm();

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $add=$form->getData();

            $entityManager=$this->getDoctrine()->getManager();
            $entityManager->persist($add);
            $entityManager->flush();
            return $this->redirectToRoute('listServices');
        }

        return $this->render('addService.html.twig',[
            'form'=>$form->createView(),
        ]);

    }

    public function editService(Request $request,$id) {
        $service=$this->getDoctrine()
            ->getRepository(Service::class)
            ->findOneBy(['id'=>$id]);

        $form=$form=$this->createForm(ServiceType::class,$service);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $service=$form->getData();
            $entityManager=$this->getDoctrine()->getManager();
            $entityManager->persist($service);
            $entityManager->flush();

            return $this->redirectToRoute('listServices');
        }
        return $this->render('addService.html.twig',['form'=>$form->createView()]);

    }

    public function deleteService(Request $request,$id) {
        $em=$this->getDoctrine()->getManager();
        $service=$this->getDoctrine()
            ->getRepository(Service::class)
            ->findOneBy(['id'=>$id]);
        $em->remove($service);
        $em->flush();

        return $this->redirectToRoute('listServices');
    }
}