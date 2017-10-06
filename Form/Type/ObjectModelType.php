<?php

namespace ED\FlagBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ObjectModelType
 */
class ObjectModelType extends AbstractType
{
    /**
     * @var ObjectModelTransformer
     */
    private $albumTransformer;

    /**
     * AlbumsType constructor.
     *
     * @param AlbumsTransformer $albumTansformer
     */
    public function __construct(ObjectModelTransformer $albumTansformer)
    {
        $this->albumTransformer = $albumTansformer;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addModelTransformer($this->albumTransformer);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return '';
    }

    public function getParent()
    {
        return TextareaType::class;
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => null,
            'csrf_protection' => false,
            'invalid_message' => 'Invalid Taggable model.',
            'mapped' => false,
        ));
    }
}