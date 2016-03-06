<?php

use TYPO3\CMS\Extbase\Utility\ExtensionUtility;
use Hirnschmalz\Swiper\Utility\Div;

if (!defined ('TYPO3_MODE')) die ('Access denied.');

ExtensionUtility::configurePlugin(
    Div::vendorNamespace . '.' . $_EXTKEY,
    'Slider',
    array('Slider' => 'show')
);