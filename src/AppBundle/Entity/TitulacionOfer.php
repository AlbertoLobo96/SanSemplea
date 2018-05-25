<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TitulacionOfer
 *
 * @ORM\Table(name="titulacion_ofer", indexes={@ORM\Index(name="FK_titulacion_ofer_oferta", columns={"Oferta"}), @ORM\Index(name="FK_titulacion_ofer_grado", columns={"Grado"})})
 * @ORM\Entity
 */
class TitulacionOfer
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
     * @var \AppBundle\Entity\Oferta
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Oferta")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Oferta", referencedColumnName="ID")
     * })
     */
    private $oferta;

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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set oferta
     *
     * @param \AppBundle\Entity\Oferta $oferta
     *
     * @return TitulacionOfer
     */
    public function setOferta(\AppBundle\Entity\Oferta $oferta = null)
    {
        $this->oferta = $oferta;

        return $this;
    }

    /**
     * Get oferta
     *
     * @return \AppBundle\Entity\Oferta
     */
    public function getOferta()
    {
        return $this->oferta;
    }

    /**
     * Set grado
     *
     * @param \AppBundle\Entity\Grado $grado
     *
     * @return TitulacionOfer
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
}
