<?php

namespace ED\FlagBundle\Model;

/**
 * Class FlagReason
 */
class FlagReason
{

    /**
     * FlagReason identifier
     *
     * @var mixed
     */
    protected $id;

    /**
     * FlagReason name
     *
     * @var string
     */
    protected $name;

    /**
     * Get id
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * To string
     */
    public function __toString()
    {
        return $this->name;
    }
}