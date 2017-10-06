<?php

namespace ED\FlagBundle\Controller;

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
    public function unpublishAction($id)
    {
        $flagReport = $this->admin->getSubject();
        $flagManager = $this->get('ed_flag.report.manager');

        $objectClass = $flagManager->getClassByAlias($flagReport->getObjectModel());

        if ($objectClass) {
            $object = $flagManager->findFlaggableObject($objectClass, $flagReport->getObjectId());

            if ($object) {
                $object->unpublish();

                $flagReport->setStatus(FlagReport::STATUS_RESOLVED);

                $action = $flagManager->createFlagAction();
                $action->setReport($flagReport);
                $action->setActionType(FlagAction::ACTION_UNPUBLISHED);
                $action->setAuthor($this->getUser());

                $flagManager->save($object);
                $flagManager->save($action);
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
}