<?php

namespace trk\uikit\blocks;

use trk\uikit\BaseUikitBlock;
use trk\uikit\Module;
use trk\uikit\blockgroups\MiscGroup;

/**
 * Switcher Block.
 *
 * @author Iskender TOTOĞLU <iskender@altivebir.com>
 */
final class SwitcherBlock extends BaseUikitBlock
{
    /**
     * @inheritdoc
     */
    protected $component = "switcher";

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
        return Module::t('switcher');
    }

    /**
     * @inheritdoc
     */
    public function icon()
    {
        return 'tab';
    }

    /**
     * @inheritdoc
     */
    public function frontend(array $params = array())
    {
        if(count($this->getVarValue('items', []))) {
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
