<?php

namespace ED\FlagBundle\Annotation;

use Doctrine\Common\Annotations\Annotation\Target;

/**
 * @Annotation
 * @Target("CLASS")
 */
class Flaggable
{

    /**
     * Alias of the class
     *
     * @var string
     */
    public $alias;
}