<?php


namespace App\Controller;


use App\Entity\Employee;
use App\Entity\User;
use App\Form\EmployeeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\HttpFoundation\Request;

class EmployeeController extends AbstractController
{
    public function add(Request $request)
    {
        $add = new Employee();
        $form = $this->createFormBuilder($add)
            ->add('firstname', TextType::class, ['label' => 'First Name'])
            ->add('lastname', TextType::class, ['label' => 'Last Name'])
            ->add('address', TextType::class)
            ->add('telephone', TextType::class)
            ->add('email', EmailType::class)
            ->add('certification', TextType::class)
            ->add('availabilityStart1', TimeType::class, ['label' => 'Monday Start'])
            ->add('availabilityEnd1', TimeType::class, ['label' => 'Monday End'])
            ->add('availabilityStart2', TimeType::class, ['label' => 'Tuesday Start'])
            ->add('availabilityEnd2', TimeType::class, ['label' => 'Tuesday End'])
            ->add('availabilityStart3', TimeType::class, ['label' => 'Wednesday Start'])
            ->add('availabilityEnd3', TimeType::class, ['label' => 'Wednesday End'])
            ->add('availabilityStart4', TimeType::class, ['label' => 'Thursday Start'])
            ->add('availabilityEnd4', TimeType::class, ['label' => 'Thursday End'])
            ->add('availabilityStart5', TimeType::class, ['label' => 'Friday Start'])
            ->add('availabilityEnd5', TimeType::class, ['label' => 'Friday End'])
            ->add('payment', TextType::class)
            ->add('hours', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'Add Employee'])
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $add = $form->getData();


            if(!filter_var($add->getEmail(), FILTER_VALIDATE_EMAIL)) {
                return $this->redirectToRoute('errorPage', [
                    'error' => "bad email "]);
            }else{
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($add);
                $entityManager->flush();
                return $this->redirectToRoute('listEmployees');}
        }else{

            return $this->render('addEmployee.html.twig', [
                'form' => $form->createView(),
            ]);}

    }

    public function listEmployees(Request $request){
        /** @var Employee[] $employees */
        $employees = $this->getDoctrine()
            ->getRepository(Employee::class)
            ->findAll();

        return $this->render('listEmployees.html.twig', ['employees' => $employees]);

    }

    public function editEmployee(Request $request, $id){
        $employee  = $this->getDoctrine()
            ->getRepository(Employee::class)
            ->findOneBy(['id' => $id]);

        $form =  $form = $this->createForm(EmployeeType::class, $employee);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $employee = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($employee);
            $entityManager->flush();

            return $this->redirectToRoute('listEmployees');
        }
        return $this->render('addEmployee.html.twig', array('form'=>$form->createView()));

    }

    public function deleteEmployee(Request $request, $id){
        $em = $this->getDoctrine()->getManager();
        $employee  = $this->getDoctrine()
            ->getRepository(Employee::class)
            ->findOneBy(['id' => $id]);
        $em->remove($employee);
        $em->flush();

        return $this->redirectToRoute('listEmployees');
    }
}