<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class GradoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Nombre',TextType::class, array("label"=>"Siglas del ciclo:","attr"=>array(
                "class" => "form-control form-control-md rounded-0",
            )))
            ->add('Descripcion',TextType::class, array("label"=>"Nombre del ciclo:","attr"=>array(
                "class" => "form-control form-control-md rounded-0",
            )))
            ->add('Enviar',SubmitType::class,array("attr"=>array(
                "class" => "btn btn-md u-btn-3d g-bg-blue g-mr-10 g-mb-15 g-color-white",
                'style' => 'float: left'
            )))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Grado'
        ));
    }
}
