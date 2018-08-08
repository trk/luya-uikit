<?php

namespace trk\uikit\blocks;

use Yii;
use trk\uikit\BaseFormBlock;
use trk\uikit\Module;

/**
 * Contact Form Block.
 *
 * @author Iskender TOTOĞLU <iskender@altivebir.com>
 */
class ContactFormBlock extends BaseFormBlock
{
    /**
     * @inheritDoc
     */
    protected $fields = [
        'name' => 'text',
        'surname' => 'text',
        'email' => 'email',
        'subject' => 'text',
        'message' => 'textarea'
    ];

    /**
     * @inheritDoc
     */
    protected $required = ['name', 'surname', 'email', 'subject', 'message'];

    /**
     * @inheritDoc
     */
    protected $validations = [
        'name' => 'string',
        'surname' => 'string',
        'email' => 'email',
        'subject' => 'string',
        'message' => 'string'
    ];

    /**
     * @inheritDoc
     */
    public function name()
    {
        return Module::t('block.form.contact_form');
    }
    
    /**
     * @inheritDoc
     */
    public function icon()
    {
        return 'contact_mail';
    }
}