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
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    protected $name;

    /**
     * @ORM\OneToOne(targetEntity="Company", inversedBy="owner", cascade={"persist"})
     * @ORM\JoinColumn(name="companyId", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $company;

    public function setCompany(Company $company)
    {
        $this->company = $company;
        return $this;
    }
}
