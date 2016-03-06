<?php
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;
use Hirnschmalz\Swiper\Utility\Div;

ExtensionUtility::registerPlugin(
    Div::vendorNamespace . '.' . $_EXTKEY,
    'Slider',
    'Slider plugin description'
);