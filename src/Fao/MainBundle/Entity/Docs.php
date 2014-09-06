<?php

namespace Fao\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Docs
 *
 * @ORM\Table(name="docs")
 * @ORM\Entity(repositoryClass="Fao\MainBundle\Entity\DocsRepository")
 */
class Docs
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


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
     * @var string
     * @Assert\NotBlank(message="Seleccione el estado del documento")
     * @ORM\Column(name="estado", type="string", length=255)
     */
    private $estado;

    /**
     * @var string
     * @Assert\NotBlank(message="Escriba el titulo del documento")
     * @ORM\Column(name="titulo", type="string", length=255)
     */
    private $titulo;

    /**
     * @var string
     * @Assert\NotBlank(message="Escriba el resumen del documento")
     * @ORM\Column(name="resumen", type="text", length=10000)
     */
    private $resumen;

    /**
     * @var string
     * @Assert\NotBlank(message="Escriba el autor del documento")
     * @ORM\Column(name="autor", type="string", length=150)
     */
    private $autor;

    /**
     * @var string
     * @Assert\NotBlank(message="Escriba el nivel del docuemnto")
     * @ORM\Column(name="nivel", type="string", length=255)
     */
    private $nivel;

    /**
     * @var string
     * @Assert\NotBlank(message="Escriba el nombre del instituto al que pertenece")
     * @ORM\Column(name="instituto", type="string", length=255)
     */
    private $instituto;

    /**
     * @var string
     * @Assert\NotBlank(message="Escriba el pais de prosedencia")
     * @ORM\Column(name="pais", type="string", length=255)
     */
    private $pais;

    /**
     * @var \DateTime
     * @Assert\Date(message="Seleccione una fecha")
     * @Assert\NotBlank(message="Seleccione una fecha")
     * @ORM\Column(name="anno", type="date")
     */
    private $anno;

    /**
     * @var \DateTime
     * @Assert\NotBlank(message="Ponga la fecha del documento")
     * @ORM\Column(name="fecha_de_publicacion", type="date", nullable = true)
     */
    private $fechaDePublicacion;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"all"})
     */
    private $archivo;

    /**
     * Set estado
     *
     * @param string $estado
     * @return Docs
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set titulo
     *
     * @param string $titulo
     * @return Docs
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get titulo
     *
     * @return string 
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set resumen
     *
     * @param string $resumen
     * @return Docs
     */
    public function setResumen($resumen)
    {
        $this->resumen = $resumen;

        return $this;
    }

    /**
     * Get resumen
     *
     * @return string 
     */
    public function getResumen()
    {
        return $this->resumen;
    }

    /**
     * Set autor
     *
     * @param string $autor
     * @return Docs
     */
    public function setAutor($autor)
    {
        $this->autor = $autor;

        return $this;
    }

    /**
     * Get autor
     *
     * @return string 
     */
    public function getAutor()
    {
        return $this->autor;
    }

    /**
     * Set nivel
     *
     * @param string $nivel
     * @return Docs
     */
    public function setNivel($nivel)
    {
        $this->nivel = $nivel;

        return $this;
    }

    /**
     * Get nivel
     *
     * @return string 
     */
    public function getNivel()
    {
        return $this->nivel;
    }

    /**
     * Set instituto
     *
     * @param string $instituto
     * @return Docs
     */
    public function setInstituto($instituto)
    {
        $this->instituto = $instituto;

        return $this;
    }

    /**
     * Get instituto
     *
     * @return string 
     */
    public function getInstituto()
    {
        return $this->instituto;
    }

    /**
     * Set pais
     *
     * @param string $pais
     * @return Docs
     */
    public function setPais($pais)
    {
        $this->pais = $pais;

        return $this;
    }

    /**
     * Get pais
     *
     * @return string 
     */
    public function getPais()
    {
        return $this->pais;
    }

    /**
     * Set anno
     *
     * @param \DateTime $anno
     * @return Docs
     */
    public function setAnno($anno)
    {
        $this->anno = $anno;

        return $this;
    }

    /**
     * Get anno
     *
     * @return \DateTime 
     */
    public function getAnno()
    {
        return $this->anno;
    }

    /**
     * Set fechaDePublicacion
     *
     * @param \DateTime $fechaDePublicacion
     * @return Docs
     */
    public function setFechaDePublicacion($fechaDePublicacion = null)
    {
        $this->fechaDePublicacion = $fechaDePublicacion;

        return $this;
    }

    /**
     * Get fechaDePublicacion
     *
     * @return \DateTime 
     */
    public function getFechaDePublicacion()
    {
        return $this->fechaDePublicacion;
    }

    /**
     * Set archivo
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $archivo
     * @return Docs
     */
    public function setArchivo(\Application\Sonata\MediaBundle\Entity\Media $archivo = null)
    {
        $this->archivo = $archivo;

        return $this;
    }

    /**
     * Get archivo
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media
     */
    public function getArchivo()
    {
        return $this->archivo;
    }

    /**
     * Set archivo
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $user
     * @return Docs
     */
    public function setUser(\Application\Sonata\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media
     */
    public function getUser()
    {
        return $this->user;
    }
}
