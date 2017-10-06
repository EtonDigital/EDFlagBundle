<?php

namespace ED\FlagBundle\Model;


class FlagAction
{

    /**
     * Unpublish actions
     */
    CONST ACTION_UNPUBLISHED = 'Unpublish';

    /**
     * Unique ID of report
     *
     * @var mixed
     */
    protected $id;

    /**
     * @var string
     */
    protected $actionType;

    /**
     * @var \Symfony\Component\Security\Core\User\UserInterface
     */
    protected $author;

    /**
     * @var \ED\FlagBundle\Model\FlagReport
     */
    protected $report;

    /**
     * Date when the report was created
     *
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * FlagAction constructor.
     */
    public function __construct()
    {
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
     * Set report
     *
     * @param $report
     *
     * @return $this
     */
    public function setReport($report)
    {
        $this->report = $report;

        return $this;
    }

    /**
     * Get report
     *
     * @return \ED\FlagBundle\Model\FlagReport
     */
    public function getReport()
    {
        return $this->report;
    }

    /**
     * Set action type
     *
     * @param string $type
     *
     * @return $this
     */
    public function setActionType($type)
    {
        $this->actionType = $type;

        return $this;
    }

    /**
     * Get action type
     *
     * @return string
     */
    public function getActionType()
    {
        return $this->actionType;
    }

    /**
     * To string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->actionType;
    }
}