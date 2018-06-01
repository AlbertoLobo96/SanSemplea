<?php
/**
 * Created by PhpStorm.
 * User: VSPC-GIANTSV5
 * Date: 29/05/2018
 * Time: 15:32
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity()
 * @ORM\Table(name="Grado_Oferta")
 */
class Grado_Oferta
{
    public function __construct()
    {
    }
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @ORM\ManyToOne(targetEntity="Grado", inversedBy="GOferta")
     */
    private $Grado;
    /**
     * @ORM\ManyToOne(targetEntity="Oferta", inversedBy="GOferta")
     */
    private $Oferta;

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
    public function getGrado()
    {
        return $this->Grado;
    }

    /**
     * @param mixed $Grado
     */
    public function setGrado($Grado)
    {
        $this->Grado = $Grado;
    }

    /**
     * @return mixed
     */
    public function getOferta()
    {
        return $this->Oferta;
    }

    /**
     * @param mixed $Oferta
     */
    public function setOferta($Oferta)
    {
        $this->Oferta = $Oferta;
    }



}