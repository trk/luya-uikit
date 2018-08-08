<?php

use trk\uikit\Uikit;

/**
 * @var $this object
 * @var $data array
 * @var $item array
 */

$attrs_item = [];
$attrs_overlay = [];
$attrs_center = [];
$attrs_content = [];
$attrs_image = [];
$attrs_hover_image = [];
$attrs_link = [];
$placeholder = '';
$attrs_placeholder = [];
$lightbox_caption = '';

// Display
if (!$data['show_title']) { $item['title'] = ''; }
if (!$data['show_meta']) { $item['meta'] = ''; }
if (!$data['show_content']) { $item['content'] = ''; }
if (!$data['show_link']) { $item['link'] = ''; }
if (!$data['show_hover_image']) { $item['hover_image'] = ''; }

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

// Container
$attrs_item['class'][] = 'el-item';

if ($data['image_box_shadow_bottom']) {
    $attrs_item['class'][] = 'uk-box-shadow-bottom';
} else {
    $attrs_item['class'][] = 'uk-inline-clip';
}

// Mode
if ($data['overlay_mode'] == 'cover' && $data['overlay_style']) {
    $attrs_overlay['class'][] = "uk-position-cover";
    $attrs_overlay['class'][] = $data['overlay_margin'] ? "uk-position-{$data['overlay_margin']}" : '';
}

// Style
switch ($data['overlay_style']) {
    case '':
        $attrs_content['class'][] = 'uk-panel';
        break;
    default:
        $attrs_overlay['class'][] = "uk-{$data['overlay_style']}";
        $attrs_content['class'][] = 'uk-overlay';
}

// Padding
switch ($data['overlay_padding']) {
    case '':
        $attrs_content['class'][] = !$data['overlay_style'] ? 'uk-padding' : '';
        break;
    case 'none':
        $attrs_content['class'][] = $data['overlay_style'] ? 'uk-padding-remove' : '';
        break;
    default:
        $attrs_content['class'][] = "uk-padding-{$data['overlay_padding']}";
}

// Position
if (in_array($data['overlay_position'], ['center', 'top-center', 'bottom-center', 'center-left', 'center-right'])) {
    $attrs_center['class'][] = "uk-position-{$data['overlay_position']}";
    $attrs_center['class'][] = $data['overlay_margin'] && $data['overlay_style'] ? "uk-position-{$data['overlay_margin']}" : '';
} else {
    $attrs_content['class'][] = "uk-position-{$data['overlay_position']}";
    $attrs_content['class'][] = $data['overlay_margin'] && $data['overlay_style'] ? "uk-position-{$data['overlay_margin']}" : '';
}

// Width
if (!in_array($data['overlay_position'], ['top', 'bottom'])) {
    $attrs_content['class'][] = $data['overlay_maxwidth'] ? "uk-width-{$data['overlay_maxwidth']}" : '';
}

// Transition
if ($data['overlay_hover'] || $data['image_transition'] || $item['hover_image']) {
    $attrs_item['class'][] = 'uk-transition-toggle';
    $attrs_item['tabindex'] = 0;
}

if ($data['overlay_hover']) {

    if ($data['overlay_transition_background'] && ($data['overlay_mode'] == 'cover' && $data['overlay_style'])) {
        $attrs_overlay['class'][] = "uk-transition-{$data['overlay_transition']}";
    } else {
        $attrs_overlay['class'][] = "uk-transition-{$data['overlay_transition']}";
        $attrs_content['class'][] = "uk-transition-{$data['overlay_transition']}";
    }

}

// Text color
if (!$data['overlay_style'] || ($data['overlay_mode'] == 'cover' && $data['overlay_style'])) {
    $attrs_item['class'][] = $item['text_color'] ? "uk-{$item['text_color']}" : ($data['text_color'] ? "uk-{$data['text_color']}" : '');
}

// Inverse text color on hover
if ((!$data['overlay_style'] && $item['hover_image']) || ($data['overlay_mode'] == 'cover' && $data['overlay_style'] && $data['overlay_transition_background'])) {
    $attrs_item['uk-toggle'] = $item['text_color_hover'] || $data['text_color_hover'] ? "cls: uk-light uk-dark; mode: hover" : false;
}

// If link is not set use the default image for the lightbox
if (!$item['link'] && $data['lightbox']) {
    $item['link'] = $item['image'];
}

// Image
if ($item['image'] || $item['hover_image']) {

    // Transition
    if ($item['hover_image'] && !$item['image']) {
        $item['image'] = $item['hover_image'];
        $item['hover_image'] = '';
        $attrs_image['class'][] = $data['image_transition'] ? "uk-transition-{$data['image_transition']}" : 'uk-transition-fade';
    } elseif ($item['hover_image'])
        $attrs_hover_image['class'][] = $data['image_transition'] ? "uk-transition-{$data['image_transition']}" : 'uk-transition-fade';
    else {
        $attrs_image['class'][] = $data['image_transition'] ? "uk-transition-{$data['image_transition']} uk-transition-opaque" : '';
    }

    $attrs_placeholder['alt'] = $item['image_alt'];
    $attrs_placeholder['class'][] = 'uk-invisible';

    // Image Placeholder
    if (Uikit::isImage($item['image']) == 'svg') {
        $placeholder = Uikit::image($item['image'], array_merge($attrs_placeholder, ['width' => $data['image_width'], 'height' => $data['image_height']]));
    } elseif ($data['image_width'] || $data['image_height']) {
        $placeholder = Uikit::image([$item['image'], 'thumbnail' => [$data['image_width'], $data['image_height'], $data['image_orientation']]], $attrs_placeholder);
    } else {
        $placeholder = Uikit::image($item['image'], $attrs_placeholder);
    }

    // Image
    $attrs_image['class'][] = 'el-image uk-inline uk-background-norepeat uk-background-cover';
    $attrs_image['style'][] = $data['image_min_height'] ? "min-height: {$data['image_min_height']}px;" : '';

    if ($data['image_width'] || $data['image_height']) {
        $item['image'] = "{$item['image']}#thumbnail={$data['image_width']},{$data['image_height']},{$data['image_orientation']}";
    }

    $attrs_image['style'][] = "background-image: url('{$item['image']}');";
    $item['image'] = "<div" . Uikit::attrs($attrs_image) . ">{$placeholder}</div>";

    // Hover Image
    if ($item['hover_image']) {

        $attrs_hover_image['class'][] = 'el-hover-image uk-position-cover uk-background-norepeat uk-background-cover';

        if ($data['image_width'] || $data['image_height']) {
            $item['hover_image'] = "{$item['hover_image']}#thumbnail={$data['image_width']},{$data['image_height']},{$data['image_orientation']}";
        }

        $attrs_hover_image['style'][] = "background-image: url('{$item['hover_image']}');";
        $item['image'] .= "<div" . Uikit::attrs($attrs_hover_image) . "></div>";

    }

    // Box Shadow
    $attrs_item['class'][] = $data['image_box_shadow'] ? "uk-box-shadow-{$data['image_box_shadow']}" : '';
    $attrs_item['class'][] = $data['image_hover_box_shadow'] ? "uk-box-shadow-hover-{$data['image_hover_box_shadow']}" : '';

}

// Link and Lightbox
if ($data['lightbox']) {

    if (Uikit::isImage($item['link'])) {

        if (($data['lightbox_image_width'] || $data['lightbox_image_height']) && Uikit::isImage($item['link']) != 'svg') {
            $item['link'] = "{$item['link']}#thumbnail={$data['lightbox_image_width']},{$data['lightbox_image_height']},{$data['lightbox_image_orientation']}";
        }

        // $item['link'] = $app['image']->getUrl($item['link']);
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

$attrs_link['href'] = $item['link'];
$attrs_link['class'][] = 'uk-position-cover';

?>
<div<?= Uikit::attrs($attrs_item) ?>>
    <?php if ($data['image_box_shadow_bottom']) : ?><div class="uk-inline-clip"><?php endif ?>
        <?= $item['image'] ?>
        <?php if ($data['overlay_mode'] == 'cover' && $data['overlay_style']) : ?>
            <div<?= Uikit::attrs($attrs_overlay) ?>></div>
        <?php endif ?>
        <?php if ($item['title'] || $item['meta'] || $item['content']) : ?>
            <?php if ($attrs_center) : ?>
                <div<?= Uikit::attrs($attrs_center) ?>>
            <?php endif ?>
            <div<?= Uikit::attrs($attrs_content, !($data['overlay_mode'] == 'cover' && $data['overlay_style']) ? $attrs_overlay : []) ?>>
                <?= $this->render('content', compact('item', 'data')) ?>
            </div>
            <?php if ($attrs_center) : ?>
                </div>
            <?php endif ?>
        <?php endif ?>
        <?php if ($item['link']) : ?>
            <a<?= Uikit::attrs($attrs_link) ?><?= $lightbox_caption ?>></a>
        <?php endif ?>
    <?php if ($data['image_box_shadow_bottom']) : ?></div><?php endif ?>
</div>
