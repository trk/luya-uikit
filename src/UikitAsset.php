
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
        ['//cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-rc.6/js/uikit.min.js', 'integrity' => 'sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ', 'crossorigin' => 'anonymous'],
        ['//cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-rc.6/js/uikit-icons.min.js', 'integrity' => 'sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm', 'crossorigin' => 'anonymous'],
    ];

    public $css = [
        ['//cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-rc.6/css/uikit.min.css', 'integrity' => 'sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4', 'crossorigin' => 'anonymous'],
    ];

    public $depends = [];
}