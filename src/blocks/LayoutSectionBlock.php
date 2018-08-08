<?php

namespace trk\uikit\blocks;

use trk\uikit\BaseUikitBlock;
use trk\uikit\Module;
use luya\cms\frontend\blockgroups\LayoutGroup;

/**
 * Section Layout
 *
 * @author İskender TOTOĞLU <basil@nadar.io>
 */
final class LayoutSectionBlock extends BaseUikitBlock
{
    /**
     * @inheritdoc
     */
    protected $component = "section";

    /**
     * @inheritdoc
     */
    public function name()
    {
        return Module::t('section');
    }

    /**
     * @inheritdoc
     */
    public function icon()
    {
        return 'aspect_ratio';
    }

    /**
     * @inheritdoc
     */
    protected function getPlaceholders()
    {
        return [
            ['var' => 'content', 'cols' => $this->getExtraValue('content')]
        ];
    }

    public function extraVars()
    {
        $this->extraValues['content'] = 12;
        return parent::extraVars();
    }

    /**
     * @inheritdoc
     */
    public function admin()
    {
        return '';
    }

    /**
     * @inheritdoc
     */
    public function blockGroup()
    {
        return LayoutGroup::class;
    }
}