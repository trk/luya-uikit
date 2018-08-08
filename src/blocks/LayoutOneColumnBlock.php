<?php

namespace trk\uikit\blocks;

use trk\uikit\BaseLayoutBlock;
use trk\uikit\Module;
use luya\cms\frontend\blockgroups\LayoutGroup;

/**
 * One Column Layout Block: whole
 *
 * @author İskender TOTOĞLU <basil@nadar.io>
 */
final class LayoutOneColumnBlock extends BaseLayoutBlock
{
    /**
     * @return array
     */
    public function availableLayouts() {
        return ['whole'];
    }

    /**
     * @return string
     */
    public function defaultLayout() {
        return 'whole';
    }

    /**
     * @inheritdoc
     */
    public function name()
    {
        return Module::t('one-column-layout');
    }

    /**
     * @inheritdoc
     */
    public function blockGroup()
    {
        return LayoutGroup::class;
    }
}