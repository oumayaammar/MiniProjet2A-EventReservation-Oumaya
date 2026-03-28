<?php
namespace App\Form;

use App\Entity\Reservation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',  TextType::class,  ['label' => 'Nom complet', 'attr' => ['class' => 'form-control']])
            ->add('email', EmailType::class,  ['label' => 'Email',       'attr' => ['class' => 'form-control']])
            ->add('phone', TextType::class,  ['label' => 'Téléphone',   'attr' => ['class' => 'form-control']])
            ->add('submit', SubmitType::class, ['label' => 'Réserver', 'attr' => ['class' => 'btn btn-primary mt-3']]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => Reservation::class]);
    }
}