<?php

namespace trk\uikit\blocks;

use trk\uikit\BaseUikitBlock;
use trk\uikit\Module;
use luya\cms\frontend\blockgroups\TextGroup;

/**
 * Text Block.
 *
 * @author Iskender TOTOĞLU <iskender@altivebir.com>
 */
final class TextBlock extends BaseUikitBlock
{
    /**
     * @inheritdoc
     */
    public $component = "text";

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
        return Module::t('text');
    }

    /**
     * @inheritdoc
     */
    public function icon()
    {
        return 'subject';
    }

    /**
     * @inheritdoc
     */
    public function frontend(array $params = array())
    {
        if($this->getVarValue('content')) {
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
