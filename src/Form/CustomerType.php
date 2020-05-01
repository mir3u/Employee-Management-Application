<?php

namespace App\Form;

use App\Entity\Customer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CustomerType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder,array $options) {
        $builder
            ->add('details',TextType::class,['label'=>'Details',])
            ->add('email',TextType::class,['label'=>'Email'])
            ->add('phoneNo',TextType::class,['label'=>'Phone number'])
            ->add('location',TextType::class,['label'=>'Location'])
            ->add('dueDate',DateType::class,['label'=>'Due Date'])
            ->add('feedback',TextType::class,['label'=>'Feedback','required'=>FALSE])
            ->add('save',SubmitType::class,['label'=>'Add customer'])
            ->getForm();
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class'=>Customer::class,
        ]);
    }

}