<?php

namespace trk\uikit\blocks;

use trk\uikit\BaseUikitBlock;
use trk\uikit\Module;

/**
 * Divider Block.
 *
 * @author Iskender TOTOĞLU <iskender@altivebir.com>
 */
final class DividerBlock extends BaseUikitBlock
{
    /**
     * @inheritdoc
     */
    protected $component = "divider";

    /**
     * @inheritdoc
     */
    public function name()
    {
        return Module::t('divider');
    }

    /**
     * @inheritdoc
     */
    public function icon()
    {
        return 'warning';
    }

    /**
     * @inheritdoc
     */
    public function admin()
    {
        return $this->frontend();
    }
}
