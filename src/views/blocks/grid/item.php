<?php

use trk\uikit\Uikit;

/**
 * @var $this object
 * @var $data array
 * @var $item array
 */

$attrs_item = [];
$attrs_content = [];
$attrs_image = [];
$attrs_grid = [];
$attrs_cell_image = [];
$attrs_image_container = [];
$attrs_link = [];
$attrs_icon = [];
$lightbox_caption = '';

// Display
if (!$data['show_title']) { $item['title'] = ''; }
if (!$data['show_meta']) { $item['meta'] = ''; }
if (!$data['show_content']) { $item['content'] = ''; }
if (!$data['show_image']) { $item['image'] = ''; }
if (!$data['show_link']) { $item['link'] = ''; }

// Animation
/*
 * @TODO
 * if item_animation != none and
 * Has parent `section -> animation` value and
 * is parent type `column`
 */
/*
if ($data['item_animation'] != 'none') {
    $attrs_item['uk-scrollspy-class'] = $data['item_animation'] ? "uk-animation-{$data['item_animation']}" : true;
}
*/

// Max Width
$attrs_item['class'][] = $data['item_maxwidth'] ? "uk-width-{$data['item_maxwidth']} uk-margin-auto" : '';

// Item
$attrs_item['class'][] = 'el-item';

// If link is not set use the default image for the lightbox
if (!$item['link'] && $data['lightbox']) {
    $item['link'] = $item['image'];
}

// Image
if ($item['image']) {

    $src = $item['image'];

    $attrs_image['class'][] = 'el-image';
    $attrs_image['class'][] = $data['image_border'] ? "uk-border-{$data['image_border']}" : '';
    $attrs_image['class'][] = $data['image_box_shadow'] && !$data['panel_style'] ? "uk-box-shadow-{$data['image_box_shadow']}" : '';
    $attrs_image['class'][] = $item['link'] && $data['image_hover_box_shadow'] && !$data['panel_style'] && $data['link_style'] == 'panel' ? "uk-box-shadow-hover-{$data['image_hover_box_shadow']}" : '';
    $attrs_image['alt'] = $item['image_alt'];
    $attrs_image['uk-cover'] = ($data['panel_style'] && $data['image_card'] && in_array($data['image_align'], ['left', 'right'])) ? true : false;

    if (Uikit::isImage($item['image']) == 'gif') {
        $attrs_image['uk-gif'] = true;
    }

    if (Uikit::isImage($item['image']) == 'svg') {
        $item['image'] = Uikit::image($src, array_merge($attrs_image, ['width' => $data['image_width'], 'height' => $data['image_height']]));
    } elseif ($data['image_width'] || $data['image_height']) {
        $item['image'] = Uikit::image([$src, 'thumbnail' => [$data['image_width'], $data['image_height']], 'sizes' => '80%,200%'], $attrs_image);
    } else {
        $item['image'] = Uikit::image($src, $attrs_image);
    }

    // Placeholder image if card and layout left or right
    if ($data['panel_style'] && $data['image_card'] && in_array($data['image_align'], ['left', 'right'])) {
        $attrs_image['class'][] = 'uk-invisible';
        $attrs_image['uk-cover'] = false;
        if ($data['image_width'] || $data['image_height']) {
            $item['image'] .= Uikit::image([$src, 'thumbnail' => [$data['image_width'], $data['image_height']], 'sizes' => '80%,200%'], $attrs_image);
        } else {
            $item['image'] .= Uikit::image($src, $attrs_image);
        }
    }

} elseif ($item['icon']) {

    $options = ["icon: {$item['icon']}"];
    $options[] = $data['icon_ratio'] ? "ratio: {$data['icon_ratio']}" : '';
    $attrs_icon['uk-icon'] = implode(';', array_filter($options));

    $attrs_icon['class'][] = 'el-image';
    $attrs_icon['class'][] = $data['icon_color'] ? "uk-text-{$data['icon_color']}" : '';

    $item['image'] = "<span " . Uikit::attrs($attrs_icon) . "></span>";
    $data['image_card'] = false;

}

// Card
if ($data['panel_style']) {

    $attrs_item['class'][] = "uk-card uk-{$data['panel_style']}";
    $attrs_item['class'][] = $data['panel_size'] ? "uk-card-{$data['panel_size']}" : '';
    $attrs_item['class'][] = $item['link'] && $data['link_style'] == 'panel' && $data['panel_style'] != 'card-hover' ? 'uk-card-hover' : '';

    // Card media
    if ($item['image'] && $data['image_card'] && $data['image_align'] != 'between') {
        $attrs_content['class'][] = 'uk-card-body';
    } else {
        $attrs_item['class'][] = 'uk-card-body';
    }

} else {
    $attrs_item['class'][] = 'uk-panel';
}

// Image Align
$attrs_grid['class'][] = 'uk-child-width-expand';

if ($data['panel_style'] && $data['image_card']) {
    $attrs_grid['class'][] = 'uk-grid-collapse uk-grid-match';
} else {
    $attrs_grid['class'][] = $data['image_gutter'] ? "uk-grid-{$data['image_gutter']}" : '';
}

$attrs_grid['class'][] = $data['image_vertical_align'] ? 'uk-flex-middle' : '';
$attrs_grid['uk-grid'] = true;

if ($data['image_breakpoint']) {
    $attrs_cell_image['class'][] = "uk-width-{$data['image_grid_width']}@{$data['image_breakpoint']}";
    $attrs_cell_image['class'][] = $data['image_align'] == 'right' ? "uk-flex-last@{$data['image_breakpoint']}" : '';
} else {
    $attrs_cell_image['class'][] = "uk-width-{$data['image_grid_width']}";
    $attrs_cell_image['class'][] = $data['image_align'] == 'right' ? 'uk-flex-last' : '';
}

if ($data['panel_style'] && $data['image_card'] && in_array($data['image_align'], ['left', 'right'])) {
    $attrs_image_container['class'][] = 'uk-cover-container';
}

// Card media
if ($data['panel_style'] && $item['image'] && $data['image_card'] && $data['image_align'] != 'between' ) {
    $attrs_image_container['class'][] = "uk-card-media-{$data['image_align']}";
    $item['image'] = "<div" . Uikit::attrs($attrs_image_container) . ">{$item['image']}</div>";
}

// Link and Lightbox
if ($data['lightbox']) {

    if (Uikit::isImage($item['link'])) {

        if (($data['lightbox_image_width'] || $data['lightbox_image_height']) && Uikit::isImage($item['link']) != 'svg') {
            $item['link'] = "{$item['link']}#thumbnail={$data['lightbox_image_width']},{$data['lightbox_image_height']},{$data['lightbox_image_orientation']}";
        }

        // $item['link'] = $item['link'];
        $attrs_link['data-type'] = 'image';

    } elseif (Uikit::isVideo($item['link'])) {

        $attrs_link['data-type'] = 'video';

    } elseif (!Uikit::iframeVideo($item['link'])) {

        $attrs_link['data-type'] = 'iframe';

    } else {

        $attrs_link['data-type'] = true;

    }

    if ($item['title'] && $data['title_display'] != 'item') {
        $lightbox_caption .= "<h4 class='uk-margin-remove'>{$item['title']}</h4>";
        if ($data['title_display'] == 'lightbox') {
            $item['title'] = '';
        }
    }

    if ($item['content'] && $data['content_display'] != 'item') {
        $lightbox_caption .= $item['content'];
        if ($data['content_display'] == 'lightbox') {
            $item['content'] = '';
        }
    }

    $lightbox_caption = $lightbox_caption ? ' data-caption="'.str_replace('"', '&quot;', $lightbox_caption).'"' : '';

} else {
    $attrs_link['target'] = $data['link_target'] ? '_blank' : '';
    $attrs_link['uk-scroll'] = strpos($item['link'], '#') === 0;
}

// Link
if ($item['link']) {

    $attrs_link['href'] = $item['link'];
    $attrs_link['class'][] = 'el-link';

    if ($data['link_style'] == 'panel') {

        if ($data['panel_style']) {
            $attrs_link['class'][] = 'uk-position-cover uk-position-z-index uk-margin-remove-adjacent';
        }

        if (!$data['panel_style'] && $item['image']) {
            $attrs_link['class'][] = $data['image_box_shadow_bottom'] ? 'uk-box-shadow-bottom' : '';
            $item['image'] = "<a" . Uikit::attrs($attrs_link) . ">{$item['image']}</a>";
        }

    } else {

        switch ($data['link_style']) {
            case '':
                break;
            case 'link-muted':
            case 'link-text':
                $attrs_link['class'][] = "uk-{$data['link_style']}";
                break;
            default:
                $attrs_link['class'][] = "uk-button uk-button-{$data['link_style']}";
                $attrs_link['class'][] = $data['link_size'] ? "uk-button-{$data['link_size']}" : '';
        }

    }

}
// Box-shadow bottom
if ((!$item['link'] || ($item['link'] && $data['link_style'] != 'panel')) && !$data['panel_style'] && $data['image_box_shadow_bottom']) {
    $item['image'] = "<div class=\"uk-box-shadow-bottom\">{$item['image']}</div>";
}
?>
<div<?= Uikit::attrs($attrs_item) ?>>
    <?php if ($item['link'] && $data['link_style'] == 'panel' && $data['panel_style']) : ?>
    <a<?= Uikit::attrs($attrs_link) ?><?= $lightbox_caption ?>></a>
    <?php endif ?>
    <?php if ($item['image'] && in_array($data['image_align'], ['left', 'right'])) : ?>
        <div<?= Uikit::attrs($attrs_grid) ?>>
            <div<?= Uikit::attrs($attrs_cell_image) ?>>
                <?= $item['image'] ?>
            </div>
            <div>
                <?php if ($data['panel_style'] && $item['image']) : ?>
                    <div<?= Uikit::attrs($attrs_content) ?>>
                        <?= $this->render('content', compact('item', 'attrs_link', 'lightbox_caption', 'data')) ?>
                    </div>
                <?php else : ?>
                    <?= $this->render('content', compact('item', 'attrs_link', 'lightbox_caption', 'data')) ?>
                <?php endif ?>
            </div>
        </div>
    <?php else : ?>
        <?php if ($data['image_align'] == 'top') : ?>
        <?= $item['image'] ?>
        <?php endif ?>
        <?php if ($data['panel_style'] && $item['image'] && $data['image_card'] && in_array($data['image_align'], ['top', 'bottom'])) : ?>
            <div<?= Uikit::attrs($attrs_content) ?>>
                <?= $this->render('content', compact('item', 'attrs_link', 'lightbox_caption', 'data')) ?>
            </div>
        <?php else : ?>
            <?= $this->render('content', compact('item', 'attrs_link', 'lightbox_caption', 'data')) ?>
        <?php endif ?>
        <?php if ($data['image_align'] == 'bottom') : ?>
        <?= $item['image'] ?>
        <?php endif ?>
    <?php endif ?>
</div>
