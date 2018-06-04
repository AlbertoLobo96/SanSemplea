<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UsuarioType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('NIF',TextType::class, array("label"=>"DNI:","attr"=>array(
                "class" => "form-control form-control-md rounded-0"
            )))
            ->add('Nombre',TextType::class, array("label"=>"Nombre:","attr"=>array(
                "class" => "form-control form-control-md rounded-0"
            )))
            ->add('Apellido',TextType::class, array("label"=>"Apellido:","attr"=>array(
                "class" => "form-control form-control-md rounded-0"
            )))
            ->add('Telefono',TextType::class, array("label"=>"Telefono:","attr"=>array(
                "class" => "form-control form-control-md rounded-0"
            )))
            ->add('Email',EmailType::class, array("label"=>"Email:","attr"=>array(
                "class" => "form-control form-control-md rounded-0"
            )))
            ->add('Foto',FileType::class,array(
                "label"=>"Foto:",
                "attr"=>array("class" => "form-control form-control-md rounded-0"),
                "data_class" => null
            ))
            ->add('Passwd',PasswordType::class, array("label"=>"Passwd:","attr"=>array(
                "class" => "form-control form-control-md rounded-0"
            )))
            ->add('Rol', ChoiceType::class, array("label" => "Rol:", "attr" => array(
                "class" => "form-control"),
                'choices' => array(
                    'Administrador' => 'ROLE_ADMIN',
                    'Alumno' => 'ROLE_USER',
                )))
            ->add('Curso',TextType::class, array("label"=>"Curso:","attr"=>array(
                "class" => "form-control form-control-md rounded-0"
            )))
            ->add('Recibir', ChoiceType::class, array("label" => "Recibir notificacion:", "attr" => array(
                "class" => "form-control"),
                'choices' => array(
                    'Si' => 1,
                    'No' => 0,
                )))
            ->add('Grados', EntityType::class,array(
                "attr"=>array(
                    "class" => "form-control form-control-md rounded-0"
                ),
                "label"=>"Grados:",
                'class' => 'AppBundle:Grado',
                'choice_label' => 'Nombre',
                'multiple' => "multiple"
            ))
            ->add('Guardar',SubmitType::class,array("attr"=>array(
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
            'data_class' => 'AppBundle\Entity\Usuario'
        ));
    }
}
