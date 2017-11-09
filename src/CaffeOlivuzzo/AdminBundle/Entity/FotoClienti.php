<?php

namespace CaffeOlivuzzo\AdminBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * FotoClienti
 */
class FotoClienti
{
    /**
     * @var string
     */
    private $foto;

    /**
     * @var string
     */
    private $testoAlternativo;

    /**
     * @var \DateTime
     */
    private $data = 'CURRENT_TIMESTAMP';

    /**
     * @var integer
     */
    private $approvato;

    /**
     * @var integer
     */
    private $id;




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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
