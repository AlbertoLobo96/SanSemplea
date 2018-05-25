<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Oferta
 *
 * @ORM\Table(name="oferta")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OfertaRepository")
 */
class Oferta
{
    /**
     * @var string
     *
     * @ORM\Column(name="Nombre_Emp", type="string", length=50, nullable=true)
     */
    private $nombreEmp;

    /**
     * @var string
     *
     * @ORM\Column(name="Email", type="string", length=50, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="Telefono", type="string", length=50, nullable=true)
     */
    private $telefono;

    /**
     * @var integer
     *
     * @ORM\Column(name="Tipo", type="integer", nullable=true)
     */
    private $tipo;

    /**
     * @var string
     *
     * @ORM\Column(name="Descripcion", type="string", length=200, nullable=true)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="Enlaces", type="string", length=200, nullable=true)
     */
    private $enlaces;

    /**
     * @var integer
     *
     * @ORM\Column(name="Validar", type="integer", nullable=true)
     */
    private $validar;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set nombreEmp
     *
     * @param string $nombreEmp
     *
     * @return Oferta
     */
    public function setNombreEmp($nombreEmp)
    {
        $this->nombreEmp = $nombreEmp;

        return $this;
    }

    /**
     * Get nombreEmp
     *
     * @return string
     */
    public function getNombreEmp()
    {
        return $this->nombreEmp;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Oferta
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     *
     * @return Oferta
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set tipo
     *
     * @param integer $tipo
     *
     * @return Oferta
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return integer
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Oferta
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set enlaces
     *
     * @param string $enlaces
     *
     * @return Oferta
     */
    public function setEnlaces($enlaces)
    {
        $this->enlaces = $enlaces;

        return $this;
    }

    /**
     * Get enlaces
     *
     * @return string
     */
    public function getEnlaces()
    {
        return $this->enlaces;
    }

    /**
     * Set validar
     *
     * @param integer $validar
     *
     * @return Oferta
     */
    public function setValidar($validar)
    {
        $this->validar = $validar;

        return $this;
    }

    /**
     * Get validar
     *
     * @return integer
     */
    public function getValidar()
    {
        return $this->validar;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
