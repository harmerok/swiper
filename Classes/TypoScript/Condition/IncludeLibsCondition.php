<?php
namespace Hirnschmalz\Swiper\TypoScript\Condition;

use Hirnschmalz\Swiper\Utility\Div;

class IncludeLibsCondition extends \TYPO3\CMS\Core\Configuration\TypoScript\ConditionMatching\AbstractCondition
{
    public function matchCondition(array $conditionParameters)
    {
        $extConfig = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['swiper']);
        return (is_array($extConfig) && $extConfig[Div::extConfig_includeAlways]) ? TRUE : FALSE;
    }
}