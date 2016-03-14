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

// Add Swiper slider palette to sys_file_reference
$GLOBALS['TCA']['sys_file_reference']['palettes'][Div::extKey] = array(
    'canNotCollapse' => 1,
    'showitem' => 'title, description, --linebreak--, autoplay',
);

/**
 * Add extra field autoplay to sys_file_reference record
 */
$newSysFileReferenceColumns = array(
    'autoplay' => array(
        'exclude' => 1,
//        'label' => 'LLL:EXT:fal_online_media_connector/Resources/Private/Language/locallang_db.xlf:sys_file_reference.autoplay',
        'label' => 'xxxxxxxx',
        'config' => array(
            'type' => 'check',
            'default' => 0
        )
    ),
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('sys_file_reference', $newSysFileReferenceColumns);