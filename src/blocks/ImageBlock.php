<?php

namespace trk\uikit\blocks;

use trk\uikit\BaseUikitBlock;
use trk\uikit\Module;
use luya\cms\frontend\blockgroups\MediaGroup;

/**
 * Image Block.
 *
 * @author Iskender TOTOĞLU <iskender@altivebir.com>
 */
final class ImageBlock extends BaseUikitBlock
{
    /**
     * @inheritdoc
     */
    public $component = "image";

    /**
     * @inheritdoc
     */
    public function blockGroup()
    {
        return MediaGroup::class;
    }

    /**
     * @inheritdoc
     */
    public function name()
    {
        return Module::t('image');
    }

    /**
     * @inheritdoc
     */
    public function icon()
    {
        return 'image';
    }

    /**
     * @inheritdoc
     */
    public function admin()
    {
        if($this->getExtraValue('image')) {
            return $this->frontend();
        } else {
            return '<div><span class="block__empty-text">' . Module::t('no_content') . '</span></div>';
        }
    }
}
