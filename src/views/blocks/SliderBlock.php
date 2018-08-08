<?php

use trk\uikit\Uikit;

/**
 * @var $this object
 * @var $data array
 */

$id    = $data['id'];
$class = $data['class'];
$attrs = $data['attrs'];
$attrs_slider_items = [];
$attrs_slider_item = [];
$attrs_container = [];

// Slider
$options = [];
$options[] = $data['slider_sets'] ? 'sets: true' : '';
$options[] = $data['slider_center'] ? 'center: true' : '';
$options[] = $data['slider_finite'] ? 'finite: true' : '';
$options[] = $data['slider_velocity'] ? "velocity: {$data['slider_velocity']}" : '';
if ($data['slider_autoplay']) {
    $options[] = 'autoplay: true';
    $options[] = !$data['slider_autoplay_pause'] ? 'pauseOnHover: false' : '';
    $options[] = $data['slider_autoplay_interval'] ? "autoplayInterval: {$data['slider_autoplay_interval']}000" : '';
}
$attrs['uk-slider'] = implode(';', array_filter($options)) ?: true;
// Slider Items
$attrs_slider_items['class'][] = 'uk-slider-items';
$attrs_slider_item['class'][] = 'el-item';
if ($data['slider_width']) {
    $attrs_slider_item['class'][] = "uk-width-{$data['slider_width_default']}";
    $attrs_slider_item['class'][] = $data['slider_width_small'] ? "uk-width-{$data['slider_width_small']}@s" : '';
    $attrs_slider_item['class'][] = $data['slider_width_medium'] ? "uk-width-{$data['slider_width_medium']}@m" : '';
    $attrs_slider_item['class'][] = $data['slider_width_large'] ? "uk-width-{$data['slider_width_large']}@l" : '';
    $attrs_slider_item['class'][] = $data['slider_width_xlarge'] ? "uk-width-{$data['slider_width_xlarge']}@xl" : '';

}
if ($data['slider_gutter']) {
    $attrs_slider_items['class'][] = $data['slider_gutter'] == 'default' ? "uk-grid" : "uk-grid uk-grid-{$data['slider_gutter']}";
    $attrs_slider_items['class'][] = $data['slider_divider'] ? 'uk-grid-divider' : '';
}
// Height Viewport
if ($data['slider_width'] && $data['slider_height']) {
    $options = ['offset-top: true'];
    $options[] = $data['slider_min_height'] ? "minHeight: {$data['slider_min_height']}" : '';
    switch ($data['slider_height']) {
        case 'percent':
            $options[] = 'offset-bottom: 20';
            break;
        case 'section':
            $options[] = 'offset-bottom: !.uk-section +';
            break;
    }
    $attrs_slider_items['uk-height-viewport'] = implode(';', array_filter($options));
    $attrs_slider_items['class'][] = 'uk-grid-match';
}
// Container
$attrs_container['class'][] = 'uk-position-relative';
$attrs_container['class'][] = $data['slidenav'] && $data['slidenav_hover'] ? 'uk-visible-toggle' : '';
?>
<div<?= Uikit::attrs(compact('id', 'class'), $attrs) ?>>
    <div<?= Uikit::attrs($attrs_container) ?>>
        <?php if ($data['slidenav'] == 'outside') : ?>
        <div class="uk-slider-container">
            <?php endif ?>
            <ul<?= Uikit::attrs($attrs_slider_items) ?>>
                <?php foreach ($data['items'] as $i => $item) : ?>
                    <li<?= Uikit::attrs($attrs_slider_item) ?>><?= $this->render('slider/item', compact('item', 'i', 'data')) ?></li>
                <?php endforeach ?>

            </ul>
            <?php if ($data['slidenav'] == 'outside') : ?>
        </div>
    <?php endif ?>
        <?php if ($data['slidenav']) : ?>
            <?= $this->render('slider/slidenav', compact('item', 'data')) ?>
        <?php endif ?>

    </div>
    <?php if ($data['nav']): ?>
        <?= $this->render('slider/nav', compact('item', 'data')) ?>
    <?php endif ?>
</div>