<?php
namespace Hirnschmalz\Domain\Model;
namespace TYPO3\CMS\Extbase\DomainObject\AbstractEntity;


/**
 * Class Slider
 * @package TYPO3\CMS\Extbase\DomainObject\AbstractEntity
 */
class Slider extends AbstractEntity
{
    /**
     * Images for the slider
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     */
    protected $images;

    /**
     * Get all the images for the slider
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $images
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Set all the images for the slider
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $images
     */
    public function setImages($images)
    {
        $this->images = $images;
    }
}