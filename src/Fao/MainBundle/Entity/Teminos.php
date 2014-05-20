<?php

namespace Fao\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Teminos
 *
 * @ORM\Table(name="teminos")
 * @ORM\Entity(repositoryClass="Fao\MainBundle\Entity\TeminosRepository")
 */
class Teminos
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
     * @var string
     *
     * @ORM\Column(name="terminos", type="text")
     */
    private $terminos;

    /**
     * @var string
     *
     * @ORM\Column(name="contentFormatter", type="string")
     */
    private $contentFormatter;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;


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
     * Set terminos
     *
     * @param string $terminos
     * @return Teminos
     */
    public function setTerminos($terminos)
    {
        $this->terminos = $terminos;

        return $this;
    }

    /**
     * Get terminos
     *
     * @return string 
     */
    public function getTerminos()
    {
        return $this->terminos;
    }

    /**
     * Set contentFormatter
     *
     * @param string $contentFormatter
     * @return ContentFormatter
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
     * Set content
     *
     * @param string $content
     * @return Content
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }
}
