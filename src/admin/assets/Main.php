<?php

namespace trk\uikit\admin\assets;

/**
 * Uikit Main Asset Bundle.
 *
 * @author İskender TOTOĞLU <iskender@altivebir.com>
 */
class Main extends \yii\web\AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@uikitadmin/resources';

    /**
     * @inheritdoc
     */
    public $js = [
        '//cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-rc.6/js/uikit.min.js',
        '//cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-rc.6/js/uikit-icons.min.js'
    ];

    /**
     * @inheritdoc
     */
    public $css = ['uikitadmin.css'];

    /**
     * @inheritdoc
     */
    public $depends = [
        'luya\admin\assets\Main',
    ];
    
    /**
     * @inheritdoc
     */
    public $publishOptions = [
            'except' => [
                    'node_modules/',
            ]
    ];
}
