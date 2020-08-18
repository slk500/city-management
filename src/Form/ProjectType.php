<?php

declare(strict_types=1);

namespace App\Form;


use App\Entity\Project;
use App\Form\Dto\ProjectDto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $comittees = [
            'inne',
            'Środowiska',
            'Architektury',
            'Infrastruktury i Transportu'
        ];

        $districts = [
            'Cała Polska',
            'Cała Warszawa',
            'Bemowo',
            'Białołęka',
            'Bielany',
            'Mokotów',
            'Ochota',
            'Praga-Południe',
            'Praga-Północ',
            'Rembertów',
            'Targówek',
            'Ursus',
            'Ursynów',
            'Wawer',
            'Wesoła',
            'Wilanów',
            'Wola',
            'Włochy',
            'Śródmieście',
            'Żoliborz',
        ];


        $builder
            ->add('name', TextType::class, [
                'constraints' => [new NotBlank(["message" => "Musisz wpisać nazwę"])]
            ])
            ->add('latLng', HiddenType::class)
            ->add('tags', TextType::class)
            ->add('status', TextType::class)
            ->add('description', TextareaType::class)
            ->add('coordinator', TextType::class)
            ->add('phone', TextType::class)
            ->add('link', TextType::class)
            ->add('committee', ChoiceType::class, [
                'choices' => array_combine($comittees, $comittees),
                'constraints' => [new NotBlank()]
            ])
            ->add('district', ChoiceType::class, [
                'choices' => array_combine($districts, $districts),
                'constraints' => [new NotBlank()]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ProjectDto::class
        ]);
    }
}