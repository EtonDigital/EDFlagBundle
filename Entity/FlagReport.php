<?php

namespace ED\FlagBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use ED\FlagBundle\Model\FlagReport as FlagReportModel;

/**
 * Class FlagReport
 */
abstract class FlagReport extends FlagReportModel
{

    /**
     * FlagReport constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->actions = new ArrayCollection();
    }
}