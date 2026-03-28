<?php
namespace App\Form;

use App\Entity\Event;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title',       TextType::class,     ['label' => 'Titre',       'attr' => ['class' => 'form-control']])
            ->add('description', TextareaType::class,  ['label' => 'Description', 'attr' => ['class' => 'form-control']])
            ->add('date',        DateTimeType::class,  ['label' => 'Date',        'widget' => 'single_text', 'attr' => ['class' => 'form-control']])
            ->add('location',    TextType::class,     ['label' => 'Lieu',        'attr' => ['class' => 'form-control']])
            ->add('seats',       IntegerType::class,  ['label' => 'Places',      'attr' => ['class' => 'form-control']])
            ->add('image',       TextType::class,     ['label' => 'Image (URL)', 'attr' => ['class' => 'form-control'], 'required' => false])
            ->add('submit', SubmitType::class, ['label' => 'Enregistrer', 'attr' => ['class' => 'btn btn-success mt-3']]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => Event::class]);
    }
}