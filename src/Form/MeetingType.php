<?php


namespace App\Form;


use App\Entity\Employee;
use App\Entity\Meeting;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MeetingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $participants = $options['attr']['participants'];
        $builder
            ->add('start',
                DateTimeType::class, array('attr' => array( 'required' => true)))
            ->add('location', TextType::class)
            ->add('hall', TextType::class)
            ->add('equipment', TextType::class)
            ->add('attendees', ChoiceType::class, [
//                'class'=>Employee::class,
                'choices' => $participants,
                'choice_label' => function ($participant) {
                    return $participant->getFirstName().' '.$participant->getLastName();},
                'required' => false,
                'expanded' => true,
                'multiple' => true
            ])
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