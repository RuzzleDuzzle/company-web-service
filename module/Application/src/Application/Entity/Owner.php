<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="owners")
 */
class Owner extends BaseEntity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $firstName;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $lastName;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $email;

    /**
     * @ORM\ManyToOne(targetEntity="Company", cascade={"persist"})
     * @ORM\JoinColumn(name="companyId", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    protected $company;

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setFirstName($fName)
    {
        $this->firstName = $fName;
        return $this;
    }

    public function getLastName()
    {
        return $this->firstName;
    }

    public function setLastName($lName)
    {
        $this->lastName = $lName;
        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    public function getCompany()
    {
        return $this->company;
    }

    public function setCompany(Company $company)
    {
        $this->company = $company;
        return $this;
    }

    public function getFullName()
    {
        $fullName = $this->getFirstName() . ' ' . $this->getLastName();
        return $fullName;
    }
}
