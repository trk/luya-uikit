<?php

namespace trk\uikit\admin\filters;

use luya\admin\base\Filter;

/**
 * Large fixed height filter : width: auto, height: 1080px
 *
 * @author İskender TOTOĞLU <iskender@altivebir.com>
 */
class LargeFixedHeight extends Filter
{
    public static function identifier()
    {
        return 'uk-large-fixed-height';
    }

    public function name()
    {
        return "Large Fixed Height (width: auto, height: 1080px)";
    }

    public function chain()
    {
        return [
            [self::EFFECT_THUMBNAIL, [
                'width' => null,
                'height' => 1080
            ]],
        ];
    }
}
