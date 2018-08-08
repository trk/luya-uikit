<?php

use trk\uikit\Uikit;

/**
 * @var $this object
 * @var $data array
 * @var $parent array
 */

$id = $data['id'];
$class = [];
$attrs_tile = [];
$attrs_tile_container = [];
$attrs_image = [];
$attrs_overlay = [];
$attrs_container = [];

$image = $this->extraValue($data['name'] . 'image');
$data['image'] = isset($image->source) ? $image->source : '';

// Width
$index = $data['index'];
$widths = $data['widths'];
$breakpoints = ['s', 'm', 'l', 'xl'];
$breakpoint = $parent['breakpoint'];

// Above Breakpoint
$width = $widths[0] ?: 'expand';
$width = $width === 'fixed' ? $parent['fixed_width'] : $width;
$class[] = "uk-width-{$width}".($breakpoint ? "@{$breakpoint}" : '');
// Intermediate Breakpoint
if (isset($widths[1]) && $pos = array_search($breakpoint, $breakpoints)) {
    $breakpoint = $breakpoints[$pos-1];
    $width = $widths[1] ?: 'expand';
    $class[] = "uk-width-{$width}".($breakpoint ? "@{$breakpoint}" : '');
}
// Order
if (!$data['hasNext'] && $data['order_last']) {
    $class[] = "uk-flex-first@{$breakpoint}";
}
// Visibility
$visibilities = ['xs', 's', 'm', 'l', 'xl'];
$visible = $parent['columns'] ? 4 : false;
/*
if ($visible) {
    $data['visibility'] = $visibilities[$visible];
    $class[] = "uk-visible@{$visibilities[$visible]}";
}
*/
/*
 * Column options
 */
// Tile
if ($data['style'] || $data['image']) {
    $class[] = 'uk-grid-item-match';
    $attrs_tile_container['class'][] = $data['style'] ? "uk-tile-{$data['style']}" : '';
    $attrs_tile['class'][] = 'uk-tile';
    // Padding
    switch ($data['padding']) {
        case '':
            break;
        case 'none':
            $attrs_tile['class'][] = 'uk-padding-remove';
            break;
        default:
            $attrs_tile['class'][] = "uk-tile-{$data['padding']}";
    }
    // Image
    if ($data['image']) {
        if ($data['image_width'] || $data['image_height']) {
            if (Uikit::isImage($data['image']) == 'svg' && !$data['image_size']) {
                $data['image_width'] = $data['image_width'] ? "{$data['image_width']}px" : 'auto';
                $data['image_height'] = $data['image_height'] ? "{$data['image_height']}px" : 'auto';
                $attrs_image['style'][] = "background-size: {$data['image_width']} {$data['image_height']};";
            } else {
                $data['image'] = "{$data['image']}#thumbnail={$data['image_width']},{$data['image_height']}";
            }
        }
        $attrs_image['style'][] = "background-image: url('{$data['image']}');";
        // Settings
        $attrs_image['class'][] = 'uk-background-norepeat';
        $attrs_image['class'][] = $data['image_size'] ? "uk-background-{$data['image_size']}" : '';
        $attrs_image['class'][] = $data['image_position'] ? "uk-background-{$data['image_position']}" : '';
        $attrs_image['class'][] = $data['image_visibility'] ? "uk-background-image@{$data['image_visibility']}" : '';
        $attrs_image['class'][] = $data['media_blend_mode'] ? "uk-background-blend-{$data['media_blend_mode']}" : '';
        $attrs_image['style'][] = $data['media_background'] ? "background-color: {$data['media_background']};" : '';
        $attrs_tile_container['class'][] = 'uk-grid-item-match';
        switch ($data['image_effect']) {
            case '':
                break;
            case 'fixed':
                $attrs_image['class'][] = 'uk-background-fixed';
                break;
            case 'parallax':
                $options = [];
                foreach(['bgx', 'bgy'] as $prop) {
                    $start = $data["image_parallax_{$prop}_start"];
                    $end = $data["image_parallax_{$prop}_end"];
                    if (strlen($start) || strlen($end)) {
                        $options[] = "{$prop}: " . (strlen($start) ? $start : 0) . "," . (strlen($end) ? $end : 0);
                    }
                }
                $options[] = $data['image_parallax_breakpoint'] ? "media: @{$data['image_parallax_breakpoint']}" : '';
                $attrs_image['uk-parallax'] = implode(';', array_filter($options));
                break;
        }
        // Overlay
        if ($data['media_overlay']) {
            $attrs_tile_container['class'][] = 'uk-position-relative';
            $attrs_overlay['style'] = "background-color: {$data['media_overlay']};";
        }
    }
}
// Make sure overlay is always below content
if ($attrs_overlay) {
    $attrs_container['class'][] = 'uk-position-relative uk-panel';
}
// Text color
if ($data['style'] == 'primary' || $data['style'] == 'secondary') {
    $attrs_tile_container['class'][] = $data['preserve_color'] ? 'uk-preserve-color' : '';
} elseif (!$data['style'] || $data['image']) {
    $class[] = $data['text_color'] ? "uk-{$data['text_color']}" : '';
}
/**
 * Match height if single panel element inside cell
 *
 * @TODO add on if statement, if first child block is panel.
 */
if ($parent['match'] && !$parent['vertical_align'] && $parent['columns'] == 1) {
    if ($data['style'] || $data['image']) {
        $attrs_tile['class'][] = 'uk-grid-item-match';
    } else {
        $class[] = 'uk-grid-item-match';
    }
}
?>
<div<?= Uikit::attrs(compact('id', 'class')) ?>>
    <?php if ($attrs_tile) : ?><div<?= Uikit::attrs($attrs_tile_container, !$attrs_image ? $attrs_tile : []) ?>><?php endif ?>
        <?php if ($attrs_image) : ?><div<?= Uikit::attrs($attrs_image, $attrs_tile) ?>><?php endif ?>
            <?php if ($attrs_overlay) : ?><div class="uk-position-cover"<?= Uikit::attrs($attrs_overlay) ?>></div><?php endif ?>
            <?php if ($attrs_container) : ?><div<?= Uikit::attrs($attrs_container) ?>><?php endif ?>
                <?= $data['content'] ?>
            <?php if ($attrs_container) : ?></div><?php endif ?>
        <?php if ($attrs_image) : ?></div><?php endif ?>
    <?php if ($attrs_tile) : ?></div><?php endif ?>
</div>
