<?php

namespace trk\uikit\blockgroups;

/**
 * Form Block Group.
 *
 * @author İskender TOTOĞLU <iskenedr@altivebir.com>
 */
class FormGroup extends \luya\cms\base\BlockGroup
{
    public function identifier()
    {
        return 'form';
    }

    public function label()
    {
        return 'Form';
    }

    public function getPosition()
    {
        return 80;
    }
}