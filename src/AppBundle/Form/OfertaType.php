<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class OfertaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Nombre',TextType::class, array("label"=>"Nombre Empresa:","attr"=>array(
                "class" => "form-control form-control-md rounded-0",
            )))
            ->add('Email',EmailType::class, array("label"=>"Email Empresa:","attr"=>array(
                "class" => "form-control form-control-md rounded-0",
                "required" => false
            )))
            ->add('Telefono',TextType::class, array("label"=>"Telefono Empresa:","attr"=>array(
                "class" => "form-control form-control-md rounded-0",
                "required" => false
            )))
            ->add('Tipo', ChoiceType::class, array("label" => "Tipo de Oferta:", "attr" => array(
                "class" => "form-control"),
                'choices' => array(
                    'Oferta De Trabajo' => 1,
                    'Beca de Formación' => 2,
                    'Curso de Formación' => 3,
                    'Consurso' => 4,
                    'Otro'=> 5
                )))
            ->add('Descripcion',TextareaType::class, array("label"=>"Descripcion de la oferta:","attr"=>array(
                "class" => "form-control form-control-md u-textarea-expandable rounded-0",
                "required" => false
            )))
            ->add('Enlaces',TextType::class, array("label"=>"Enlaces de Interés:","attr"=>array(
                "class" => "form-control form-control-md rounded-0",
                "required" => false
            )))
            ->add('Archivos',FileType::class,array(
                "label"=>"Archivos de Interés:",
                "attr"=>array("class" => "form-control form-control-md rounded-0"),
                "data_class" => null,
                "required" => false
            ))
            ->add('Grados', EntityType::class,array(
                "attr"=>array(
                    "class" => "form-control form-control-md rounded-0"
                ),
                "label"=>"Grados:",
                'class' => 'AppBundle:Grado',
                'choice_label' => 'descripcion',
                'multiple' => "multiple"
            ))
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
            'data_class' => 'AppBundle\Entity\Oferta'
        ));
    }
}
