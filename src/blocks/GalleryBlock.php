<?php

namespace trk\uikit\blocks;

use trk\uikit\BaseUikitBlock;
use trk\uikit\Module;
use luya\cms\frontend\blockgroups\MediaGroup;

/**
 * Gallery Block.
 *
 * @author Iskender TOTOĞLU <iskender@altivebir.com>
 */
final class GalleryBlock extends BaseUikitBlock
{
    /**
     * @inheritdoc
     */
    public $component = "gallery";

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
        return Module::t('gallery');
    }

    /**
     * @inheritdoc
     */
    public function icon()
    {
        return 'view_module';
    }

    /**
     * @inheritdoc
     */
    public function frontend(array $params = array())
    {
        if($this->getVarValue('items', [])) {
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
