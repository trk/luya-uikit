<?php

namespace trk\uikit;

/**
 * Uikit 4 Active Field.
 *
 * @author İskender TOTOĞLU <iskender@altivebir.com>
 */
class ActiveField extends \yii\widgets\ActiveField
{
    /**
     * @inheritdoc
     */
    public $hintOptions = ['class' => 'form-text text-muted', 'tag' => 'small'];

    /**
     * @inheritdoc
     */
    public $errorOptions = ['class' => 'invalid-feedback'];
}