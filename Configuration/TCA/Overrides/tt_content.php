<?php
use Hirnschmalz\Swiper\Utility\Div;

if (!defined ('TYPO3_MODE')) die ('Access denied.');

$_EXTKEY = $GLOBALS['_EXTKEY'] = Div::extKey;
$extensionName = \TYPO3\CMS\Core\Utility\GeneralUtility::underscoredToUpperCamelCase($_EXTKEY);
$pluginSignature = strtolower($extensionName) . '_slider';

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    Div::vendorNamespace . $_EXTKEY,                      // extensionName
    'Slider',                                  // pluginName
    'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_be:title'              // pluginTitle
);

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'layout,recursive,select_key,pages';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform_'. $_EXTKEY . '.xml');