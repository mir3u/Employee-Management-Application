<?php


namespace App\Form;


use App\Entity\Employee;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmployeeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class)
            ->add('lastname', TextType::class)
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
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Employee::class
        ]);
    }
}