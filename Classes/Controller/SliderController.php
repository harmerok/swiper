<?php
namespace Hirnschmalz\Swiper\Controller;


/**
 * Class SliderController
 * @package Hirnschmalz\Swiper\Controller
 */
class SliderController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * Show the slider
     */
    public function showAction()
    {
        $this->view->assign('test', 'testvalue');
    }
}