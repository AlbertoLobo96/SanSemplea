<?php
namespace AppBundle\Entity;
/**
 * Created by PhpStorm.
 * User: 2DAW
 * Date: 20/02/2018
 * Time: 16:19
 */
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="Grado_Alumno")
 */
class Grado_Alumno
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
     * @ORM\ManyToOne(targetEntity="Grado", inversedBy="GAlumno")
     */
    private $Grado;
    /**
     * @ORM\ManyToOne(targetEntity="Usuario", inversedBy="GAlumno")
     */
    private $Alumno;

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
    public function getAlumno()
    {
        return $this->Alumno;
    }

    /**
     * @param mixed $Alumno
     */
    public function setAlumno($Alumno)
    {
        $this->Alumno = $Alumno;
    }


}