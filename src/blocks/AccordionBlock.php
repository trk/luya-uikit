<?php

namespace trk\uikit\blocks;

use trk\uikit\BaseUikitBlock;
use trk\uikit\Module;
use trk\uikit\blockgroups\MultipleGroup;

/**
 * Accordion Block.
 *
 * @author Iskender TOTOĞLU <iskender@altivebir.com>
 */
final class AccordionBlock extends BaseUikitBlock
{
    /**
     * @inheritdoc
     */
    protected $component = "accordion";

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
        return Module::t('accordion');
    }

    /**
     * @inheritdoc
     */
    public function icon()
    {
        return 'line_weight';
    }

    /**
     * @inheritdoc
     */
    public function admin()
    {
        if(count($this->getVarValue('items', []))) {
            return $this->frontend();
        } else {
            return '<div><span class="block__empty-text">' . Module::t('no_content') . '</span></div>';
        }
    }
}
