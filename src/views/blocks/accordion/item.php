<?php

use trk\uikit\Uikit;

/**
 * @var $this object
 * @var $data array
 * @var $item array
 */

$attrs_image = [];
$attrs_grid = [];
$attrs_cell_image = [];

// Display
if (!$data['show_image']) { $item['image'] = ''; }
if (!$data['show_link']) { $item['link'] = ''; }

// Image
if ($item['image']) {

    $attrs_image['class'][] = 'el-image';
    $attrs_image['class'][] = $data['image_border'] ? "uk-border-{$data['image_border']}" : '';
    $attrs_image['alt'] = $item['image_alt'];

    if (Uikit::isImage($item['image']) == 'gif') {
        $attrs_image['uk-gif'] = true;
    }

    if (Uikit::isImage($item['image']) == 'svg') {
        $item['image'] = Uikit::image($item['image'], array_merge($attrs_image, ['width' => $data['image_width'], 'height' => $data['image_height']]));
    } elseif ($data['image_width'] || $data['image_height']) {
        $item['image'] = Uikit::image([$item['image'], 'thumbnail' => [$data['image_width'], $data['image_height']], 'sizes' => '80%,200%'], $attrs_image);
    } else {
        $item['image'] = Uikit::image($item['image'], $attrs_image);
    }

}

// Image Align
$attrs_grid['class'][] = 'uk-child-width-expand';
$attrs_grid['class'][] = $data['image_gutter'] ? "uk-grid-{$data['image_gutter']}" : '';
$attrs_grid['class'][] = $data['image_vertical_align'] ? 'uk-flex-middle' : '';
$attrs_grid['uk-grid'] = true;

$attrs_cell_image['class'][] = "uk-width-{$data['image_grid_width']}@{$data['image_breakpoint']}";
$attrs_cell_image['class'][] = $data['image_align'] == 'right' ? "uk-flex-last@{$data['image_breakpoint']}" : '';

?>
<?php if ($item['image'] && in_array($data['image_align'], ['left', 'right'])) : ?>
    <div<?= Uikit::attrs($attrs_grid) ?>>
        <div<?= Uikit::attrs($attrs_cell_image) ?>>
            <?= $item['image'] ?>
        </div>
        <div>
            <?= $this->render('content', compact('item', 'data')) ?>
        </div>
    </div>
<?php else : ?>
    <?php if ($data['image_align'] == 'top') : ?>
        <?= $item['image'] ?>
    <?php endif ?>
    <?= $this->render('content', compact('item', 'data')) ?>
    <?php if ($data['image_align'] == 'bottom') : ?>
        <?= $item['image'] ?>
    <?php endif ?>
<?php endif ?>
