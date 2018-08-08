<?php

namespace trk\uikit\admin\filters;

use luya\admin\base\Filter;

/**
 * Thumbnail fixed width : (width : 100, height: auto)
 *
 * @author İskender TOTOĞLU <iskender@altivebir.com>
 */
class ThumbnailFixedWidth extends Filter
{
    public static function identifier()
    {
        return 'uk-thumbnail-fixed-width';
    }

    public function name()
    {
        return 'Thumbnail fixed width (width : auto, height: 75px)';
    }

    public function chain()
    {
        return [
            [self::EFFECT_THUMBNAIL, [
                'width' => 100,
                'height' => null
            ]],
        ];
    }
}
