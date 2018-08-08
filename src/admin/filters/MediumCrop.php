<?php

namespace trk\uikit\admin\filters;

use luya\admin\base\Filter;

/**
 * Medium Crop filter : width: 1280px, height: 960px
 *
 * @author İskender TOTOĞLU <iskender@altivebir.com>
 */
class MediumCrop extends Filter
{
    public static function identifier()
    {
        return 'uk-medium-crop';
    }

    public function name()
    {
        return "4:3 Medium Crop (width: 1280px, height: 960px)";
    }

    public function chain()
    {
        return [
            [self::EFFECT_THUMBNAIL, [
                'width' => 1280,
                'height' => 960
            ]],
        ];
    }
}
