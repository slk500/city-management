<?php

declare(strict_types=1);

namespace App\Form;


use App\Form\Dto\AreaDto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class AreaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'constraints' => [new NotBlank(["message" => "Musisz wpisać nazwę"])]
            ])
            ->add('latLng', HiddenType::class,
                [
                    'error_bubbling'=> false,
                    'constraints' => [new NotBlank(["message" => "Musisz zaznaczyć dany obszar na mapie"])],
                ])
            ->add('tags', TextType::class)
            ->add('status', TextType::class)
            ->add('description', TextareaType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AreaDto::class
        ]);
    }
}