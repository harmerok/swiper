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
     */
    protected $pageRenderer;

    /**
     * @var \Hirnschmalz\Swiper\Domain\Repository\SlideRepository
     */
    protected $slideRepository;

    /**
     * @param \TYPO3\CMS\Core\Page\PageRenderer $pageRenderer
     */
    public function injectPageRenderer(\TYPO3\CMS\Core\Page\PageRenderer $pageRenderer) {
        $this->pageRenderer = $pageRenderer;
    }

    /**
     * @param \Hirnschmalz\Swiper\Domain\Repository\SliderRepository $slideRepository
     */
    public function injectSlideRepository(\Hirnschmalz\Swiper\Domain\Repository\SlideRepository $slideRepository) {
        $this->slideRepository = $slideRepository;
    }

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

        /** @var \TYPO3\CMS\Core\Resource\ResourceFactory $resourceFactory */
        $resourceFactory = GeneralUtility::makeInstance('TYPO3\CMS\Core\Resource\ResourceFactory');
        $slides = array();
        $slideUids = $this->settings['slider']['slides'];
        $slideUids = explode(',', $slideUids);

        foreach ($slideUids as $slideUid) {
            array_push($slides, $this->slideRepository->findByUid($slideUid));
        }

        $this->view->assign('slides', $slides);

        $contentObj = $this->configurationManager->getContentObject();
        $sliderCssId = $this->settings['css']['id'] ? $this->settings['css']['id'] : 'swiper-container-' . $contentObj->data['uid'];
        $this->view->assign('sliderCssId', $sliderCssId);

        $sliderCssClass = '';
        if ($this->settings['pagination']) {
            $sliderCssClass .= ' swiper-with-pagination';
        }

        if ($this->settings['buttons']) {
            $sliderCssClass .= ' swiper-with-buttons';
        }

        if ($this->settings['scrollbar']) {
            $sliderCssClass .= ' swiper-with-scrollbar';
        }


        $this->view->assign('sliderCssClass', $sliderCssClass);

        $pixels = ('fixed' == $this->settings['height'] || 'autoMin' == $this->settings['height']) ? $this->settings['heightPixel'] : FALSE;
        if ($pixels) {
            switch ($this->settings['height']) {
                case 'autoMin':
                    $pixelsCss = 'min-height';
                    break;

                default:
                    $pixelsCss = 'height';
                    break;

            }
            $this->view->assign('slideCss', "$pixelsCss: ${pixels}px;");
        }

        $javaScript = "
            var swiper_" . $contentObj->data['uid'] ." = new Swiper ('#" . $sliderCssId . "', {
                direction: 'horizontal',
                autoplay: ". $this->settings['autoplay'] .",
                autoHeight: " . ('auto' == $this->settings['height'] || 'autoMin' == $this->settings['height'] ? 'true' : 'false') . "," .
                ('fixed' == $this->settings['height'] ? 'height: ' . $pixels . ',' : '') .
                "loop: " . ($this->settings['loop'] ? 'true' : 'false') . ",";

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
