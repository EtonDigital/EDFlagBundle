<?php

namespace ED\FlagBundle\Service;

/**
 * Class EDFlagManager
 */
class EDFlagManager implements FlagManagerInterface
{

    /**
     * Doctrine entity manager
     *
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;

    /**
     * FlagReport class name
     *
     * @var string
     */
    protected $reportClass;

    /**
     * FlagReason class name
     *
     * @var string
     */
    protected $reasonClass;

    /**
     * FlagAction class name
     *
     * @var string
     */
    protected $actionClass;

    /**
     * @var FlagAnnotationReader
     */
    protected $flagReader;

    /**
     * EDFlagManager constructor.
     *
     * @param $em
     * @param $class
     */
    public function __construct($em, $reader, $reportClass, $reasonClass, $actionClass)
    {
        $this->em = $em;
        $this->flagReader = $reader;
        $this->reportClass = $reportClass;
        $this->reasonClass = $reasonClass;
        $this->actionClass = $actionClass;
    }

    /**
     * { @inheritdoc }
     */
    public function flagContent($objectModel, $objectId)
    {
        $flagReport = $this->createFlagReport();
        $flagReport->setObjectModel($objectModel);
        $flagReport->setObjectId($objectId);

        return $this->save($flagReport);
    }

    /**
     * { @inheritdoc }
     */
    public function getFlagReasons($order, $limit, $offset) {
        return $this->em->getRepository($this->reasonClass)->findBy([], $order, $limit, $offset);
    }

    /**
     * { @inheritdoc }
     */
    public function createFlagReport()
    {
        $flagReport = new $this->reportClass;

        return $flagReport;
    }

    /**
     * { @inheritdoc }
     */
    public function createFlagAction()
    {
        $flagAction = new $this->actionClass;

        return $flagAction;
    }

    /**
     * { @inheritdoc }
     */
    public function save($entity)
    {
        $this->em->persist($entity);

        $this->em->flush();

        return $entity;
    }

    /**
     * { @inheritdoc }
     */
    public function getClassByAlias($alias)
    {
        return $this->flagReader->getClassByAlias($alias, $this->em);
    }

    /**
     * { @inheritdoc }
     */
    public function findFlaggableObject($class, $id)
    {
        return $this->em->getRepository($class)->find($id);
    }
}