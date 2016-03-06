<?php
use Hirnschmalz\Swiper\Utility\Div;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

class swiper_slider_wizicon {

    /**
     * Processing the wizard items array
     *
     * @param array $wizardItems The wizard items
     * @return array array with wizard items
     */
    public function proc($wizardItems) {
        $wizardItems['plugins_tx_' . Div::extKey] = array(
            'icon'			=> ExtensionManagementUtility::extRelPath(Div::extKey) . 'ext_icon.png',
            'title'			=> $GLOBALS['LANG']->sL('LLL:EXT:' . Div::extKey . '/Resources/Private/Language/locallang_be.xlf:slider_title'),
            'description'	=> $GLOBALS['LANG']->sL('LLL:EXT:' . Div::extKey . '/Resources/Private/Language/locallang_be.xlf:slider_plus_wiz_description'),
            'params'		=> '&defVals[tt_content][CType]=list&defVals[tt_content][list_type]=' . Div::extKey . '_slider'
        );

        return $wizardItems;
    }
}