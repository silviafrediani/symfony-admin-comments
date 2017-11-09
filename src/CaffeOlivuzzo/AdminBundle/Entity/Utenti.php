<?php

namespace CaffeOlivuzzo\AdminBundle\Entity;

/**
 * Utenti
 */
class Utenti
{
    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $denominazione;

    /**
     * @var string
     */
    private $email;

    /**
     * @var \DateTime
     */
    private $ultimoAccesso;

    /**
     * @var string
     */
    private $username;


    /**
     * Set password
     *
     * @param string $password
     *
     * @return Utenti
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set denominazione
     *
     * @param string $denominazione
     *
     * @return Utenti
     */
    public function setDenominazione($denominazione)
    {
        $this->denominazione = $denominazione;

        return $this;
    }

    /**
     * Get denominazione
     *
     * @return string
     */
    public function getDenominazione()
    {
        return $this->denominazione;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Utenti
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set ultimoAccesso
     *
     * @param \DateTime $ultimoAccesso
     *
     * @return Utenti
     */
    public function setUltimoAccesso($ultimoAccesso)
    {
        $this->ultimoAccesso = $ultimoAccesso;

        return $this;
    }

    /**
     * Get ultimoAccesso
     *
     * @return \DateTime
     */
    public function getUltimoAccesso()
    {
        return $this->ultimoAccesso;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }
}
