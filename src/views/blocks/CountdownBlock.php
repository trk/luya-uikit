<?php

use trk\uikit\Uikit;
use Yii;

/**
 * @var $this object
 * @var $data array
 */

$id    = $data['id'];
$class = $data['class'];
$attrs = $data['attrs'];
$attrs_label = [];

// Countdown
$data['date'] = gmdate("Y-m-d\TH:i:s\Z", $data['date']);
$attrs['uk-countdown'] = 'date: '.($data['date'] ? $data['date'] : date('Y-m-d', strtotime('+1 week')));
// Grid
$attrs['uk-grid'] = true;
$class[] = 'uk-child-width-auto';
$class[] = $data['gutter'] ? "uk-grid-{$data['gutter']}" : '';

// Flex alignment
if ($data['text_align'] && $data['text_align_breakpoint']) {
    $class[] = "uk-flex-{$data['text_align']}@{$data['text_align_breakpoint']}";
    if ($data['text_align_fallback']) {
        $class[] = "uk-flex-{$data['text_align_fallback']}";
    }
} else if ($data['text_align']) {
    $class[] = "uk-flex-{$data['text_align']}";
}

// Label
$attrs_label['class'][] = 'uk-countdown-label uk-text-center uk-visible@s';

switch ($data['label_margin']) {
    case '':
        $attrs_label['class'][] = 'uk-margin';
        break;
    default:
        $attrs_label['class'][] = "uk-margin-{$data['label_margin']}";
}

$label_days = $data['label_days'] ?: Yii::t('uikit', 'Days');
$label_hours = $data['label_hours'] ?: Yii::t('uikit', 'Hours');
$label_minutes = $data['label_minutes'] ?: Yii::t('uikit', 'Minutes');
$label_seconds = $data['label_seconds'] ?: Yii::t('uikit', 'Seconds');
?>
<div<?= Uikit::attrs(compact('id', 'class'), $attrs) ?>>
    <div>
        <div class="uk-countdown-number uk-countdown-days"></div>
        <?php if ($data['show_label']) : ?>
            <div<?= Uikit::attrs($attrs_label) ?>><?= $label_days ?></div>
        <?php endif ?>
    </div>
    <?php if ($data['show_separator']) : ?>
        <div class="uk-countdown-separator">:</div>
    <?php endif ?>
    <div>
        <div class="uk-countdown-number uk-countdown-hours"></div>
        <?php if ($data['show_label']) : ?>
            <div<?= Uikit::attrs($attrs_label) ?>><?= $label_hours ?></div>
        <?php endif ?>
    </div>
    <?php if ($data['show_separator']) : ?>
        <div class="uk-countdown-separator">:</div>
    <?php endif ?>
    <div>
        <div class="uk-countdown-number uk-countdown-minutes"></div>
        <?php if ($data['show_label']) : ?>
            <div<?= Uikit::attrs($attrs_label) ?>><?= $label_minutes ?></div>
        <?php endif ?>
    </div>
    <?php if ($data['show_separator']) : ?>
        <div class="uk-countdown-separator">:</div>
    <?php endif ?>
    <div>
        <div class="uk-countdown-number uk-countdown-seconds"></div>
        <?php if ($data['show_label']) : ?>
            <div<?= Uikit::attrs($attrs_label) ?>><?= $label_seconds ?></div>
        <?php endif ?>
    </div>
</div>