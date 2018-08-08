<?php

namespace trk\uikit\blocks;

use trk\uikit\BaseUikitBlock;
use trk\uikit\Module;
use luya\cms\frontend\blockgroups\TextGroup;

/**
 * Headline Block.
 *
 * @author Iskender TOTOĞLU <iskender@altivebir.com>
 */
final class HeadlineBlock extends BaseUikitBlock
{
    /**
     * @inheritdoc
     */
    protected $component = "headline";


    /**
     * @inheritdoc
     */
    public function blockGroup()
    {
        return TextGroup::class;
    }

    /**
     * @inheritdoc
     */
    public function name()
    {
        return Module::t('headline');
    }

    /**
     * @inheritdoc
     */
    public function icon()
    {
        return 'format_size';
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
