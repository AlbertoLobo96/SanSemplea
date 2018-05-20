<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Titulacion
 *
 * @ORM\Table(name="titulacion", indexes={@ORM\Index(name="FK_titulacion_alumno", columns={"Alumno"}), @ORM\Index(name="FK_titulacion_grado", columns={"Grado"})})
 * @ORM\Entity
 */
class Titulacion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Grado
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Grado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Grado", referencedColumnName="ID")
     * })
     */
    private $grado;

    /**
     * @var \AppBundle\Entity\Usuario
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Alumno", referencedColumnName="ID")
     * })
     */
    private $alumno;



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set grado
     *
     * @param \AppBundle\Entity\Grado $grado
     *
     * @return Titulacion
     */
    public function setGrado(\AppBundle\Entity\Grado $grado = null)
    {
        $this->grado = $grado;

        return $this;
    }

    /**
     * Get grado
     *
     * @return \AppBundle\Entity\Grado
     */
    public function getGrado()
    {
        return $this->grado;
    }

    /**
     * Set alumno
     *
     * @param \AppBundle\Entity\Usuario $alumno
     *
     * @return Titulacion
     */
    public function setAlumno(\AppBundle\Entity\Usuario $alumno = null)
    {
        $this->alumno = $alumno;

        return $this;
    }

    /**
     * Get alumno
     *
     * @return \AppBundle\Entity\Usuario
     */
    public function getAlumno()
    {
        return $this->alumno;
    }
}
