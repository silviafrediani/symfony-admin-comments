<?php

namespace CaffeOlivuzzo\AdminBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * FotoClienti
 *
 * @ORM\Table(name="foto_clienti")
 * @ORM\Entity
 */
class FotoClienti
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="foto", type="string", length=500, nullable=false)
     * @Assert\File(
     *     maxSize = "5M",
     *     mimeTypes = {"image/jpeg", "image/gif", "image/png", "image/tiff"},
     *     maxSizeMessage = "The maxmimum allowed file size is 5MB.",
     *     mimeTypesMessage = "Only the filetypes image are allowed."
     * )
     */
    private $foto;

    /**
     * @var string
     *
     * @ORM\Column(name="testo_alternativo", type="string", length=500, nullable=false)
     */
    private $testoAlternativo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data", type="datetime", nullable=false)
     */
    private $data;

    /**
     * @var integer
     *
     * @ORM\Column(name="approvato", type="integer", nullable=false)
     */
    private $approvato;


    /**
     * @ORM\OneToMany(targetEntity="CommentiClienti", mappedBy="idFoto")
     */
    protected $comments;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
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

    /**
     * Set foto
     *
     * @param string $foto
     *
     * @return FotoClienti
     */
    public function setFoto($foto)
    {
        $this->foto = $foto;

        return $this;
    }

    /**
     * Get foto
     *
     * @return string
     */
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * Set testoAlternativo
     *
     * @param string $testoAlternativo
     *
     * @return FotoClienti
     */
    public function setTestoAlternativo($testoAlternativo)
    {
        $this->testoAlternativo = $testoAlternativo;

        return $this;
    }

    /**
     * Get testoAlternativo
     *
     * @return string
     */
    public function getTestoAlternativo()
    {
        return $this->testoAlternativo;
    }

    /**
     * Set data
     *
     * @param \DateTime $data
     *
     * @return FotoClienti
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get data
     *
     * @return \DateTime
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set approvato
     *
     * @param integer $approvato
     *
     * @return FotoClienti
     */
    public function setApprovato($approvato)
    {
        $this->approvato = $approvato;

        return $this;
    }

    /**
     * Get approvato
     *
     * @return integer
     */
    public function getApprovato()
    {
        return $this->approvato;
    }

    /**
     * Add comment
     *
     * @param \CaffeOlivuzzo\AdminBundle\Entity\CommentiClienti $comment
     *
     * @return FotoClienti
     */
    public function addComment(\CaffeOlivuzzo\AdminBundle\Entity\CommentiClienti $comment)
    {
        $this->comments[] = $comment;

        return $this;
    }

    /**
     * Remove comment
     *
     * @param \CaffeOlivuzzo\AdminBundle\Entity\CommentiClienti $comment
     */
    public function removeComment(\CaffeOlivuzzo\AdminBundle\Entity\CommentiClienti $comment)
    {
        $this->comments->removeElement($comment);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComments()
    {
        return $this->comments;
    }
}
