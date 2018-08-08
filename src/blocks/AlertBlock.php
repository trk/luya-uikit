<?php

namespace trk\uikit\blocks;

use trk\uikit\BaseUikitBlock;
use trk\uikit\Module;
use trk\uikit\blockgroups\MiscGroup;

/**
 * Alert Block.
 *
 * @author Iskender TOTOĞLU <iskender@altivebir.com>
 */
final class AlertBlock extends BaseUikitBlock
{
    /**
     * @inheritdoc
     */
    protected $component = "alert";

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
        return Module::t('alert');
    }

    /**
     * @inheritdoc
     */
    public function icon()
    {
        return 'warning';
    }

    /**
     * @inheritdoc
     */
    public function admin()
    {
        if($this->getVarValue('title') || $this->getVarValue('content')) {
            return $this->frontend();
        } else {
            return '<div><span class="block__empty-text">' . Module::t('no_content') . '</span></div>';
        }
    }
}
