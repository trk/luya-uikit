<?php

use trk\uikit\Uikit;

/**
 * @var $this object
 * @var $data array
 * @var $item array
 */

$attrs_nav = [];
$attrs_nav_container = [];

$attrs_nav['class'][] = 'el-nav uk-slider-nav';
// Style
$attrs_nav['class'][] = $data['nav'] ? "uk-{$data['nav']}" : '';
// Alignment
$attrs_nav['class'][] = "uk-flex-{$data['nav_align']}";
// Margin
switch ($data['nav_margin']) {
    case '':
        $attrs_nav_container['class'][] = 'uk-margin-top';
        break;
    default:
        $attrs_nav_container['class'][] = "uk-margin-{$data['nav_margin']}-top";
}
// Wrapping
$attrs_nav['uk-margin'] = true;
// Breakpoint
$attrs_nav_container['class'][] = $data['nav_breakpoint'] ? "uk-visible@{$data['nav_breakpoint']}" : '';
// Color
$attrs_nav_container['class'][] = $data['nav_color'] ? "uk-{$data['nav_color']}" : '';
?>
<?php if ($data['nav_color']) : ?>
<div<?= Uikit::attrs($attrs_nav_container) ?>>
<?php endif ?>
    <ul<?= Uikit::attrs($attrs_nav, !$data['nav_color'] ? $attrs_nav_container : []) ?>></ul>
<?php if ($data['nav_color']) : ?>
</div>
<?php endif ?>