<?php

namespace trk\uikit\admin\filters;

use luya\admin\base\Filter;

/**
 * Large fixed width filter : width: 1920px, height: auto
 *
 * @author İskender TOTOĞLU <iskender@altivebir.com>
 */
class LargeFixedWidth extends Filter
{
    public static function identifier()
    {
        return 'uk-large-fixed-width';
    }

    public function name()
    {
        return "Large Fixed Width (width: 1920px, height: auto)";
    }

    public function chain()
    {
        return [
            [self::EFFECT_THUMBNAIL, [
                'width' => 1920,
                'height' => null
            ]],
        ];
    }
}
