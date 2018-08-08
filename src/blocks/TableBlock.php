<?php

namespace trk\uikit\blocks;

use trk\uikit\BaseUikitBlock;
use trk\uikit\Module;
use trk\uikit\blockgroups\MiscGroup;

/**
 * Table Block.
 *
 * @author Iskender TOTOĞLU <iskender@altivebir.com>
 */
final class TableBlock extends BaseUikitBlock
{
    /**
     * @inheritdoc
     */
    protected $component = "table";

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
        return Module::t('table');
    }

    /**
     * @inheritdoc
     */
    public function icon()
    {
        return 'table_cart';
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
