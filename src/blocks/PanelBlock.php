<?php

namespace trk\uikit\blocks;

use trk\uikit\BaseUikitBlock;
use trk\uikit\Module;
use trk\uikit\blockgroups\MiscGroup;

/**
 * Panel Block.
 *
 * @author Iskender TOTOĞLU <iskender@altivebir.com>
 */
final class PanelBlock extends BaseUikitBlock
{
    /**
     * @inheritdoc
     */
    public $component = "panel";

    /**
     * @inheritdoc
     */
    public function blockGroup()
    {
        return MiscGroup::class;
    }

    /**
     * @inheritdoc
     */
    public function name()
    {
        return Module::t('panel');
    }

    /**
     * @inheritdoc
     */
    public function icon()
    {
        return 'web_asset';
    }

    /**
     * @inheritdoc
     */
    public function frontend(array $params = array())
    {
        if($this->getExtraValue('image')) {
            return parent::frontend($params);
        } else {
            return "";
        }
    }

    /**
     * @inheritdoc
     */
    public function admin()
    {
        if($output = $this->frontend()) {
            return $output;
        } else {
            return '<div><span class="block__empty-text">' . Module::t('no_content') . '</span></div>';
        }
    }
}
