<?php

namespace trk\uikit\admin\filters;

use luya\admin\base\Filter;

/**
 * Small HD Crop filter : width: 1024px, height: 576px
 *
 * @author İskender TOTOĞLU <iskender@altivebir.com>
 */
class SmallHDCrop extends Filter
{
    public static function identifier()
    {
        return 'uk-small-hd-crop';
    }

    public function name()
    {
        return "16:9 Small Crop (width: 1024px, height: 576px)";
    }

    public function chain()
    {
        return [
            [self::EFFECT_THUMBNAIL, [
                'width' => 1024,
                'height' => 576
            ]],
        ];
    }
}
