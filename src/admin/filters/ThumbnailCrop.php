<?php

namespace trk\uikit\admin\filters;

use luya\admin\base\Filter;

/**
 * Thumbnail crop filter : width : 100, height: 75
 *
 * @author İskender TOTOĞLU <iskender@altivebir.com>
 */
class ThumbnailCrop extends Filter
{
    public static function identifier()
    {
        return 'uk-thumbnail-crop';
    }

    public function name()
    {
        return "Thumbnail Crop (width: 100px, height: 75px)";
    }

    public function chain()
    {
        return [
            [self::EFFECT_THUMBNAIL, [
                'width' => 100,
                'height' => 75
            ]],
        ];
    }
}
