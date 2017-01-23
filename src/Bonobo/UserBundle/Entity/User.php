<?php
// src/AppBundle/Entity/User.php

namespace Bonobo\UserBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $age;

    /**
     * @ORM\Column(type="string",length=255)
     */
    private $famille;

    /**
     * @ORM\Column(type="string",length=255)
     */
    private $race;

    /**
     * @ORM\Column(type="string",length=255)
     */
    private $nourriture;

    /**
     * @ORM\ManyToMany(targetEntity="Bonobo\UserBundle\Entity\User", cascade={"persist"})
     */
    private $id_ami;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * Set age
     *
     * @param integer $age
     * @return User
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return integer 
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set famille
     *
     * @param string $famille
     * @return User
     */
    public function setFamille($famille)
    {
        $this->famille = $famille;

        return $this;
    }

    /**
     * Get famille
     *
     * @return string 
     */
    public function getFamille()
    {
        return $this->famille;
    }

    /**
     * Set race
     *
     * @param string $race
     * @return User
     */
    public function setRace($race)
    {
        $this->race = $race;

        return $this;
    }

    /**
     * Get race
     *
     * @return string 
     */
    public function getRace()
    {
        return $this->race;
    }

    /**
     * Set nourriture
     *
     * @param string $nourriture
     * @return User
     */
    public function setNourriture($nourriture)
    {
        $this->nourriture = $nourriture;

        return $this;
    }

    /**
     * Get nourriture
     *
     * @return string 
     */
    public function getNourriture()
    {
        return $this->nourriture;
    }

    /**
     * Add idAmi
     *
     * @param \Bonobo\UserBundle\Entity\User $idAmi
     *
     * @return User
     */
    public function addIdAmi(\Bonobo\UserBundle\Entity\User $idAmi)
    {
        $this->id_ami[] = $idAmi;

        return $this;
    }

    /**
     * Remove idAmi
     *
     * @param \Bonobo\UserBundle\Entity\User $idAmi
     */
    public function removeIdAmi(\Bonobo\UserBundle\Entity\User $idAmi)
    {
        $this->id_ami->removeElement($idAmi);
    }

    /**
     * Get idAmi
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdAmi()
    {
        return $this->id_ami;
    }
}
