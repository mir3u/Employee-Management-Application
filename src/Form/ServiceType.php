<?php

namespace App\Form;

use App\Entity\Customer;
use App\Entity\Service;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ServiceType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder,array $options) {
        $builder
            ->add('type',TextType::class,['label'=>'Type',])
            ->add('currency',TextType::class,['label'=>'Currency'])
            ->add('details',TextType::class,['label'=>'Details',])
            ->add('startDate',DateType::class,['label'=>'Start Date'])
            ->add('endDate',DateType::class,['label'=>'End  Date'])
            ->add('price',TextType::class,['label'=>'Price'])
            ->add('save',SubmitType::class,['label'=>'Save service'])
            ->getForm();
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class'=>Service::class,
        ]);
    }}