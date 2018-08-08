<?php

use trk\uikit\Uikit;

/**
 * @var $this object
 * @var $data array
 * @var $item array
 */

$attrs_nav = [];
$attrs_nav_container = [];
$attrs_nav['class'][] = 'el-nav';
// Style
$attrs_nav['class'][] = $data['nav'] ? "uk-{$data['nav']}" : '';
if ($data['nav_below']) {
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
    // Color
    $attrs_nav_container['class'][] = $data['nav_color'] ? "uk-{$data['nav_color']}" : '';
} else {
    // Position
    $attrs_nav_container['class'][] = "uk-position-{$data['nav_position']}";
    // Margin
    $attrs_nav_container['class'][] = $data['nav_position_margin'] ? "uk-position-{$data['nav_position_margin']}" : '';
    // Text Color
    $attrs_nav_container['class'][] = $data['text_color'] ? "uk-{$data['text_color']}" : '';
    // Vertical
    $attrs_nav['class'][] = $data['nav_vertical'] ? "uk-{$data['nav']}-vertical" : '';
}
// Wrapping
if (!$data['nav_vertical']) {
    $attrs_nav['uk-margin'] = true;
    if (!$data['nav_below']) {
        switch ($data['nav_position']) {
            case 'top-right':
            case 'center-right':
            case 'bottom-right':
                $attrs_nav['class'][] = 'uk-flex-right';
                break;
            case 'bottom-center':
                $attrs_nav['class'][] = 'uk-flex-center';
                break;
        }
    }
}
// Breakpoint
$attrs_nav_container['class'][] = $data['nav_breakpoint'] ? "uk-visible@{$data['nav_breakpoint']}" : '';
?>
<?php if (!$data['nav_below'] || ($data['nav_below'] && $data['nav_color'])) : ?>
<div<?= Uikit::attrs($attrs_nav_container) ?>>
<?php endif ?>
<ul<?= Uikit::attrs($attrs_nav, $data['nav_below'] && !$data['nav_color'] ? $attrs_nav_container : []) ?>>
    <?php foreach ($data['items'] as $i => $item) :
    // Display
    if (!$data['show_title']) { $item['title'] = ''; }
    if (!$data['show_thumbnail']) { $item['thumbnail'] = ''; }
    // Image
    $thumbnail = '';
    if($data['show_thumbnail']) {
        $src = $item['thumbnail'] ?: $item['image'];
        if ($data['nav'] == 'thumbnav' && $src) {
            $attrs_thumbnail['alt'] = $item['image_alt'];
            if (Uikit::isImage($src) == 'svg') {
                $thumbnail = Uikit::image($src, array_merge($attrs_thumbnail, ['width' => $item['thumbnail_width'], 'height' => $item['thumbnail_height']]));
            } elseif ($item['thumbnail_width'] || $item['thumbnail_height']) {
                $thumbnail = Uikit::image([$src, 'thumbnail' => [$item['thumbnail_width'], $item['thumbnail_height']], 'sizes' => '80%,200%'], $attrs_thumbnail);
            } else {
                $thumbnail = Uikit::image($src, $attrs_thumbnail);
            }
        }
    }
    ?>
    <li data-uk-slideshow-item="<?= $i ?>">
        <a href="#"><?= $thumbnail ?: $item['title'] ?></a>
    </li>
    <?php endforeach ?>
</ul>
<?php if (!$data['nav_below'] || ($data['nav_below'] && $data['nav_color'])) : ?>
</div>
<?php endif ?>