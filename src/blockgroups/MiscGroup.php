<?php

namespace trk\uikit\blockgroups;

/**
 * Miscellaneous Block Group.
 *
 * @author İskender TOTOĞLU <iskenedr@altivebir.com>
 */
class MiscGroup extends \luya\cms\base\BlockGroup
{
    public function identifier()
    {
        return 'misc';
    }

    public function label()
    {
        return 'Miscellaneous';
    }

    public function getPosition()
    {
        return 70;
    }
}