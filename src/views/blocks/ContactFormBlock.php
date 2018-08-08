<?php

use trk\uikit\Uikit;
use trk\uikit\Module;

$hideForm = false;

$id = '';
$class = [];
$attrs = [];

$item_attrs = [];

$style = $this->varValue('style', '');
if($style) {
    $class[] = 'uk-form-' . $style;
    if($style == 'stacked') {
        $item_attrs['class'][] = 'uk-margin';
    }
}

$attrs['role'] = 'form';
$attrs['method'] = 'post';
?>
<?php if ($this->varValue('emailAddress')): ?>
    <?php if ($this->extraValue('name') && $this->extraValue('surname') && $this->extraValue('email') && $this->extraValue('subject') && $this->extraValue('message')): ?>
        <?php if ($this->extraValue('mailerResponse') == 'success'): $hideForm = true;?>
            <div class="uk-alert uk-alert-success">
                <?= Module::t('block.form.mail.success') ?>
            </div>
        <?php else: ?>
            <div class="uk-alert uk-alert-danger">
                <?= Module::t('block.form.mail.error') ?>
            </div>
        <?php endif; ?>
    <?php endif; ?>
    <?php if (!$hideForm): ?>
        <form<?= Uikit::attrs(compact('id', 'class'), $attrs) ?>>
            <input type="hidden" name="_csrf" value="<?= $this->extraValue('csrf'); ?>" />
            <div<?= Uikit::attrs($item_attrs) ?>>
                <label class="uk-form-label" for="name"><?= Module::t('block.form.label.name') ?></label>
                <div class="uk-form-controls">
                    <input class="uk-input" id="name" name="name" placeholder="<?= Module::t('block.form.placeholder.name') ?>" value="<?= $this->extraValue('name'); ?>">
                    <?php if (!$this->extraValue('nameErrorFlag')): ?>
                        <p class="uk-text-danger"><?= Module::t('block.form.error.name') ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <div<?= Uikit::attrs($item_attrs) ?>>
                <label class="uk-form-label" for="surname"><?= Module::t('block.form.label.surname') ?></label>
                <div class="uk-form-controls">
                    <input class="uk-input" id="surname" name="surname" placeholder="<?= Module::t('block.form.placeholder.surname') ?>" value="<?= $this->extraValue('surname'); ?>">
                    <?php if (!$this->extraValue('surnameErrorFlag')): ?>
                        <p class="uk-text-danger"><?= Module::t('block.form.error.surname') ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <div<?= Uikit::attrs($item_attrs) ?>>
                <label class="uk-form-label" for="email"><?= Module::t('block.form.label.email') ?></label>
                <div class="uk-form-controls">
                    <input class="uk-input" id="email" name="email" placeholder="<?= Module::t('block.form.placeholder.email') ?>" value="<?= $this->extraValue('email'); ?>">
                    <?php if (!$this->extraValue('emailErrorFlag')): ?>
                        <p class="uk-text-danger"><?= Module::t('block.form.error.email') ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <div<?= Uikit::attrs($item_attrs) ?>>
                <label class="uk-form-label" for="subject"><?= Module::t('block.form.label.subject') ?></label>
                <div class="uk-form-controls">
                    <input class="uk-input" id="subject" name="subject" placeholder="<?= Module::t('block.form.placeholder.subject') ?>" value="<?= $this->extraValue('subject'); ?>">
                    <?php if (!$this->extraValue('subjectErrorFlag')): ?>
                        <p class="uk-text-danger"><?= Module::t('block.form.error.subject') ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <div<?= Uikit::attrs($item_attrs) ?>>
                <label class="uk-form-label" for="message"><?= Module::t('block.form.label.message') ?></label>
                <div class="uk-form-controls">
                    <textarea class="uk-textarea" rows="5" id="message" name="message" placeholder="<?= Module::t('block.form.placeholder.message') ?>"><?= $this->extraValue('message'); ?></textarea>
                    <?php if (!$this->extraValue('messageErrorFlag')): ?>
                        <p class="uk-text-danger"><?= Module::t('block.form.error.message') ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <div<?= Uikit::attrs($item_attrs) ?>>
                <div class="uk-form-controls">
                    <input class="uk-button uk-button-default" id="submit" name="submit" type="submit" value="<?= Module::t('block.form.button.send') ?>">
                </div>
            </div>
        </form>
    <?php endif; ?>
<?php endif; ?>