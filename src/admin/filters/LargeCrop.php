<?php

namespace trk\uikit\admin\filters;

use luya\admin\base\Filter;

/**
 * Large crop filter : width: 1920px, height: 1440px
 *
 * @author İskender TOTOĞLU <iskender@altivebir.com>
 */
class LargeCrop extends Filter
{
    public static function identifier()
    {
        return 'uk-large-crop';
    }

    public function name()
    {
        return "4:3 Large Crop (width: 1920px, height: 1440px)";
    }

    public function chain()
    {
        return [
            [self::EFFECT_THUMBNAIL, [
                'width' => 1920,
                'height' => 1440
            ]],
        ];
    }
}
