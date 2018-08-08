<?php

namespace trk\uikit\blocks;

use trk\uikit\BaseLayoutBlock;
use trk\uikit\Module;
use luya\cms\frontend\blockgroups\LayoutGroup;

/**
 * Three Columns Layout Block : thirds, quarters-2-1-1, quarters-1-1-2, quarters-1-2-1, fixed-inner, fixed-outer
 *
 * @author İskender TOTOĞLU <basil@nadar.io>
 */
final class LayoutThreeColumnsBlock extends BaseLayoutBlock
{

    /**
     * @return array
     */
    public function availableLayouts() {
        return ['thirds', 'quarters-2-1-1', 'quarters-1-1-2', 'quarters-1-2-1', 'fixed-inner', 'fixed-outer'];
    }

    /**
     * @return string
     */
    public function defaultLayout() {
        return 'thirds';
    }

    /**
     * @inheritdoc
     */
    public function name()
    {
        return Module::t('three-columns-layout');
    }

    /**
     * @inheritdoc
     */
    public function blockGroup()
    {
        return LayoutGroup::class;
    }
}