<?php

namespace trk\uikit\admin\filters;

use luya\admin\base\Filter;

/**
 * Medium fixed height filter : width: auto, height: 720px
 *
 * @author İskender TOTOĞLU <iskender@altivebir.com>
 */
class MediumFixedHeight extends Filter
{
    public static function identifier()
    {
        return 'uk-medium-fixed-height';
    }

    public function name()
    {
        return "Medium Fixed Height (width: auto, height: 720px)";
    }

    public function chain()
    {
        return [
            [self::EFFECT_THUMBNAIL, [
                'width' => null,
                'height' => 720
            ]],
        ];
    }
}
