<?php

namespace trk\uikit;

use Yii;

/**
 * Uikit Module
 *
 * When adding this module to your configuration the uikit 3 blocks will be added to your
 * cms administration by running the `import` command.
 *
 * @author Iskender TOTOĞLU <iskender@altivebir.com>
 */
class Module extends \luya\base\Module
{

    /**
     * @var array configs for store general field configs.
     */
    public static $configs = [];

    /**
     * @inheritdoc
     */
    public static function onLoad()
    {
        Yii::setAlias('@uikit', static::staticBasePath());

        self::registerTranslation('uikit*', static::staticBasePath() . '/messages', [
            'uikit' => 'uikit.php'
        ]);
    }

    /**
     * Translations
     *
     * @param string $message
     * @param array $params
     * @return string
     */
    public static function t($message, array $params = [])
    {
        return parent::baseT('uikit', $message, $params);
    }
}
