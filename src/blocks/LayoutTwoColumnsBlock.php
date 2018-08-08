<?php

namespace trk\uikit\blocks;

use trk\uikit\BaseLayoutBlock;
use trk\uikit\Module;
use luya\cms\frontend\blockgroups\LayoutGroup;

/**
 * Two Columns Layout Block : halves, thirds-2-1, thirds-1-2, quarters-3-1, quarters-1-3, fixed-left, fixed-right
 *
 * @author İskender TOTOĞLU <basil@nadar.io>
 */
final class LayoutTwoColumnsBlock extends BaseLayoutBlock
{
    /**
     * @return array
     */
    public function availableLayouts() {
        return ['halves', 'thirds-2-1', 'thirds-1-2', 'quarters-3-1', 'quarters-1-3', 'fixed-left', 'fixed-right'];
    }

    /**
     * @return string
     */
    public function defaultLayout() {
        return 'halves';
    }

    /**
     * @inheritdoc
     */
    public function name()
    {
        return Module::t('two-columns-layout');
    }

    /**
     * @inheritdoc
     */
    public function blockGroup()
    {
        return LayoutGroup::class;
    }
}