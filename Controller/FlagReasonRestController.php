<?php

namespace ED\FlagBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\QueryParam;

/**
 * Class FlagReasonRestController
 */
class FlagReasonRestController extends FOSRestController
{

    /**
     * Get Flag reasons
     *
     * @QueryParam(name="limit", requirements="\d+", default="10", description="our limit")
     * @QueryParam(name="offset", requirements="\d+", nullable=true, default="0", description="our offset")
     * @QueryParam(name="sort", requirements="(id|title|follows)", nullable=true, strict=true, default="id", description="Sort by field (id|title|follows)")
     * @QueryParam(name="direction", requirements="(ASC|DESC)", nullable=true, strict=true, default="DESC", description="Sorting direction")
     *
     * @return \FOS\RestBundle\View\View
     */
    public function getFlagreasonsAction($limit, $offset, $sort, $direction)
    {
        $this->get('ed_flag.report.manager')->getFlaggableClassMappings();
        $reasons = $this->get('ed_flag.report.manager')->getFlagReasons(
            [$sort => $direction],
            $limit,
            $offset
        );

        return $this->view($reasons);
    }
}