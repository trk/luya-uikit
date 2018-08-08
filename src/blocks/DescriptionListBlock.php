<?php

namespace trk\uikit\blocks;

use trk\uikit\BaseUikitBlock;
use trk\uikit\Module;
use trk\uikit\blockgroups\MultipleGroup;

/**
 * DescriptionList Block.
 *
 * @author Iskender TOTOĞLU <iskender@altivebir.com>
 */
final class DescriptionListBlock extends BaseUikitBlock
{
    /**
     * @inheritdoc
     */
    protected $component = "description-list";

    /**
     * @inheritdoc
     */
    public function blockGroup()
    {
        return MultipleGroup::class;
    }

    /**
     * @inheritdoc
     */
    public function name()
    {
        return Module::t('description-list');
    }

    /**
     * @inheritdoc
     */
    public function icon()
    {
        return 'view_list';
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
