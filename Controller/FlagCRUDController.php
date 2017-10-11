<?php

namespace ED\FlagBundle\Controller;

use ED\FlagBundle\Form\Type\FlagActionType;
use ED\FlagBundle\Model\FlagAction;
use ED\FlagBundle\Model\FlagReport;
use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Class FlagCRUDController
 */
class FlagCRUDController extends CRUDController
{

    /**
     * Unpublish action
     *
     * @param $id
     *
     * @return RedirectResponse
     */
    public function unpublishOldAction($id)
    {
    }

    public function unpublishAction($id)
    {
        $request = $this->getRequest();
        $id = $request->get($this->admin->getIdParameter());
        $flagReport = $this->admin->getObject($id);

        if (!$flagReport) {
            throw $this->createNotFoundException(sprintf('unable to find the object with id : %s', $id));
        }

        $flagManager = $this->get('ed_flag.report.manager');

        $action = $flagManager->createFlagAction();
        $action->setReport($flagReport);
        $action->setActionType(FlagAction::ACTION_UNPUBLISHED);
        $action->setAuthor($this->getUser());

        $form = $this->createForm(FlagActionType::class);
        $form->setData($action);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $objectClass = $flagManager->getClassByAlias($flagReport->getObjectModel());

            if ($objectClass) {
                $object = $flagManager->findFlaggableObject($objectClass, $flagReport->getObjectId());

                if ($object) {
                    $object->unpublish();

                    $flagReport->setStatus(FlagReport::STATUS_RESOLVED);

                    $flagManager->save($object);
                    $flagManager->save($form->getData());
                    $flagManager->save($flagReport);

                    $this->addFlash('sonata_flash_success', 'Content has been unpublished');
                }
                else {
                    $this->addFlash('sonata_flash_error', 'Unable to find content');
                }
            }
            else {
                $this->addFlash('sonata_flash_error', sprintf('Invalid class mappings for alias \'%s\'', $flagReport->getObjectModel()));
            }

            return new RedirectResponse($this->admin->generateUrl('list', $this->admin->getFilterParameters()));
        }

        return $this->render('EDFlagBundle:CRUD:unpublish.html.twig', array(
            'object' => $flagReport,
            'form' => $form
        ), null);
    }
}