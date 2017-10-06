<?php

namespace ED\FlagBundle\Model;

/**
 * Trait FlaggableEntityTrait
 */
trait FlaggableEntityTrait
{
    /**
     * Published status
     *
     * @var bool
     */
    protected $published;

    /**
     * Set published
     *
     * @param bool $published
     *
     * @return $this
     */
    public function setPublished($published)
    {
        $this->published = $published;

        return $this;
    }

    /**
     * Get published
     *
     * @return bool
     */
    public function getPublished()
    {
        return $this->published;
    }

    /**
     * Publish entity
     */
    public function publish()
    {
        $this->setPublished(true);
    }

    /**
     * Unpublish entity
     */
    public function unpublish()
    {
        $this->setPublished(false);
    }
}