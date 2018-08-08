<?php

namespace trk\uikit\admin;

use Yii;
use luya\base\CoreModuleInterface;

/**
 * Uikit Admin Module.
 *
 *
 * @author İskender TOTOĞLU <iskender@altivebir.com>
 */
final class Module extends \luya\admin\base\Module implements CoreModuleInterface
{
    /**
     * @inheritdoc
     */
    public function getAdminAssets()
    {
        return  [
            'trk\uikit\admin\assets\Main',
        ];
    }
}
