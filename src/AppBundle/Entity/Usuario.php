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
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UsuarioRepository")
 * @ORM\Table(name="Usuario")
 */
class Usuario implements UserInterface
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
     * @ORM\Column(type="string", length=9)
     * @Assert\Regex(
     *      pattern="/[0-9]{8}[A-Za-z]{1}/",
     *      message="NIF incorrecto"
     * )
     * @Assert\Length(
     *      min="9",
     *      max="9",
     *     exactMessage="El Nif debe tener 9 caracteres"
     * )
     * @Assert\NotBlank()
     */
    private $NIF;
    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
     */
    private $Nombre;
    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
     */
    private $Apellido;
    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\Regex(
     *      pattern="/[0-9]{9}/",
     *      message="Telefono incorrecto"
     * )
     */
    private $Telefono;
    /**
     * @ORM\Column(type="string", length=100, unique=true)
     * @Assert\Regex(
     *      pattern="/.+\@([a-zA-Z]|[0-9])+\.[a-z]+/",
     *      message="Email incorrecto"
     * )
     */
    private $Email;
    /**
     * @ORM\Column(type="string", length=100)
     */
    private $Foto;
    /**
     * @ORM\Column(type="string", length=100)
     */
    private $Passwd;
    /**
     * @ORM\Column(type="string", length=100)
     */
    private $Rol;
    /**
     * @ORM\Column(type="string", length=100)
     */
    private $Curso;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Grado", inversedBy="Alumnos")
     * @ORM\JoinTable(name="Grados_Alumnos")
     */
    private $Grados;

    //--------------------------------------------Metodos para autentificacion
    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->getEmail();
    }
    public function getSalt()
    {
        return null;
    }
    public function getRoles()
    {
        return array($this->getRol());
    }
    public function eraseCredentials()
    {
        return null;
    }
    public function getPassword()
    {
        return $this->getPasswd();
    }
    //--------------------------------------------SETTERS Y GETTERS------------------------------------------------
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
    public function getNIF()
    {
        return $this->NIF;
    }

    /**
     * @param mixed $NIF
     */
    public function setNIF($NIF)
    {
        $this->NIF = $NIF;
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
    public function getApellido()
    {
        return $this->Apellido;
    }

    /**
     * @param mixed $Apellido
     */
    public function setApellido($Apellido)
    {
        $this->Apellido = $Apellido;
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
    public function getFoto()
    {
        return $this->Foto;
    }

    /**
     * @param mixed $Foto
     */
    public function setFoto($Foto)
    {
        $this->Foto = $Foto;
    }

    /**
     * @return mixed
     */
    public function getPasswd()
    {
        return $this->Passwd;
    }

    /**
     * @param mixed $Passwd
     */
    public function setPasswd($Passwd)
    {
        $this->Passwd = $Passwd;
    }

    /**
     * @return mixed
     */
    public function getCurso()
    {
        return $this->Curso;
    }

    /**
     * @param mixed $Curso
     */
    public function setCurso($Curso)
    {
        $this->Curso = $Curso;
    }

    /**
     * @return mixed
     */
    public function getRol()
    {
        return $this->Rol;
    }

    /**
     * @param mixed $Rol
     */
    public function setRol($Rol)
    {
        $this->Rol = $Rol;
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