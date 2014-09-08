<?php

namespace Fao\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Gedmo\Blameable\Traits\BlameableEntity;

/**
 * Docs
 *
 * @ORM\Table(name="docs")
 * @ORM\Entity(repositoryClass="Fao\MainBundle\Entity\DocsRepository")
 * @Vich\Uploadable
 */
class Docs
{
    const STATUS_DRAFT = 'draft';
    const STATUS_PRESENTED = 'presented';
    const STATUS_PUBLISHED = 'published';
    const STATUS_UNPUBLISHED = 'unpublished';
    const STATUS_DELETED = 'deleted';

    /**
     * Hook timestampable behavior
     * updates createdAt, updatedAt fields
     */
    use TimestampableEntity;

    /**
     * Hook blameable behavior
     * updates createdBy, updatedBy fields
     */
    use BlameableEntity;

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
     * @ORM\Column(name="estado", type="string", length=32)
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
     * @ORM\Column(name="resumen", type="text")
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
     * @Assert\NotBlank(message="Seleccione un pais")
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

//    /**
//     * @ORM\OneToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"}, orphanRemoval=true)
//     */
//    private $archivo;

    /**
     * @Vich\UploadableField(mapping="document_file", fileNameProperty="fileName")
     *
     * @var File $flie
     */
    private $file;

    /**
     * @ORM\Column(type="string", length=255, name="file_name")
     *
     * @var string $fileName
     */
    private $fileName;

//    /**
//     * @ORM\Column(name="mime_type", type="string")
//     */
//    private $mimeType;
//
//    /**
//     * @ORM\Column(name="size", type="decimal")
//     * @Gedmo\UploadableFileSize
//     */
//    private $size;

    /**
     * @var string
     *
     * @ORM\Column(name="raw_content", type="text")
     */
    private $rawContent;

    /**
     * @var string
     *
     * @ORM\Column(name="contentFormatter", type="string")
     */
    private $contentFormatter;

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
     * Set rawContent
     *
     * @param string $rawContent
     * @return Docs
     */
    public function setRawContent($rawContent)
    {
        $this->rawContent = $rawContent;

        return $this;
    }

    /**
     * Get rawContent
     *
     * @return string
     */
    public function getRawContent()
    {
        return $this->rawContent;
    }

    /**
     * Set contentFormatter
     *
     * @param string $contentFormatter
     * @return Docs
     */
    public function setContentFormatter($contentFormatter)
    {
        $this->contentFormatter = $contentFormatter;

        return $this;
    }

    /**
     * Get contentFormatter
     *
     * @return string
     */
    public function getContentFormatter()
    {
        return $this->contentFormatter;
    }

    /**
     * Returns the status type list
     *
     * @return array
     */
    public static function getStatusList()
    {
        return array(
            self::STATUS_DRAFT => 'Borrador',
            self::STATUS_PRESENTED => 'Presentado',
            self::STATUS_PUBLISHED => 'Publicado',
            self::STATUS_UNPUBLISHED => 'Despublicado',
            self::STATUS_DELETED => 'Eliminado',
        );
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $file
     */
    public function setFile(File $file)
    {
        $this->file = $file;

        if ($file) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTime('now');
        }
    }

    /**
     * @return File
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param string $fileName
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
    }

    /**
     * @return string
     */
    public function getFileName()
    {
        return $this->fileName;
    }

}
