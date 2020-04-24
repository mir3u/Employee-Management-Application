<?php


namespace App\Controller;


use App\Entity\Company;
use App\Form\CompanyType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\HttpFoundation\Request;

class CompanyController
    extends AbstractController
{
    public function add(Request $request)
    {
        $add = new Company();
        $time = new \DateTime();
        $timezone = new \DateTimeZone('Europe/Bucharest');
        $time->setTimezone($timezone);
        $time->format('H:i:s \O\n Y-m-d');
        $add->setStartDate1($time);
        $add->setEndDate1($time);
        $add->setStartDate2($time);
        $add->setEndDate2($time);
        $add->setStartDate3($time);
        $add->setEndDate3($time);

        $form = $this->createFormBuilder($add)
            ->add('companyName', TextType::class, ['label' => 'Company Name', ])
            ->add('service1', TextType::class, ['label' => 'Service'])
            ->add('price1', TextType::class, ['label' => 'Price'])
            ->add('startDate1', DateType::class, ['label' => 'Start Date'])
            ->add('endDate1', DateType::class, ['label' => 'End Date'])
            ->add('service2', TextType::class, ['label' => 'Service','required' => false])
            ->add('price2', TextType::class, ['label' => 'Price','required' => false])
            ->add('startDate2', DateType::class, ['label' => 'Start Date','required' => false])
            ->add('endDate2', DateType::class, ['label' => 'End Date','required' => false])
            ->add('service3', TextType::class, ['label' => 'Service','required' => false])
            ->add('price3', TextType::class, ['label' => 'Price','required' => false])
            ->add('startDate3', DateType::class, ['label' => 'Start Date','required' => false])
            ->add('endDate3', DateType::class, ['label' => 'End Date','required' => false])
            ->add('save', SubmitType::class, ['label' => 'Add Company'])
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $add = $form->getData();

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($add);
                $entityManager->flush();
                return $this->redirectToRoute('listCompanies');
        }


            return $this->render('addCompany.html.twig', [
                'form' => $form->createView(),
            ]);

    }

    public function listCompanies(Request $request){
        /** @var Company[] $companies */
        $companies = $this->getDoctrine()
            ->getRepository(Company::class)
            ->findAll();

        return $this->render('listCompanies.html.twig', ['companies' => $companies]);

    }

    public function editCompany(Request $request, $id){
        $company   = $this->getDoctrine()
            ->getRepository(Company::class)
            ->findOneBy(['id' => $id]);

        $form =  $form = $this->createForm(CompanyType::class, $company);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $company = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($company);
            $entityManager->flush();

            return $this->redirectToRoute('listCompanies');
        }
        return $this->render('addCompany.html.twig', array('form'=>$form->createView()));

    }

    public function deleteCompany(Request $request, $id){
        $em = $this->getDoctrine()->getManager();
        $company  = $this->getDoctrine()
            ->getRepository(Company::class)
            ->findOneBy(['id' => $id]);
        $em->remove($company);
        $em->flush();

        return $this->redirectToRoute('listCompanies');
    }
}