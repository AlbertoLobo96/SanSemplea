<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OfertaRepository")
 * @ORM\Table(name="Oferta")
 */
class Oferta
{
    public function __construct()
    {
        $this->Grados = new ArrayCollection();
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
     * @Assert\Regex(
     *      pattern="/.+\@([a-zA-Z]|[0-9])+\.[a-z]+/",
     *      message="Email incorrecto"
     * )
     */
    private $Email;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\Regex(
     *      pattern="/[0-9]{9}/",
     *      message="Telefono incorrecto"
     * )
     */
    private $Telefono;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $Tipo;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $Descripcion;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $Enlaces;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $Archivos;
    /**
     * @ORM\Column(type="integer")
     */
    private $Validar;
    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Grado", inversedBy="Ofertas")
     * @ORM\JoinTable(name="Grados_Ofertas")
     */
    private $Grados;



    //-------------------------------------------------------GETTER Y SETTER-------------------
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
    public function getEmail()
    {
        return $this->Email;
    }

    /**
     * @param mixed $Email
     */
    public function setEmail($Email)
    {
        $this->Email = $Email;
    }

    /**
     * @return mixed
     */
    public function getTelefono()
    {
        return $this->Telefono;
    }

    /**
     * @param mixed $Telefono
     */
    public function setTelefono($Telefono)
    {
        $this->Telefono = $Telefono;
    }

    /**
     * @return mixed
     */
    public function getTipo()
    {
        return $this->Tipo;
    }

    /**
     * @param mixed $Tipo
     */
    public function setTipo($Tipo)
    {
        $this->Tipo = $Tipo;
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

    /**
     * @return mixed
     */
    public function getEnlaces()
    {
        return $this->Enlaces;
    }

    /**
     * @param mixed $Enlaces
     */
    public function setEnlaces($Enlaces)
    {
        $this->Enlaces = $Enlaces;
    }

    /**
     * @return mixed
     */
    public function getArchivos()
    {
        return $this->Archivos;
    }

    /**
     * @param mixed $Archivos
     */
    public function setArchivos($Archivos)
    {
        $this->Archivos = $Archivos;
    }

    /**
     * @return mixed
     */
    public function getValidar()
    {
        return $this->Validar;
    }

    /**
     * @param mixed $Validar
     */
    public function setValidar($Validar)
    {
        $this->Validar = $Validar;
    }

    /**
     * @return mixed
     */
    public function getGrados()
    {
        return $this->Grados;
    }
    public function addGrado(...$grados)
    {
        foreach ( $grados as $grado) {
            if (!$this->Grados->contains($grado)) {
                $this->Grados->add($grado);
            }
        }
    }
    public function removeGrado($grado){
        $this->Grados->removeElement($grado);
    }

}
