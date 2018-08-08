<?php

namespace trk\uikit\blocks;

use trk\uikit\BaseLayoutBlock;
use trk\uikit\Module;
use luya\cms\frontend\blockgroups\LayoutGroup;

/**
 * Three Columns Layout Block : quarters
 *
 * @author İskender TOTOĞLU <basil@nadar.io>
 */
final class LayoutFourColumnsBlock extends BaseLayoutBlock
{

    /**
     * @return array
     */
    public function availableLayouts() {
        return ['quarters'];
    }

    /**
     * @return string
     */
    public function defaultLayout() {
        return 'quarters';
    }

    /**
     * @inheritdoc
     */
    public function name()
    {
        return Module::t('four-columns-layout');
    }

    /**
     * @inheritdoc
     */
    public function blockGroup()
    {
        return LayoutGroup::class;
    }
}