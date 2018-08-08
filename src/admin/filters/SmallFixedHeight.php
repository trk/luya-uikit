<?php

namespace trk\uikit\admin\filters;

use luya\admin\base\Filter;

/**
 * Small Fixed Height filter : width: auto, height: 576px
 *
 * @author İskender TOTOĞLU <iskender@altivebir.com>
 */
class SmallFixedHeight extends Filter
{
    public static function identifier()
    {
        return 'uk-small-fixed-height';
    }

    public function name()
    {
        return "Small Fixed Height (width: auto, height: 576px)";
    }

    public function chain()
    {
        return [
            [self::EFFECT_THUMBNAIL, [
                'width' => null,
                'height' => 576
            ]],
        ];
    }
}
