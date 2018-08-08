<?php

namespace trk\uikit\blocks;

use trk\uikit\BaseUikitBlock;
use trk\uikit\Module;
use trk\uikit\blockgroups\MiscGroup;

/**
 * Countdown Block.
 *
 * @author Iskender TOTOĞLU <iskender@altivebir.com>
 */
final class CountdownBlock extends BaseUikitBlock
{
    /**
     * @inheritdoc
     */
    protected $component = "countdown";

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
        return Module::t('countdown');
    }

    /**
     * @inheritdoc
     */
    public function icon()
    {
        return 'alarm';
    }

    /**
     * @inheritdoc
     */
    public function frontend(array $params = array())
    {
        if($this->getVarValue('date')) {
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
