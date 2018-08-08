<?php

namespace trk\uikit\admin\filters;

use luya\admin\base\Filter;

/**
 * Thumbnail fixed height : (width : auto, height: 75)
 *
 * @author İskender TOTOĞLU <iskender@altivebir.com>
 */
class ThumbnailFixedHeight extends Filter
{
    public static function identifier()
    {
        return 'uk-thumbnail-fixed-height';
    }

    public function name()
    {
        return 'Thumbnail fixed width (width : 100px, height: auto)';
    }

    public function chain()
    {
        return [
            [self::EFFECT_THUMBNAIL, [
                'width' => null,
                'height' => 75
            ]],
        ];
    }
}
