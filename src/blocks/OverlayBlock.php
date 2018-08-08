<?php

namespace trk\uikit\blocks;

use trk\uikit\BaseUikitBlock;
use trk\uikit\Module;
use luya\cms\frontend\blockgroups\MediaGroup;

/**
 * Overlay Block.
 *
 * @author Iskender TOTOĞLU <iskender@altivebir.com>
 */
final class OverlayBlock extends BaseUikitBlock
{
    /**
     * @inheritdoc
     */
    public $component = "overlay";

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
        return Module::t('overlay');
    }

    /**
     * @inheritdoc
     */
    public function icon()
    {
        return 'featured_video';
    }

    /**
     * @inheritdoc
     */
    public function frontend(array $params = array())
    {
        if($this->getExtraValue('image')) {
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
