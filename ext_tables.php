<?php
use Hirnschmalz\Swiper\Utility\Div;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Swiper configuration');

ExtensionUtility::registerPlugin(
    Div::vendorNamespace . '.' . $_EXTKEY,
    'Slider',
    'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_be:title'
);

if (TYPO3_MODE === 'BE') {
    $extensionName = GeneralUtility::underscoredToUpperCamelCase($_EXTKEY);
    $pluginSignature = strtolower($extensionName) . '_slider';

    /**
     * Enable the plugin in the plugin wizard list
     */
    $GLOBALS['TBE_MODULES_EXT']['xMOD_db_new_content_el']['addElClasses'][$pluginSignature . '_wizicon'] =
        ExtensionManagementUtility::extPath($_EXTKEY) . 'Resources/Private/Php/class.' . $_EXTKEY . '_wizicon.php';
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_swiper_domain_model_slide');