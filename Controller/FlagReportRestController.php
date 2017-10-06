<?php

namespace ED\FlagBundle\Controller;

use ED\FlagBundle\Form\Type\FlagReportType;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 * Class FlagReportRestController
 */
class FlagReportRestController extends FOSRestController
{

    /**
     * Post flag report
     *
     * @ApiDoc(
     *  resource="Report",
     *  input = "ED\FlagBundle\Form\Type\FlagReportType",
     *  section="Flag",
     *  authentication=true,
     *  statusCodes={
     *         201 = "Returned when successfuly created",
     *         400 = "Returned when the posted data is invalid",
     *         401 = "Returned when No AUTH found (Unauthorized)",
     *     }
     * )
     *
     * @return \FOS\RestBundle\View\View
     */
    public function postFlagreportAction(Request $request)
    {
        $flagManager = $this->get('ed_flag.report.manager');

        $report = $flagManager->createFlagReport();
        $report->setAuthor($this->getUser());

        $form = $this->createForm(FlagReportType::class, $report);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $data = $form->getData();

            $flagManager->save($data);

            return $this->view($data, Response::HTTP_CREATED);
        }
        else {
            return $this->view($form, Response::HTTP_BAD_REQUEST);
        }
    }
}