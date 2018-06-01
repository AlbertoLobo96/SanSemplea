<?php
namespace AppBundle\Entity;
/**
 * Created by PhpStorm.
 * User: 2DAW
 * Date: 20/02/2018
 * Time: 16:19
 */
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GradoRepository")
 * @ORM\Table(name="Grado")
 */
class Grado
{
    public function __construct()
    {
        $this->GAlumno = new ArrayCollection();
        $this->GOferta = new ArrayCollection();
    }
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
     */
    private $Nombre;

    /**
     * @ORM\OneToMany(targetEntity="Grado_Alumno", mappedBy="Grado")
     */
    private $GAlumno;

    /**
     * @ORM\OneToMany(targetEntity="Grado_Oferta", mappedBy="Oferta")
     */
    private $GOferta;

    //------------------------------------------------------GETTER Y SETTER--------------------------------------

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->Nombre;
    }

    /**
     * @param mixed $Nombre
     */
    public function setNombre($Nombre)
    {
        $this->Nombre = $Nombre;
    }

}