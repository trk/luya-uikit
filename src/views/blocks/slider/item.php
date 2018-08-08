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
$attrs_video = [];
$attrs_link = [];

// Display
if (!$data['show_title']) { $item['title'] = ''; }
if (!$data['show_meta']) { $item['meta'] = ''; }
if (!$data['show_content']) { $item['content'] = ''; }
if (!$data['show_link']) { $item['link'] = ''; }

// Needed for height viewport and overlay
$attrs_item['class'][] = 'uk-cover-container';

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
if ($data['overlay_hover'] || $data['image_transition']) {
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
if ($data['overlay_mode'] == 'cover' && $data['overlay_style'] && $data['overlay_transition_background']) {
    $attrs_item['uk-toggle'] = $item['text_color_hover'] || $data['text_color_hover'] ? "cls: uk-light uk-dark; mode: hover" : false;
}

// Background Color
$attrs_item['style'][] = $item['media_background'] ? "background-color: {$item['media_background']};" : '';

// Blend mode
if ($item['media_blend_mode']) {
    if ($item['image']) {
        $attrs_image['class'][] = "uk-blend-{$item['media_blend_mode']}";
    } elseif ($item['video']) {
        $attrs_video['class'][] = "uk-blend-{$item['media_blend_mode']}";
    }
}

$image = '';

// Image
if ($item['image']) {

    $attrs_image['class'][] = 'el-image';
    $attrs_image['alt'] = $item['image_alt'];
    $attrs_image['uk-cover'] = $data['slider_width'] && $data['slider_height'] ? true : false;

    if ($data['slider_width'] && $data['slider_height']) {
        $attrs_image['uk-cover'] = true;
    } else {
        $attrs_image['class'][] = $data['image_transition'] ? "uk-transition-{$data['image_transition']} uk-transition-opaque" : '';
    }

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

// Video
if ($item['video'] && !$item['image']) {

    $attrs_video['class'][] = 'el-image';
    $attrs_video['width'] = $data['image_width'];
    $attrs_video['height'] = $data['image_height'];
    $attrs_video['uk-cover'] = $data['slider_width'] && $data['slider_height'] ? true : false;

    if ($data['slider_width'] && $data['slider_height']) {
        $attrs_video['uk-cover'] = true;
    } else {
        $attrs_video['uk-video'] = 'automute: true';
        $attrs_video['class'][] = $data['image_transition'] ? "uk-transition-{$data['image_transition']} uk-transition-opaque" : '';
    }

    if ($iframe = Uikit::iframeVideo($item['video'])) {

        $attrs_video['src'] = $iframe;
        $attrs_video['frameborder'] = '0';
        $attrs_video['allowfullscreen'] = true;
        $attrs_video['class'][] = 'uk-disabled';
        $attrs_video['uk-responsive'] = !$data['slider_width'] || ($data['slider_width'] && !$data['slider_height']) ? true : false;

        $item['video'] = "<iframe" . Uikit::attrs($attrs_video) . "></iframe>";

    } else if ($item['video']) {

        $attrs_video['src'] = $item['video'];
        $attrs_video['controls'] = false;
        $attrs_video['loop'] = true;
        $attrs_video['autoplay'] = true;
        $attrs_video['muted'] = true;
        $attrs_video['playsinline'] = true;

        $item['video'] = "<video" . Uikit::attrs($attrs_video) . "></video>";
    }

} else {
    $item['video'] = '';
}

// Link
$attrs_link['target'] = $item['link_target'] ? '_blank' : '';
$attrs_link['uk-scroll'] = strpos($item['link'], '#') === 0;
$attrs_link['href'] = $item['link'];
$attrs_link['class'][] = 'uk-position-cover';

?>

<div<?= Uikit::attrs($attrs_item) ?>>

    <?php if ($data['slider_width'] && $data['slider_height'] && $data['image_transition']) : ?>
    <div class="uk-position-cover <?= $data['image_transition'] ? "uk-transition-{$data['image_transition']} uk-transition-opaque" : '' ?>">
    <?php endif ?>

        <?= $image ?>
        <?= $item['video'] ?>

    <?php if ($data['slider_width'] && $data['slider_height'] && $data['image_transition']) : ?>
    </div>
    <?php endif ?>

    <?php if ($item['media_overlay']) : ?>
    <div class="uk-position-cover" style="background-color:<?= $item['media_overlay'] ?>""></div>
    <?php endif ?>

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
    <a<?= Uikit::attrs($attrs_link) ?>></a>
    <?php endif ?>

</div>
