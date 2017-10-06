<?php

namespace ED\FlagBundle\Model;

/**
 * Class FlagReport
 */
class FlagReport
{
    /**
     * new report
     */
    const STATUS_NEW = 'new';

    /*
     * rejected report
     */
    const STATUS_REJECTED = 'rejected';

    /**
     * Set resolved status
     */
    const STATUS_RESOLVED = 'resolved';

    /**
     * warned reported object
     */
    const STATUS_REMOVED = 'removed';

    /**
     * removed reported object
     */
    const STATUS_WARNED = 'warned';

    /**
     * Unique ID of report
     *
     * @var mixed
     */
    protected $id;

    /**
     * @var \Symfony\Component\Security\Core\User\UserInterface
     */
    protected $author;

    /**
     * Report status
     *
     * @var string
     */
    protected $status;

    /**
     * Reason
     *
     * @var \ED\FlagBundle\Model\FlagReason
     */
    protected $reason;

    /**
     * Object model class name
     *
     * @var string
     */
    protected $objectModel;

    /**
     * Object model id
     *
     * @var mixed
     */
    protected $objectId;

    /**
     * Flagged object
     *
     * @var mixed
     */
    protected $flaggedObject;

    /**
     * Date when the report was created
     *
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * Action on this report
     *
     * @var mixed
     */
    protected $actions;

    /**
     * FlagReport constructor.
     */
    public function __construct()
    {
        $this->status = self::STATUS_NEW;
        $this->createdAt = new \DateTime();
    }

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
     * Set author
     *
     * @param $author
     *
     * @return $this
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \Symfony\Component\Security\Core\User\UserInterface
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set reason
     *
     * @param $reason
     *
     * @return $this
     */
    public function setReason($reason)
    {
        $this->reason = $reason;

        return $this;
    }

    /**
     * Get reason
     *
     * @return \ED\FlagBundle\Model\FlagReason
     */
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * Set objectModel
     *
     * @param string $objectModel
     *
     * @return $this
     */
    public function setObjectModel($objectModel)
    {
        $this->objectModel = $objectModel;

        return $this;
    }

    /**
     * Get objectModel
     *
     * @return string
     */
    public function getObjectModel()
    {
        return $this->objectModel;
    }

    /**
     * Set objectId
     *
     * @param mixed $objectId
     *
     * @return $this
     */
    public function setObjectId($objectId)
    {
        $this->objectId = $objectId;

        return $this;
    }

    /**
     * Get objectId
     *
     * @return mixed
     */
    public function getObjectId()
    {
        return $this->objectId;
    }

    /**
     * Set flagged object
     *
     * @param mixed $object
     *
     * @return $this
     */
    public function setFlaggedObject($object)
    {
        $this->flaggedObject = $object;

        return $this;
    }

    /**
     * Get flagged object
     *
     * @return mixed
     */
    public function getFlaggedObject()
    {
        return $this->flaggedObject;
    }

    /**
     * Get actions
     *
     * @return mixed
     */
    public function getActions()
    {
        return $this->actions;
    }

    /**
     * Get created at
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return string
     */
    public function __toString()
    {
         return 'Report #' . (string) $this->id;
    }
}