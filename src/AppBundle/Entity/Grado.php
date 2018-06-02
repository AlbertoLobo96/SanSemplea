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
        $this->Alumnos = new ArrayCollection();
        $this->Ofertas = new ArrayCollection();
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
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
     */
    private $Descripcion;
    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Usuario", mappedBy="Grados")
     */
    private $Alumnos;
    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Oferta", mappedBy="Grados")
     */
    private $Ofertas;

    //------------------------------------------------------GETTER Y SETTER--------------------------------------

    public function getOfertas()
    {
        return $this->Ofertas;
    }
    public function addOferta(...$Ofertas)
    {
        foreach ( $Ofertas as $oferta) {
            if (!$this->Ofertas->contains($oferta)) {
                $this->Ofertas->add($oferta);
            }
        }
    }
    public function removeOferta($oferta){
        $this->Ofertas->removeElement($oferta);
    }

    public function getAlumnos()
    {
        return $this->Alumnos;
    }
    public function addAlumno(...$Alumnos)
    {
        foreach ( $Alumnos as $alumno) {
            if (!$this->Alumnos->contains($alumno)) {
                $this->Alumnos->add($alumno);
            }
        }
    }
    public function removeAlumno($alumno){
        $this->Alumnos->removeElement($alumno);
    }
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

    /**
     * @return mixed
     */
    public function getDescripcion()
    {
        return $this->Descripcion;
    }

    /**
     * @param mixed $Descripcion
     */
    public function setDescripcion($Descripcion)
    {
        $this->Descripcion = $Descripcion;
    }

}