<?php

namespace ED\FlagBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use ED\FlagBundle\Service\FlagManagerInterface;

/**
 * Class FlagReportAdmin
 */
class FlagReportAdmin extends AbstractAdmin
{

    /**
     * @var FlagManagerInterface
     */
    protected $flagManager;

    /**
     * { @inheritdoc }
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('reason')
            ->add('author')
            ->add('status')
            ->add('objectModel')
            ->add('objectId')
            ->add('createdAt')
        ;
    }

    /**
     * { @inheritdoc }
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('reason')
            ->add('author')
            ->add('status')
            ->add('objectModel')
            ->add('createdAt')
        ;
    }

    /**
     * { @inheritdoc }
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('reason')
            ->add('author')
            ->add('status')
            ->add('objectModel', null, [
                'label' => 'Model'
            ])
            ->add('object', null, [
                'label' => 'Flagged object',
                'mapped' => false,
                'template' => 'EDFlagBundle:CRUD:list__flagged_object.html.twig'
            ])
            ->add('createdAt')
            ->add('actions', null, [
                'template' => 'EDFlagBundle:CRUD:list__flagged_actions.html.twig'
            ])
            ->add('_action', 'actions', [
                'actions' => [
                    'unpublish' => [
                        'template' => 'EDFlagBundle:CRUD:list__action_unpublish.html.twig'
                    ],
                    'delete' => [],
                ]
            ])
        ;
    }

    /**
     * { @inheritdoc }
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('reason')
            ->add('author')
            ->add('status')
            ->add('objectModel')
            ->add('objectId')
            ->add('createdAt')
        ;
    }

    /**
     * { @inheritdoc }
     */
    protected function configureRoutes(RouteCollection $collection)
    {
        parent::configureRoutes($collection);

        $collection
            ->add('unpublish', $this->getRouterIdParameter() . '/unpublish')
            ->remove('create')
            ->remove('edit')
        ;
    }

    /**
     * Set flag manager
     *
     * @param $flagManager
     */
    public function setFlagManager($flagManager)
    {
        $this->flagManager = $flagManager;
    }

    /**
     * Generate edit url
     *
     * @param       $name
     * @param       $object
     * @param array $parameters
     * @param bool  $absolute
     *
     * @return string
     */
    public function generateNamedUrl($name, $object, $parameters = array(), $absolute = false){
        $classname = get_class($object);
        $admin = $this->getConfigurationPool()->getAdminByClass($classname);

        if ($admin) {
            return $admin->generateObjectUrl($name, $object, $parameters, $absolute);
        }
        else {
            return '';
        }
    }
}
