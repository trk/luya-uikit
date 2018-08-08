<?php

namespace trk\uikit\blocks;

use trk\uikit\BaseUikitBlock;
use trk\uikit\Module;
use trk\uikit\blockgroups\MiscGroup;

/**
 * Grid Block.
 *
 * @author Iskender TOTOĞLU <iskender@altivebir.com>
 */
final class GridBlock extends BaseUikitBlock
{
    /**
     * @inheritdoc
     */
    public $component = "grid";

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
        return Module::t('grid');
    }

    /**
     * @inheritdoc
     */
    public function icon()
    {
        return 'view_module';
    }

    /**
     * @inheritdoc
     */
    public function admin()
    {
        if($this->getVarValue('content')) {
            return $this->frontend();
        } else {
            return '<div><span class="block__empty-text">' . Module::t('no_content') . '</span></div>';
        }
    }
}
