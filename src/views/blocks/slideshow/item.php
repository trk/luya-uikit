<?php

use trk\uikit\Uikit;

/**
 * @var $this object
 * @var $data array
 * @var $item array
 */

$attrs_pull_push = [];
$attrs_pull_push_overlay = [];
$attrs_kenburns = [];
$attrs_image = [];
$attrs_video = [];
$attrs_position = [];
$attrs_overlay = [];

// Display
if (!$data['show_title']) { $item['title'] = ''; }
if (!$data['show_meta']) { $item['meta'] = ''; }
if (!$data['show_content']) { $item['content'] = ''; }
if (!$data['show_link']) { $item['link'] = ''; }
if (!$data['show_thumbnail']) { $item['thumbnail'] = ''; }

// Extra effect for pull/push
if (in_array($data['slideshow_animation'], ['push', 'pull'])) {
    $attrs_pull_push['class'][] = 'uk-position-cover';
    $attrs_pull_push_overlay['class'][] = 'uk-position-cover';
    $opacity = $item['text_color'] ? $item['text_color'] : ($data['text_color'] ? $data['text_color'] : '');
    $opacity = $opacity == 'light' ? '0.5' : '0.2';
    if ($data['slideshow_animation'] == 'push') {
        $attrs_pull_push['uk-slideshow-parallax'] = 'scale: 1.2,1.2,1';
        $attrs_pull_push_overlay['uk-slideshow-parallax'] = "opacity: 0,0,{$opacity}; backgroundColor: #000,#000";
    } else {
        $attrs_pull_push['uk-slideshow-parallax'] = 'scale: 1,1.2,1.2';
        $attrs_pull_push_overlay['uk-slideshow-parallax'] = "opacity: {$opacity},0,0; backgroundColor: #000,#000";
    }
}
// Kenburns
if ($data['slideshow_kenburns']) {
    $kenburns_alternate = [
        'center-left',
        'top-right',
        'bottom-left',
        'top-center',
        '', // center-center
        'bottom-right'
    ];
    if ($data['slideshow_kenburns'] == 'alternate') {
        $kenburns = $kenburns_alternate[$i % count($kenburns_alternate)];
    } elseif ($data['slideshow_kenburns'] == 'center-center') {
        $kenburns = '';
    } else {
        $kenburns = $data['slideshow_kenburns'];
    }
    $attrs_kenburns['class'][] = 'uk-position-cover uk-animation-kenburns uk-animation-reverse';
    $attrs_kenburns['class'][] = $kenburns ? "uk-transform-origin-{$kenburns}" : '';
    $attrs_kenburns['style'][] = $data['slideshow_kenburns_duration'] ? "-webkit-animation-duration: {$data['slideshow_kenburns_duration']}s; animation-duration: {$data['slideshow_kenburns_duration']}s;" : '';
}

$image = '';
// Image
if ($item['image']) {
    $attrs_image['class'][] = 'el-image';
    $attrs_image['alt'] = $item['image_alt'];
    $attrs_image['uk-cover'] = true;
    if (Uikit::isImage($item['image']) == 'gif') {
        $attrs_image['uk-gif'] = true;
    }
    if (Uikit::isImage($item['image']) == 'svg') {
        $image = Uikit::image($item['image'], array_merge($attrs_image, ['width' => $item['image_width'], 'height' => $item['image_height']]));
    } elseif ($item['image_width'] || $item['image_height']) {
        $image = Uikit::image([$item['image'], 'thumbnail' => [$item['image_width'], $item['image_height']], 'sizes' => '80%,200%'], $attrs_image);
    } else {
        $image = Uikit::image($item['image'], $attrs_image);
    }
}
// Video
if ($item['video'] && !$item['image']) {
    $attrs_video['class'][] = 'el-image';
    $attrs_video['uk-cover'] = true;
    if ($iframe = Uikit::iframeVideo($item['video'])) {
        $attrs_video['src'] = $iframe;
        $attrs_video['frameborder'] = '0';
        $attrs_video['allowfullscreen'] = true;
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
// Overlay
if ($item['title'] || $item['meta'] || $item['content'] || $item['link']) {
    // Position
    $attrs_position['class'][] = "uk-position-cover uk-flex";
    $attrs_position['class'][] = strpos($data['overlay_position'], 'top') !== false ? 'uk-flex-top' : '';
    $attrs_position['class'][] = strpos($data['overlay_position'], 'bottom') !== false ? 'uk-flex-bottom' : '';
    $attrs_position['class'][] = strpos($data['overlay_position'], 'left') !== false ? 'uk-flex-left' : '';
    $attrs_position['class'][] = strpos($data['overlay_position'], 'right') !== false ? 'uk-flex-right' : '';
    $attrs_position['class'][] = strpos($data['overlay_position'], '-center') !== false ? 'uk-flex-center' : '';
    $attrs_position['class'][] = strpos($data['overlay_position'], 'center-') !== false ? 'uk-flex-middle' : '';
    $attrs_position['class'][] = $data['overlay_position'] == 'center' ? 'uk-flex-center uk-flex-middle' : '';
    $attrs_overlay['class'][] = in_array($data['overlay_position'], ['top', 'bottom']) ? 'uk-flex-1' : '';
    if ($data['overlay_container']) {
        $attrs_position['class'][] = 'uk-container';
        $attrs_position['class'][] = $data['overlay_container'] != 'default' ? "uk-container-{$data['overlay_container']}" : '';
        $attrs_position['class'][] = $data['overlay_container_padding'] ? "uk-section-{$data['overlay_container_padding']}" : 'uk-section';
    } else {
        switch ($data['overlay_margin']) {
            case '':
                $attrs_position['class'][] = 'uk-padding';
                break;
            case 'none':
                break;
            default:
                $attrs_position['class'][] = "uk-padding-{$data['overlay_margin']}";
        }
    }
    // Overlay
    $attrs_overlay['class'][] = "el-overlay";
    switch ($data['overlay_style']) {
        case '':
            $attrs_overlay['class'][] = 'uk-panel';
            break;
        default:
            $attrs_overlay['class'][] = "uk-overlay uk-{$data['overlay_style']}";
    }
    $attrs_overlay['class'][] = $data['overlay_style'] && $data['overlay_padding'] ? "uk-padding-{$data['overlay_padding']}" : '';
    if (!in_array($data['overlay_position'], ['top', 'bottom'])) {
        $attrs_overlay['class'][] = $data['overlay_width'] ? "uk-width-{$data['overlay_width']}" : '';
    }
    // Animation
    if ($data['overlay_animation'] == 'parallax') {
        $options = [];
        foreach(['x', 'y', 'scale', 'rotate', 'opacity'] as $prop) {
            $start = $data["overlay_parallax_{$prop}_start"];
            $end = $data["overlay_parallax_{$prop}_end"];
            $default = in_array($prop, ['scale', 'opacity']) ? 1 : 0;
            $middle = in_array($prop, ['scale', 'opacity']) ? 1 : 0;
            if (strlen($start) || strlen($end)) {
                $options[] = "{$prop}: " . (strlen($start) ? $start : $default) . ",{$middle}," . (strlen($end) ? $end : $default);
            }
        }
        $attrs_overlay['uk-slideshow-parallax'] = implode(';', array_filter($options));
    } elseif ($data['overlay_animation']) {
        $attrs_overlay['class'][] = "uk-transition-{$data['overlay_animation']}";
    }
    // Text Color
    if (!$data['overlay_style']) {
        $attrs_overlay['class'][] = $item['text_color'] ? "uk-{$item['text_color']}" : ($data['text_color'] ? "uk-{$data['text_color']}" : '');
    }
}
?>
<?php if ($attrs_pull_push) : ?>
<div<?= Uikit::attrs($attrs_pull_push) ?>>
<?php endif ?>
    <?php if ($attrs_kenburns) : ?>
    <div<?= Uikit::attrs($attrs_kenburns) ?>>
    <?php endif ?>
        <?= $image ?>
        <?= $item['video'] ?>
    <?php if ($attrs_kenburns) : ?>
    </div>
    <?php endif ?>
<?php if ($attrs_pull_push) : ?>
</div>
<div<?= Uikit::attrs($attrs_pull_push_overlay) ?>></div>
<?php endif ?>
<?php if ($attrs_position) : ?>
    <div<?= Uikit::attrs($attrs_position) ?>>
        <div<?= Uikit::attrs($attrs_overlay) ?>>
        <?= $this->render('content', compact('item', 'data')) ?>
        </div>
    </div>
<?php endif ?>