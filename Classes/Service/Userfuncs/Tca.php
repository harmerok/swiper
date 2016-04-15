<?php
namespace Hirnschmalz\Swiper\Service\Userfunc;

/**
 * Class Tca
 * @package Hirnschmalz\Swiper\Service\Userfunc
 */
class Tca
{
    /**
     * Return the title for a slide record
     *
     * @param $parameters
     * @param $parentObject
     */
    public function slideTitle(&$parameters, $parentObject) {
        $parameters['title'] = 'Slide [' . $parameters['row']['uid'] . ']';
    }
}