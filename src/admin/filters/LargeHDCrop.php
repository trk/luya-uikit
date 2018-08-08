<?php

namespace trk\uikit\admin\filters;

use luya\admin\base\Filter;

/**
 * Large HD Crop filter : width: 1920px, height: 1080px
 *
 * @author İskender TOTOĞLU <iskender@altivebir.com>
 */
class LargeHDCrop extends Filter
{
    public static function identifier()
    {
        return 'uk-large-hd-crop';
    }

    public function name()
    {
        return "16:9 Large Crop (width: 1920px, height: 1080px)";
    }

    public function chain()
    {
        return [
            [self::EFFECT_THUMBNAIL, [
                'width' => 1920,
                'height' => 1080
            ]],
        ];
    }
}
