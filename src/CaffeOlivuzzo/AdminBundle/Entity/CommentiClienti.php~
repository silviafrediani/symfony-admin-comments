<?php

namespace CaffeOlivuzzo\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CommentiClienti
 *
 * @ORM\Table(name="commenti_clienti", indexes={@ORM\Index(name="id_foto", columns={"id_foto"})})
 * @ORM\Entity
 */
class CommentiClienti
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
     * @ORM\Column(name="nome_cognome", type="string", length=500, nullable=false)
     */
    private $nomeCognome;

    /**
     * @var string
     *
     * @ORM\Column(name="commento", type="text", length=65535, nullable=false)
     */
    private $commento;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data", type="datetime", nullable=false)
     */
    private $data;

    /**
     * @var integer
     *
     * @ORM\Column(name="rispondia", type="integer", nullable=true)
     */
    private $rispondia;

    /**
     * @var integer
     *
     * @ORM\Column(name="approvato", type="integer", nullable=false)
     */
    private $approvato;

    /**
     * @var \FotoClienti
     *
     * @ORM\ManyToOne(targetEntity="FotoClienti", inversedBy="comments")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_foto", referencedColumnName="id")
     * })
     */
    private $idFoto;



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
     * Set nomeCognome
     *
     * @param string $nomeCognome
     *
     * @return CommentiClienti
     */
    public function setNomeCognome($nomeCognome)
    {
        $this->nomeCognome = $nomeCognome;

        return $this;
    }

    /**
     * Get nomeCognome
     *
     * @return string
     */
    public function getNomeCognome()
    {
        return $this->nomeCognome;
    }

    /**
     * Set commento
     *
     * @param string $commento
     *
     * @return CommentiClienti
     */
    public function setCommento($commento)
    {
        $this->commento = $commento;

        return $this;
    }

    /**
     * Get commento
     *
     * @return string
     */
    public function getCommento()
    {
        return $this->commento;
    }

    /**
     * Set data
     *
     * @param \DateTime $data
     *
     * @return CommentiClienti
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
     * Set rispondia
     *
     * @param integer $rispondia
     *
     * @return CommentiClienti
     */
    public function setRispondia($rispondia)
    {
        $this->rispondia = $rispondia;

        return $this;
    }

    /**
     * Get rispondia
     *
     * @return integer
     */
    public function getRispondia()
    {
        return $this->rispondia;
    }

    /**
     * Set approvato
     *
     * @param integer $approvato
     *
     * @return CommentiClienti
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
     * Set idFoto
     *
     * @param \CaffeOlivuzzo\AdminBundle\Entity\FotoClienti $idFoto
     *
     * @return CommentiClienti
     */
    public function setIdFoto(\CaffeOlivuzzo\AdminBundle\Entity\FotoClienti $idFoto = null)
    {
        $this->idFoto = $idFoto;

        return $this;
    }

    /**
     * Get idFoto
     *
     * @return \CaffeOlivuzzo\AdminBundle\Entity\FotoClienti
     */
    public function getIdFoto()
    {
        return $this->idFoto;
    }
}
