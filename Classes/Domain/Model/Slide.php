<?php
namespace Hirnschmalz\Swiper\Domain\Model;

/**
 * Class Slide
 */
class Slide extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * Images for the slide
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    protected $image;

    /**
     * The text for the slide
     * @var string
     */
    protected $content;

    /**
     * Get the image for the slide
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the image for the slide
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * Get the text for the slide
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the text for the slide
     *
     * @param $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }
}