<?php

namespace ED\FlagBundle\Model;

/**
 * Interface FlaggableInterface
 */
interface FlaggableInterface
{

    /**
     * Set published status to true
     */
    public function publish();

    /**
     * Set published status to false
     */
    public function unpublish();
}