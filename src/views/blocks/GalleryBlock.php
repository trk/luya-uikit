<?php

use trk\uikit\Uikit;

/**
 * @var $this object
 * @var $data array
 */

$id    = $data['id'];
$class = $data['class'];
$attrs = $data['attrs'];
$attrs_cell = [];

// Grid
if ($data['grid_mode'] == 'parallax') {
    $attrs['uk-grid-parallax'] = "translate: {$data['grid_parallax_y']}";
} else {
    $attrs['uk-grid'] = true;
}

$class[] = "uk-child-width-1-{$data['grid_default']}";

$class[] = $data['grid_small'] ? "uk-child-width-1-{$data['grid_small']}@s" : '';
$class[] = $data['grid_medium'] ? "uk-child-width-1-{$data['grid_medium']}@m" : '';
$class[] = $data['grid_large'] ? "uk-child-width-1-{$data['grid_large']}@l" : '';
$class[] = $data['grid_xlarge'] ? "uk-child-width-1-{$data['grid_xlarge']}@xl" : '';

$class[] = $data['gutter'] ? "uk-grid-{$data['gutter']}" : '';
$class[] = $data['divider'] ? 'uk-grid-divider' : '';
// Lightbox
$attrs['uk-lightbox'] = $data['lightbox'] ? 'toggle: a[data-type]' : false;
// Orientation
$attrs_cell['class'][] = $data['image_orientation'] ? 'uk-flex uk-flex-center uk-flex-middle' : '';
?>
<div<?= Uikit::attrs(compact('id', 'class'), $attrs) ?>>
    <?php foreach ($data['items'] as $item) : ?>
        <div<?= Uikit::attrs($attrs_cell) ?>><?= $this->render('gallery/item', compact('item', 'data')) ?></div>
    <?php endforeach ?>
</div>