<?php

namespace App\DTO;

class ProviderDTO
{
    /** @var integer */
    private $providerId;

    /** @var string */
    private $providerName;

    /** @var string */
    private $email;

    /** @var string */
    private $phoneNumber;

    /** @var boolean */
    private $active;

    /** @var string */
    private $dateCreated;

    /** @var string */
    private $dateUpdated;

    /** @var integer */
    private $providerTypeId;


    /**
     * @return int
     */
    public function getProviderId()
    {
        return $this->providerId;
    }

    /**
     * @param int $providerId
     * @return ProviderDTO
     */
    public function setProviderId($providerId)
    {
        $this->providerId = $providerId;
        return $this;
    }

    /**
     * @return string
     */
    public function getProviderName()
    {
        return $this->providerName;
    }

    /**
     * @param string $providerName
     * @return ProviderDTO
     */
    public function setProviderName($providerName)
    {
        $this->providerName = $providerName;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return ProviderDTO
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * @param string $phoneNumber
     * @return ProviderDTO
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
        return $this;
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * @param bool $active
     * @return ProviderDTO
     */
    public function setActive($active)
    {
        $this->active = $active;
        return $this;
    }

    /**
     * @return string
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * @param string $dateCreated
     * @return ProviderDTO
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;
        return $this;
    }

    /**
     * @return string
     */
    public function getDateUpdated()
    {
        return $this->dateUpdated;
    }

    /**
     * @param string $dateUpdated
     * @return ProviderDTO
     */
    public function setDateUpdated( $dateUpdated)
    {
        $this->dateUpdated = $dateUpdated;
        return $this;
    }

    /**
     * @return int
     */
    public function getProviderTypeId()
    {
        return $this->providerTypeId;
    }

    /**
     * @param $providerTypeId
     * @return ProviderDTO
     */
    public function setProviderTypeId($providerTypeId)
    {
        $this->providerTypeId = $providerTypeId;
        return $this;
    }

}