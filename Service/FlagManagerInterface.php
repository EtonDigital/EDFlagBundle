<?php

namespace ED\FlagBundle\Service;

/**
 * Interface FlagManagerInterface
 */
interface FlagManagerInterface
{

    /**
     * Create new flag report for given content
     *
     * @param string $objectModel
     * @param mixed  $objectId
     *
     * @return mixed
     */
    public function flagContent($objectModel, $objectId);

    /**
     * Get flag reasons
     *
     * @param array $order  List of of sort=>direction values
     * @param int   $limit  Results limit
     * @param int   $offset Start from number of results
     *
     * @return mixed
     */
    public function getFlagReasons($order, $limit, $offset);

    /**
     * Creates new flag report
     *
     * @return mixed
     */
    public function createFlagReport();

    /**
     * Get class name from alias
     *
     * @param string $alias
     *
     * @return string|null
     */
    public function getClassByAlias($alias);

    /**
     * Find flaggable object by class and id
     *
     * @param string $class
     * @param mixed  $id
     *
     * @return mixed
     */
    public function findFlaggableObject($class, $id);

    /**
     * Save entity
     *
     * @param mixed $entity
     *
     * @return mixed
     */
    public function save($entity);
}