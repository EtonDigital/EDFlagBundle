<?php

namespace ED\FlagBundle\EventListener;
use Doctrine\ORM\Event\LifecycleEventArgs;
use ED\FlagBundle\Model\FlagReport;
use ED\FlagBundle\Service\FlagAnnotationReader;


class FlagReportListener
{
    /**
     * @var FlagAnnotationReader
     */
    private $flagReader;

    /**
     * FlagReportListener constructor.
     *
     * @param FlagAnnotationReader $flagReader
     */
    public function __construct(FlagAnnotationReader $flagReader)
    {
        $this->flagReader = $flagReader;
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function postLoad(LifecycleEventArgs $args)
    {
        if (($entity = $args->getEntity()) and $entity instanceof FlagReport) {
            $objectClass = $this->flagReader->getClassByAlias($entity->getObjectModel(), $args->getEntityManager());

            if ($objectClass) {
                $object = $args->getEntityManager()->getRepository($objectClass)->find($entity->getObjectId());

                if ($object) {
                    $entity->setFlaggedObject($object);
                }
            }

        }
    }

}