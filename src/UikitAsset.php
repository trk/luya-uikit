<?php
namespace trk\uikit;

/**
 * U,kit CDN Asset Bundle.
 *
 * @author İskender TOTOĞLU <iskender@altivebir.com>
 */
class UikitAsset extends \yii\web\AssetBundle
{
    public $js = [
        ['//cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-rc.6/js/uikit.min.js', 'crossorigin' => 'anonymous'],
        ['//cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-rc.6/js/uikit-icons.min.js', 'crossorigin' => 'anonymous'],
    ];

    public $css = [
        ['//cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-rc.6/css/uikit.min.css', 'crossorigin' => 'anonymous'],
    ];

    public $depends = [];
}