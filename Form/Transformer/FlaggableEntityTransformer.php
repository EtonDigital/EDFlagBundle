<?php

namespace ED\FlagBundle\Form\Transformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use ED\FlagBundle\Service\FlagManagerInterface;

/**
 * Class FlaggableEntityTransformer
 */
class FlaggableEntityTransformer implements DataTransformerInterface
{
    /**
     * @var FlagManagerInterface
     */
    private $flagManager;

    /**
     * AlbumTransformer constructor.
     *
     * @param FlagManagerInterface $albumManager
     */
    public function __construct($flagManager)
    {
        $this->flagManager = $flagManager;
    }

    /**
     * { @inheritdoc }
     */
    public function transform($collection)
    {
        return $collection;
    }

    /**
     * { @inheritdoc }
     */
    public function reverseTransform($string)
    {
        $albums = [];

        $ids = explode(',', trim($string));

        foreach ($ids as $id) {
            if ($id) {
                $album = $this->albumManager->find($id);

                if ($album) {
                    $albums[$id] = $album;
                }
                else {
                    throw new TransformationFailedException(sprintf(
                        'An album with id "%s" does not exist!',
                        $id
                    ));
                }
            }
        }

        return $albums;
    }
}