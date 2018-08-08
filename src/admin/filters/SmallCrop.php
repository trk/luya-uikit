<?php

namespace trk\uikit\admin\filters;

use luya\admin\base\Filter;

/**
 * Small Crop filter : width: 640px, height: 480px
 *
 * @author İskender TOTOĞLU <iskender@altivebir.com>
 */
class SmallCrop extends Filter
{
    public static function identifier()
    {
        return 'uk-small-crop';
    }

    public function name()
    {
        return "4:3 Small Crop (width: 640px, height: 480px)";
    }

    public function chain()
    {
        return [
            [self::EFFECT_THUMBNAIL, [
                'width' => 640,
                'height' => 480
            ]],
        ];
    }
}
