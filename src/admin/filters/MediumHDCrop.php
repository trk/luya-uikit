<?php

namespace trk\uikit\admin\filters;

use luya\admin\base\Filter;

/**
 * HD Ready filter : width: 1280px, height: 720px
 *
 * @author İskender TOTOĞLU <iskender@altivebir.com>
 */
class MediumHDCrop extends Filter
{
    public static function identifier()
    {
        return 'uk-medium-hd-crop';
    }

    public function name()
    {
        return "16:9 Medium Crop (width: 1280px, height: 720px)";
    }

    public function chain()
    {
        return [
            [self::EFFECT_THUMBNAIL, [
                'width' => 1280,
                'height' => 720
            ]],
        ];
    }
}
