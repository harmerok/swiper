<?php

use Hirnschmalz\Swiper\Utility\Div;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

$ll = 'LLL:EXT:' . Div::extKey .'/Resources/Private/Language/locallang_db.xlf:';

return array(
    'ctrl' => array(
        'title' => $ll . 'tx_swiper_domain_model_slide',
        'label' => 'uid',
        'label_userFunc' => 'Hirnschmalz\Swiper\Service\Userfunc\Tca->slideTitle',
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
        'searchFields' => 'content'
    ),
    'interface' => array(
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, image, content',
    ),
    'columns' => array(
        'image' => array(
            'exclude' => 1,
            'title' => $ll . 'tx_swiper_domain_model_slide.image',
            'label' => 'Image',
            'config' => ExtensionManagementUtility::getFileFieldTCAConfig('image', array(
                'foreign_types' => array(
                    \TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => array(
                        'showitem' => '--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette,
                                  --palette--;;imageoverlayPalette,
                                  --palette--;;filePalette'
                    ),
                ),
                'appearance' => array(
                    'createNewRelationLinkTitle' => 'LLL:EXT:cms/locallang_ttc.xlf:images.addFileReference'
                ),
                'maxitems' => 1,
            ), $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']),
        ),
        'content' => array(
            'label' => $ll . 'tx_swiper_domain_model_slide.content',
            'config' => array(
                'type' => 'text',
                'cols' => 40,
                'rows' => 6
            ),
            'defaultExtras' => 'richtext[]'
        ),
    ),
    'types' => array(
        '1' => array('showitem' => 'hidden, image, content')
    ),
);