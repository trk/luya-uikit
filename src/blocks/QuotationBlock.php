<?php

namespace trk\uikit\blocks;

use trk\uikit\BaseUikitBlock;
use trk\uikit\Module;
use luya\cms\frontend\blockgroups\TextGroup;

/**
 * Quotation Block.
 *
 * @author Iskender TOTOĞLU <iskender@altivebir.com>
 */
final class QuotationBlock extends BaseUikitBlock
{
    /**
     * @inheritdoc
     */
    public $component = "quotation";

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
        return Module::t('quotation');
    }

    /**
     * @inheritdoc
     */
    public function icon()
    {
        return 'format_quote';
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
        if($this->getVarValue('content')) {
            return $this->frontend();
        } else {
            return '<div><span class="block__empty-text">' . Module::t('no_content') . '</span></div>';
        }
    }
}
