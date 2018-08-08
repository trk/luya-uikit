<?php

use trk\uikit\Uikit;

/**
 * @var $this object
 * @var $data array
 * @var $item array
 */

$attrs_slidenav = [];
$attrs_slidenav_next = [];
$attrs_slidenav_previous = [];
$attrs_slidenav_container = [];

$attrs_slidenav['class'][] = 'el-slidenav';
$attrs_slidenav['href'] = '#';

$attrs_slidenav_previous['uk-slidenav-previous'] = true;
$attrs_slidenav_next['uk-slidenav-next'] = true;

$attrs_slidenav_previous['uk-slider-item'] = 'previous';
$attrs_slidenav_next['uk-slider-item'] = 'next';
// Position + Margin
if ($data['slidenav'] == 'default') {
    $attrs_slidenav_previous['class'][] = 'uk-position-center-left';
    $attrs_slidenav_next['class'][] = 'uk-position-center-right';
    $attrs_slidenav['class'][] = $data['slidenav_margin'] ? "uk-position-{$data['slidenav_margin']}" : '';
} elseif ($data['slidenav'] == 'outside') {
    $attrs_slidenav_previous['class'][] = 'uk-position-center-left-out';
    $attrs_slidenav_next['class'][] = 'uk-position-center-right-out';

    $attrs_slidenav_previous['uk-toggle'] = "cls: uk-position-center-left-out uk-position-center-left; mode: media; media: @{$data['slidenav_outside_breakpoint']}";
    $attrs_slidenav_next['uk-toggle'] = "cls: uk-position-center-right-out uk-position-center-right; mode: media; media: @{$data['slidenav_outside_breakpoint']}";
    $attrs_slidenav['class'][] = $data['slidenav_margin'] ? "uk-position-{$data['slidenav_margin']}" : '';
} else {
    $attrs_slidenav_container['class'][] = 'uk-slidenav-container';
    $attrs_slidenav_container['class'][] = "uk-position-{$data['slidenav']}";
    $attrs_slidenav_container['class'][] = $data['slidenav_margin'] ? "uk-position-{$data['slidenav_margin']}" : '';
}
// Hover
$attrs_slidenav_container['class'][] = $data['slidenav_hover'] ? 'uk-hidden-hover uk-hidden-touch' : '';
// Large
$attrs_slidenav['class'][] = $data['slidenav_large'] ? 'uk-slidenav-large' : '';
// Breakpoint
$attrs_slidenav_container['class'][] = $data['slidenav_breakpoint'] ? "uk-visible@{$data['slidenav_breakpoint']}" : '';
// Color
if ($data['slidenav'] == 'outside' && ($data['slidenav_color'] != $data['slidenav_outside_color'])) {
    if (!$data['slidenav_color']) {
        $attrs_slidenav_container['uk-toggle'] = "cls: js-color-state uk-{$data['slidenav_outside_color']}; mode: media; media: @{$data['slidenav_outside_breakpoint']}";
        $attrs_slidenav_container['class'][] = "js-color-state uk-{$data['slidenav_outside_color']}";
    } elseif (!$data['slidenav_outside_color']) {
        $attrs_slidenav_container['uk-toggle'] = "cls: js-color-state uk-{$data['slidenav_color']}; mode: media; media: @{$data['slidenav_outside_breakpoint']}";
        $attrs_slidenav_container['class'][] = "js-color-state";
    } else {
        $attrs_slidenav_container['uk-toggle'] = "cls: uk-{$data['slidenav_outside_color']} uk-{$data['slidenav_color']}; mode: media; media: @{$data['slidenav_outside_breakpoint']}";
        $attrs_slidenav_container['class'][] = "uk-{$data['slidenav_outside_color']}";
    }
} else {
    $attrs_slidenav_container['class'][] = $data['slidenav_color'] ? "uk-{$data['slidenav_color']}" : '';
}
?>
<div<?= Uikit::attrs($attrs_slidenav_container) ?>>
    <a <?= Uikit::attrs($attrs_slidenav, $attrs_slidenav_previous) ?>></a>
    <a <?= Uikit::attrs($attrs_slidenav, $attrs_slidenav_next) ?>></a>
</div>