<?php

namespace Application\Entity;

use Traversable;
use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\ArrayUtils;

/**
 * Abstract entity class which provides very basic functionality for entities
 *
 * @ORM\MappedSuperclass
 */
abstract class AbstractEntity
{
    /**
     * Constructor
     *
     * @param mixed $data
     */
    public function __construct($data = null)
    {
        if (null !== $data) {
            $this->exchangeArray($data);
        }
    }

    /**
     * Magic setter. It tries to find a method first to set a class property,
     * then it sets a property directly if no method was found and if property
     * exists, otherwise it throws an exception
     *
     * @param string $prop object property name
     * @param mixed $value value of provided property
     * @return \Application\Entity\AbstractEntity
     * @throws \InvalidArgumentException
     */
    public function __set($prop, $value)
    {
        $method = 'set' . ucfirst($prop);
        if (method_exists($this, $method)) {
            $this->{$method}($value);
        } elseif (property_exists($this, $prop)) {
            $this->{$prop} = $value;
        } else {
            throw new \InvalidArgumentException(sprintf(
                    'Class "%s" does not have property "%s"',
                    __CLASS__, $prop));
        }

        return $this;
    }

    /**
     * Magic getter. It tries to find a method first to get a class property,
     * then it reads a property directly if no method was found and if property
     * exists, otherwise it throws an exception
     *
     * @param string $prop
     * @return type
     * @throws \InvalidArgumentException
     */
    public function __get($prop)
    {
        $method = 'get' . ucfirst($prop);
        $value = null;
        if (method_exists($this, $method)) {
            $value = $this->{$method}();
        } elseif (property_exists($this, $prop)) {
            $value = $this->{$prop};
        } else {
            throw new \InvalidArgumentException(sprintf(
                    'Class "%s" does not have property "%s"',
                    get_class($this), $prop));
        }

        return $value;
    }

    /**
     * Magic call method. It calls appropriate magic __get or __set method
     *
     * @param string $name method name
     * @param array $args arguments to apply to calling method
     * @return mixed
     * @throws \RuntimeException
     */
    public function __call($name, $args)
    {
        $matches = array();
        $res = null;

        if (preg_match('/^(?P<type>get|set)(?P<prop>.+)$/', $name, $matches)) {
            $res = null;
            switch ($matches['type']) {
                case 'get':
                    $res = $this->__get(lcfirst($matches['prop']));
                    break;
                case 'set':
                    $res = $this->__set(lcfirst($matches['prop']), array_shift($args));
                    break;
            }
        } else {
            throw new \RuntimeException(sprintf(
                    'Class "%s" has no method "%s"', __CLASS__, $name));
        }

        return $res;
    }

    /**
     * Sets properties from array to a class instance
     *
     * @param array|\Traversable $data
     * @throws \InvalidArgumentException
     */
    public function exchangeArray($data)
    {
        if ($data instanceof Traversable) {
            $data = ArrayUtils::iteratorToArray($data);
        }
        if (!is_array($data)) {
            throw new \InvalidArgumentException(sprintf(
                    'Expected array or instance of Traversable but %s given',
                    is_object($data) ? get_class($data) : gettype($data)));
        }
        foreach ($data as $property => $value) {
            $method = 'set' . ucfirst($property);
            if (method_exists($this, $method)) {
                $this->{$method}($value);
            } elseif (property_exists($this, $property)) {
                $this->{$property} = $value;
            }
        }
    }

    /**
     * Returns an array representation of the object
     *
     * @return array
     */
    public function getArrayCopy()
    {
        $reflection = new \ReflectionClass(get_class($this));
        $copy = array();

        foreach ($reflection->getProperties(\ReflectionProperty::IS_PROTECTED) as $prop) {
            $propName = $prop->getName();
            $method = 'get' . ucfirst($propName);
            if (method_exists($this, $method)) {
                $copy[$propName] = $this->{$method}();
            } else {
                $copy[$propName] = $this->{$propName};
            }
        }

        return $copy;
    }
}
