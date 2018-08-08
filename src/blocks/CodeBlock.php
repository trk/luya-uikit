<?php

namespace trk\uikit\blocks;

use trk\uikit\BaseUikitBlock;
use trk\uikit\Module;
use luya\cms\frontend\blockgroups\DevelopmentGroup;

/**
 * Code Block.
 *
 * @author Iskender TOTOĞLU <iskender@altivebir.com>
 */
final class CodeBlock extends BaseUikitBlock
{
    /**
     * @inheritdoc
     */
    protected $component = "code";

    /**
     * @inheritdoc
     */
    public function blockGroup()
    {
        return DevelopmentGroup::class;
    }

    /**
     * @inheritdoc
     */
    public function name()
    {
        return Module::t('code');
    }

    /**
     * @inheritdoc
     */
    public function icon()
    {
        return 'code';
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
