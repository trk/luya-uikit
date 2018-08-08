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
if (!$data['show_title']) { $item['title'] = ''; }
if (!$data['show_meta']) { $item['meta'] = ''; }
if (!$data['show_content']) { $item['content'] = ''; }
if (!$data['show_image']) { $item['image'] = ''; }
if (!$data['show_link']) { $item['link'] = ''; }
if (!$data['show_label']) { $item['label'] = ''; }
if (!$data['show_thumbnail']) { $item['thumbnail'] = ''; }

$image = '';
// Image
if ($item['image']) {
    $attrs_image['class'][] = 'el-image';
    $attrs_image['class'][] = $data['image_border'] ? "uk-border-{$data['image_border']}" : '';
    $attrs_image['class'][] = $data['image_box_shadow'] ? "uk-box-shadow-{$data['image_box_shadow']}" : '';
    $attrs_image['alt'] = $item['image_alt'];

    if (Uikit::isImage($item['image']) == 'gif') {
        $attrs_image['uk-gif'] = true;
    }
    if (Uikit::isImage($item['image']) == 'svg') {
        $image = Uikit::image($item['image'], array_merge($attrs_image, ['width' => $data['image_width'], 'height' => $data['image_height']]));
    } elseif ($data['image_width'] || $data['image_height']) {
        $image = Uikit::image([$item['image'], 'thumbnail' => [$data['image_width'], $data['image_height']], 'sizes' => '80%,200%'], $attrs_image);
    } else {
        $image = Uikit::image($item['image'], $attrs_image);
    }
}
// Box-shadow bottom
if ($data['image_box_shadow_bottom']) {
    $image = "<div class=\"uk-box-shadow-bottom\">{$image}</div>";
}
// Image Align
$attrs_grid['class'][] = 'uk-child-width-expand';
$attrs_grid['class'][] = $data['image_gutter'] ? "uk-grid-{$data['image_gutter']}" : '';
$attrs_grid['class'][] = $data['image_vertical_align'] ? 'uk-flex-middle' : '';
$attrs_grid['uk-grid'] = true;

$attrs_cell_image['class'][] = "uk-width-{$data['image_grid_width']}@{$data['image_breakpoint']}";
$attrs_cell_image['class'][] = $data['image_align'] == 'right' ? "uk-flex-last@{$data['image_breakpoint']}" : '';
?>
<?php if ($image && in_array($data['image_align'], ['left', 'right'])) : ?>
    <div<?= Uikit::attrs($attrs_grid) ?>>
        <div<?= Uikit::attrs($attrs_cell_image) ?>>
            <?= $image ?>
        </div>
        <div>
            <?= $this->render('content', compact('item', 'data')) ?>
        </div>
    </div>
<?php else : ?>
    <?php if ($data['image_align'] == 'top') : ?>
        <?= $image ?>
    <?php endif ?>
    <?= $this->render('content', compact('item', 'data')) ?>
    <?php if ($data['image_align'] == 'bottom') : ?>
        <?= $image ?>
    <?php endif ?>
<?php endif ?>
