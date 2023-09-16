<?php

namespace App\Form;

use App\Entity\Vol;
use phpDocumentor\Reflection\Types\Integer;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;




class VolType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('etat')
            ->add('depart', DateTimeType::class, [
                'date_label' => 'Starts On'])

            ->add('arrive', DateTimeType::class, [
                'date_label' => 'Starts On'])
            ->add('duree', TextType::class)
            ->add('place', IntegerType::class)
            ->add('destination', TextType::class)



            ->add('Submit', SubmitType::class,
                ['label' => 'Ajouter'])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vol::class,
        ]);
    }
}
