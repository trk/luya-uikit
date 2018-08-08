<?php

use trk\uikit\Uikit;

/**
 * @var $this object
 * @var $data array
 * @var $item array
 */

$attrs_image = [];

// Image
if ($item['image']) {
    $attrs_image['class'][] = 'el-image uk-preserve-width';
    $attrs_image['class'][] = $data['image_border'] ? "uk-border-{$data['image_border']}" : '';
    $attrs_image['class'][] = $data['image_box_shadow'] ? "uk-box-shadow-{$data['image_box_shadow']}" : '';
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
?>
<?= $item['image'] ?>
