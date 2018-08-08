<?php

namespace trk\uikit\admin\filters;

use luya\admin\base\Filter;

/**
 * Medium fixed width filter : width: 1280px, height: auto
 *
 * @author İskender TOTOĞLU <iskender@altivebir.com>
 */
class MediumFixedWidth extends Filter
{
    public static function identifier()
    {
        return 'uk-medium-fixed-width';
    }

    public function name()
    {
        return "Medium Fixed Width (width: 1280px, height: auto)";
    }

    public function chain()
    {
        return [
            [self::EFFECT_THUMBNAIL, [
                'width' => 1280,
                'height' => null
            ]],
        ];
    }
}
