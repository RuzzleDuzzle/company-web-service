<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="countries")
 */
class Country extends AbstractEntity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /** @ORM\Column(type="string", length=50, unique=true) */
    protected $name;

    /** @ORM\Column(type="string", length=2, unique=true) */
    protected $alpha2;

    /** @ORM\Column(type="string", length=3, unique=true) */
    protected $alpha3;

    /** @ORM\Column(type="integer", unique=true) */
    protected $numCode;
}
