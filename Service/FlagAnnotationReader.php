<?php

namespace ED\FlagBundle\Service;

use Doctrine\Common\Annotations\AnnotationReader;

/**
 * Class FlagAnnotationReader
 */
class FlagAnnotationReader
{
    /**
     * @var \Doctrine\Common\Annotations\AnnotationReader
     */
    private $reader;

    /**
     * Flaggable entity mappings
     *
     * @var array
     */
    private $mappings;

    /**
     * FlagAnnotationReader constructor.
     *
     * @param AnnotationReader $reader
     */
    public function __construct(AnnotationReader $reader)
    {
        $this->reader = $reader;
        $this->mappings = [];
    }

    /**
     * Return flaggable object class by alias
     *
     * @param string $alias
     *
     * @return string|null
     */
    public function getClassByAlias($alias, $em)
    {
        foreach ($this->getFlaggableClassMappings($em) as $mapping) {
            if ($mapping['alias'] == $alias) {
                return $mapping['class'];
            }
        }

        return null;
    }

    /**
     * Get list of flaggable classes with their annotation params
     *
     * @return array
     */
    public function getFlaggableClassMappings($em)
    {
        if (empty($this->mappings)) {
            $metadata = $em->getMetadataFactory()->getAllMetadata();

            foreach ($metadata as $meta) {
                $name = $meta->getName();

                $interfaces = class_implements($name);

                if (in_array('ED\\FlagBundle\\Model\\FlaggableInterface', $interfaces)) {
                    $annotation = $this->reader->getClassAnnotation(
                        new \ReflectionClass(new $name),
                        'ED\\FlagBundle\\Annotation\\Flaggable'
                    );

                    if ($annotation) {
                        $this->mappings[] = [
                            'class' => $name,
                            'alias' => $annotation->alias,
                        ];
                    }
                }
            }
        }

        return $this->mappings;
    }
}