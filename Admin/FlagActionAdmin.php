<?php

namespace ED\FlagBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Route\RouteCollection;

/**
 * Class FlagActionAdmin
 */
class FlagActionAdmin extends AbstractAdmin
{
    /**
     * { @inheritdoc }
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('actionType')
            ->add('report')
        ;
    }

    /**
     * { @inheritdoc }
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('actionType')
            ->add('report')
        ;
    }

    /**
     * { @inheritdoc }
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('actionType')
            ->add('report')
            ->add('createdAt')
        ;
    }

    /**
     * { @inheritdoc }
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('report')
            ->add('actionType')
            ->add('author')
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
            ->remove('create')
            ->remove('edit')
        ;
    }

}
