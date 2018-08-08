<?php

namespace trk\uikit\blocks;

use trk\uikit\BaseUikitBlock;
use trk\uikit\Module;
use trk\uikit\blockgroups\NavigationGroup;

/**
 * To Top Block.
 *
 * @author Iskender TOTOĞLU <iskender@altivebir.com>
 */
final class ToTopBlock extends BaseUikitBlock
{
    /**
     * @inheritdoc
     */
    public $component = "to-top";

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
        return Module::t('to-top');
    }

    /**
     * @inheritdoc
     */
    public function icon()
    {
        return 'arrow_upward';
    }

    /**
     * @inheritdoc
     */
    public function frontend(array $params = array())
    {
        return parent::frontend($params);
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
