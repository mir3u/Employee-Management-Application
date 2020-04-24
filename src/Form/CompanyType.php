<?php


namespace App\Form;


use App\Entity\Company;
use App\Entity\Employee;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompanyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
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
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Company::class
        ]);
    }

}