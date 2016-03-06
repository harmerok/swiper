<?php
namespace Hirnschmalz\Swiper\Controller;

use Hirnschmalz\Swiper\Utility\Div;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;


/**
 * Class SliderController
 * @package Hirnschmalz\Swiper\Controller
 */
class SliderController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * @var \TYPO3\CMS\Core\Page\PageRenderer
     * @inject
     */
    protected $pageRenderer;

    /**
     * Show the slider
     */
    public function showAction()
    {
        $this->pageRenderer->addJsFile(ExtensionManagementUtility::siteRelPath(Div::extKey) . 'Resources/Public/bower_components/Swiper/dist/js/swiper.min.js');
        $this->pageRenderer->addCssFile(ExtensionManagementUtility::siteRelPath(Div::extKey) . 'Resources/Public/bower_components/Swiper/dist/css/swiper.min.css');

        /** @var \TYPO3\CMS\Core\Resource\ResourceFactory $resourceFactory */
        $resourceFactory = GeneralUtility::makeInstance('TYPO3\CMS\Core\Resource\ResourceFactory');
        $sliderItems = array();
        $sliderItemUids = $this->settings['slider']['images'];
        $sliderItemUids = explode(',', $sliderItemUids);

        if(!empty($sliderItemUids)){
            $arraySize = sizeof($sliderItemUids);
            for($i = 0; $i < $arraySize; $i++){

                $itemUid = $sliderItemUids[$i];

                $fileReference = $resourceFactory->getFileReferenceObject($itemUid);
                $fileArray = $fileReference->getProperties();
                array_push($sliderItems, $fileArray);
            }
        }

        $this->view->assign('sliderItems', $sliderItems);

        $contentObj = $this->configurationManager->getContentObject();
        $this->view->assign('record', $contentObj->data);
    }
}