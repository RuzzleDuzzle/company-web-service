<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\MappedSuperclass
 */
abstract class BaseEntity extends AbstractEntity
{
    /** @ORM\Column(type="integer") */
    protected $tsAdd;

    /** @ORM\Column(type="integer", nullable=true) */
    protected $tsMod;

    public function __construct($data)
    {
        parent::__construct($data);
        $this->setTsAdd(time());
        $this->setTsMod(time());
    }

    public function setTsAdd($tsAdd = null)
    {
        if (null === $tsAdd) {
            $tsAdd = time();
        }
        $this->tsAdd = $tsAdd;
        return $this;
    }

    public function setAddedAt($timestamp = null)
    {
        return $this->setTsAdd($timestamp);
    }

    public function getTsAdd()
    {
        return $this->tsAdd;
    }

    public function getAddedAt()
    {
        return $this->getTsAdd();
    }

    public function setTsMod($tsMod = null)
    {
        if (null === $tsMod) {
            $tsMod = time();
        }
        $this->tsMod = $tsMod;
        return $this;
    }

    public function setModifiedAt($timestamp = null)
    {
        return $this->setTsMod($timestamp);
    }

    public function getTsMod()
    {
        return $this->tsMod;
    }

    public function getModifiedAt()
    {
        return $this->getTsMod();
    }
}
