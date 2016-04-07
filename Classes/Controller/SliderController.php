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
        $extConfig = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['swiper']);
        
        if (is_array($extConfig) && !$extConfig[Div::extConfig_includeAlways]) {
            $this->pageRenderer->addJsFile(ExtensionManagementUtility::siteRelPath(Div::extKey) . 'Resources/Public/Scripts/JS/swiper.min.js');
            $this->pageRenderer->addCssFile(ExtensionManagementUtility::siteRelPath(Div::extKey) . 'Resources/Public/Styles/CSS/swiper.min.css');
        }

        $contentObj = $this->configurationManager->getContentObject();

        $sliderCssId = $this->settings['css']['id'] ? $this->settings['css']['id'] : 'swiper-container-' . $contentObj->data['uid'];
        $this->view->assign('sliderCssId', $sliderCssId);

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

        $javaScript = "
            var swiper_" . $contentObj->data['uid'] ." = new Swiper ('#" . $sliderCssId . "', {
                direction: 'horizontal',
                loop: " . ($this->settings['loop'] ? 'true' : 'false') . ",";

        if ($this->settings['pagination']) {
            $javaScript .= "pagination: '.swiper-pagination',";
        }

        if ($this->settings['buttons']) {
            $javaScript .= "nextButton: '.swiper-button-next',";
            $javaScript .= "prevButton: '.swiper-button-prev',";
        }

        if ($this->settings['scrollbar']) {
            $javaScript .= "pagination: '.swiper-scrollbar',";
        }

        $javaScript .= "
            })
        ";
        $this->view->assign('script', '<script>' . $javaScript . '</script>');
    }
}