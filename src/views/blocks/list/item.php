<?php

use trk\uikit\Uikit;

/**
 * @var $this object
 * @var $data array
 * @var $item array
 */

$attrs_grid = [];
$attrs_cell = [];
$attrs_content = [];
$attrs_link = [];

// Display
if (!$data['show_image']) { $item['image'] = ''; }
if (!$data['show_link']) { $item['link'] = ''; }

// Image Align
$attrs_grid['class'][] = 'uk-grid-small uk-child-width-expand uk-flex-nowrap uk-flex-middle';
$attrs_grid['uk-grid'] = true;
$attrs_cell['class'][] = 'uk-width-auto';
$attrs_cell['class'][] = $data['image_align'] == 'right' ? 'uk-flex-last' : '';

// Image
if ($item['image']) {

    $attrs_image = [];

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

} elseif ($item['icon']) {

    $attrs_icon = [];

    $options = ["icon: {$item['icon']}"];
    $options[] = $data['icon_ratio'] ? "ratio: {$data['icon_ratio']}" : '';
    $attrs_icon['uk-icon'] = implode(';', array_filter($options));

    $attrs_icon['class'][] = 'el-image';
    $attrs_icon['class'][] = $item['icon_color'] ? "uk-text-{$item['icon_color']}" : '';

    $item['image'] = "<span ". Uikit::attrs($attrs_icon) . "></span>";
}

// Content
$attrs_content['class'][] = 'el-content';

switch ($data['content_style']) {
    case '':
        break;
    case 'bold':
    case 'muted':
        $attrs_content['class'][] = "uk-text-{$data['content_style']}";
        break;
    default:
        $attrs_content['class'][] = "uk-{$data['content_style']}";
}

// Link
if ($item['link']) {

    $attrs_link['target'] = $item['link_target'] ? '_blank' : '';
    $attrs_link['uk-scroll'] = strpos($item['link'], '#') === 0;
    $attrs_link['class'][] = 'el-link';
    $attrs_link['class'][] = $data['link_style'] ? "uk-link-{$data['link_style']}" : '';

    $item['content'] = Uikit::link($item['content'], $item['link'], $attrs_link);

    if ($item['image']) {
        $item['image'] = Uikit::link($item['image'], $item['link'], ['class' => 'uk-link-reset']);
    }
}

?>

<?php if ($item['image']) : ?>
    <div<?= Uikit::attrs($attrs_grid) ?>>
        <div<?= Uikit::attrs($attrs_cell) ?>>
            <?= $item['image'] ?>
        </div>
        <div>
            <div<?= Uikit::attrs($attrs_content) ?>>
                <?= $item['content'] ?>
            </div>
        </div>
    </div>
<?php else : ?>
    <div<?= Uikit::attrs($attrs_content) ?>>
        <?= $item['content'] ?>
    </div>
<?php endif ?>
