<?php


namespace App\Form;


use App\Entity\Bill;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OfferType  extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('offerName',TextType::class, array( 'required' => true))
            ->add('service1', TextType::class, array( 'required' => true))
            ->add('service2', TextType::class)
            ->add('service3', TextType::class)
            ->add('price', TextType::class, array( 'required' => true))
            ->add('save', SubmitType::class, ['label' => 'Save'])
            ->getForm();
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Offer::class
        ]);
    }
}