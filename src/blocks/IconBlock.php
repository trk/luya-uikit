<?php

namespace trk\uikit\blocks;

use trk\uikit\BaseUikitBlock;
use trk\uikit\Module;
use trk\uikit\blockgroups\NavigationGroup;

/**
 * Icon Block.
 *
 * @author Iskender TOTOĞLU <iskender@altivebir.com>
 */
final class IconBlock extends BaseUikitBlock
{
    /**
     * @inheritdoc
     */
    protected $component = "icon";

    /**
     * @inheritdoc
     */
    public function blockGroup()
    {
        return NavigationGroup::class;
    }

    /**
     * @inheritdoc
     */
    public function name()
    {
        return Module::t('icon');
    }

    /**
     * @inheritdoc
     */
    public function icon()
    {
        return 'call_missed_outgoing';
    }

    /**
     * @inheritdoc
     */
    public function frontend(array $params = array())
    {
        if($this->getVarValue('icon')) {
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
