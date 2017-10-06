<?php

namespace ED\FlagBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use ED\FlagBundle\Service\FlagManagerInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormError;

/**
 * Class FlagReportType
 */
class FlagReportType extends AbstractType
{
    /**
     * Flag manager
     *
     * @var FlagManagerInterface
     */
    private $flagManager;

    /**
     * Class name
     *
     * @var string
     */
    private $class;

    /**
     * Constructor
     *
     * @param string $class The FlagReport class name
     */
    public function __construct($flagManager, $class)
    {
        $this->flagManager = $flagManager;
        $this->class = $class;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('objectId')
            ->add('objectModel')
            ->add('reason')
        ;

        $builder->addEventListener(FormEvents::POST_SUBMIT, function(FormEvent $event) {
            $form = $event->getForm();
            $flagReport = $form->getData();
            $objectModel = $flagReport->getObjectModel();
            $objectId = $flagReport->getObjectId();

            if ($objectModel) {
                $objectModelClass = $this->flagManager->getClassByAlias($flagReport->getObjectModel());

                if ($objectModelClass && $objectId) {
                    $object = $this->flagManager->findFlaggableObject(
                        $objectModelClass,
                        $flagReport->getObjectId()
                    );

                    if (!$object) {
                        $error = new FormError(sprintf('Cant find object for alias \'%s\' with identifier %s', $objectModel, $flagReport->getObjectId()));
                        $form['objectId']->addError($error);
                    }
                }
                else {
                    $error = new FormError(sprintf('Cant find class for alias \'%s\'. Make sure you have added Flaggable annotation for your class', $flagReport->getObjectModel()));
                    $form['objectModel']->addError($error);
                }
            }
            else {
                $error = new FormError('objectModel is required');
                $form['objectModel']->addError($error);
            }

            if (empty($objectId)) {
                $error = new FormError('objectId is required');
                $form['objectId']->addError($error);
            }
        });
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => $this->class,
            'csrf_protection' => false,
            'translation_domain' => 'EDFlagBundle',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return '';
    }
}