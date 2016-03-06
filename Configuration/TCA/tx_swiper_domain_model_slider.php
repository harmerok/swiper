<?php

use Hirnschmalz\Swiper\Utility\Div;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

return array(
    'ctrl' => array(
        'title' => 'LLL:EXT:' . Div::extKey .'/Resources/Private/Language/locallang_db.xlf:tx_swiper_domain_model_slider',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => TRUE,
        'sortby' => 'sorting',
        'versioningWS' => 2,
        'versioning_followPages' => TRUE,
        'origUid' => 't3_origuid',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => array(
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ),
        'iconfile' => ExtensionManagementUtility::extRelPath(Div::extKey) . 'ext_icon.png',
        'searchFields' => 'isbn, title, identifier'
    ),
    'interface' => array(
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, images',
    ),
    'columns' => array(
        'image' => array(
            'exclude' => 1,
            'label' => 'Image',
            'config' => ExtensionManagementUtility::getFileFieldTCAConfig('image', array(
                'appearance' => array(
                    'createNewRelationLinkTitle' => 'LLL:EXT:cms/locallang_ttc.xlf:images.addFileReference'
                ),
                'minitems' => 1,
                'maxitems' => 10,
            ), $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']),
        )
    ),
    'types' => array(
        '1' => array('showitem' => 'hidden, images')
    ),
//    'palettes' => array(
//        '1' => array('showitem' => 'publisher, --linebreak--, publish_year'),
//    ),
);