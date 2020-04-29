<?php


namespace App\Form;


use App\Entity\Meeting;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MeetingType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('start',
                DateTimeType::class, array('attr' => array('class' => 'password-field'), 'required' => true))
            ->add('location', TextType::class)
            ->add('hall', TextType::class)
            ->add('equipment', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'Save'])
            ->getForm();
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Meeting::class
        ]);
    }
}