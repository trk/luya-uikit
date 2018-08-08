<?php

namespace trk\uikit\blocks;

use trk\uikit\BaseUikitBlock;
use trk\uikit\Module;
use luya\cms\frontend\blockgroups\MediaGroup;

/**
 * Video Block.
 *
 * @author Iskender TOTOĞLU <iskender@altivebir.com>
 */
final class VideoBlock extends BaseUikitBlock
{
    /**
     * @inheritdoc
     */
    public $component = "video";

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
        return Module::t('video');
    }

    /**
     * @inheritdoc
     */
    public function icon()
    {
        return 'movie';
    }

    /**
     * @inheritdoc
     */
    public function frontend(array $params = array())
    {
        if($this->getVarValue('video')) {
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
