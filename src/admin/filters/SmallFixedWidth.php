<?php

namespace trk\uikit\admin\filters;

use luya\admin\base\Filter;

/**
 * Small fixed width filter : width: 640px, height: auto
 *
 * @author İskender TOTOĞLU <iskender@altivebir.com>
 */
class SmallFixedWidth extends Filter
{
    public static function identifier()
    {
        return 'uk-small-fixed-width';
    }

    public function name()
    {
        return "Small Fixed Width (width: 640px, height: auto)";
    }

    public function chain()
    {
        return [
            [self::EFFECT_THUMBNAIL, [
                'width' => 640,
                'height' => null
            ]],
        ];
    }
}
