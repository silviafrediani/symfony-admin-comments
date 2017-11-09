<?php

namespace CaffeOlivuzzo\AdminBundle\Entity;

/**
 * CommentiClienti
 */
class CommentiClienti
{
    /**
     * @var string
     */
    private $nomeCognome;

    /**
     * @var string
     */
    private $commento;

    /**
     * @var \DateTime
     */
    private $data = 'CURRENT_TIMESTAMP';

    /**
     * @var integer
     */
    private $rispondia;

    /**
     * @var integer
     */
    private $approvato;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \CaffeOlivuzzo\AdminBundle\Entity\FotoClienti
     */
    private $idFoto;



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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
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
