<?php

use trk\uikit\Uikit;

/**
 * @var $this object
 * @var $data array
 */

$id = $data['id'];
$class = $data['class'];
$style = [];
$attrs = [
    'uk-scrollspy' => $data['animation'] ? json_encode([
        'target' => '[uk-scrollspy-class]',
        'cls' => "uk-animation-{$data['animation']}",
        'delay' => $data['animation_delay'] ? 300 : false,
    ]) : false,
    'avb-header-transparent' => $data['header_transparent'] ? $data['header_transparent'] : false,
    'avb-header-transparent-placeholder' => $data['header_transparent'] && !$data['header_transparent_noplaceholder']
];
$attrs_overlay = [];
$attrs_container = [];
$attrs_viewport_height = [];
$attrs_image = [];
$attrs_video = [];
$attrs_section = [];
$attrs_section_title = [];
$attrs_section_title_container = [];

// Section
$class[] = "uk-section-{$data['style']}";
$class[] = $data['overlap'] ? 'uk-section-overlap' : '';
$attrs_section['class'][] = 'uk-section';
// Section Title
if ($data['title']) {
    $attrs_section_title_container['class'][] = 'uk-position-relative';
    $attrs_section_title_container['class'][] = $data['height'] ? 'uk-height-1-1' : '';
    $attrs_section_title['class'][] = 'avb-section-title';
    $attrs_section_title['class'][] = "uk-position-{$data['title_position']} uk-position-medium";
    $attrs_section_title['class'][] = !in_array($data['title_position'], ['center-left', 'center-right']) ? 'uk-margin-remove-vertical' : 'uk-text-nowrap';
    $attrs_section_title['class'][] = $data['title_breakpoint'] ? "uk-visible@{$data['title_breakpoint']}" : '';
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
}
// Video
if ($data['video'] && !$data['image']) {
    // Cover
    $class[] = 'uk-cover-container';
    $attrs_video['uk-cover'] = true;
    // Video
    $attrs_video['width'] = $data['video_width'];
    $attrs_video['height'] = $data['video_height'];
    if ($iframe = Uikit::iframeVideo($data['video'])) {
        $attrs_video['src'] = $iframe;
        $attrs_video['frameborder'] = '0';
        $attrs_video['allowfullscreen'] = true;
        $data['video'] = "<iframe" . Uikit::attrs($attrs_video) . "></iframe>";
    } else if ($data['video']) {
        $attrs_video['src'] = $data['video'];
        $attrs_video['controls'] = false;
        $attrs_video['loop'] = true;
        $attrs_video['autoplay'] = true;
        $attrs_video['muted'] = true;
        $attrs_video['playsinline'] = true;
        $data['video'] = "<video" . Uikit::attrs($attrs_video) . "></video>";
    }
} else {
    $data['video'] = '';
}
// Text color
if ($data['style'] == 'primary' || $data['style'] == 'secondary') {
    $class[] = $data['preserve_color'] ? 'uk-preserve-color' : '';
} elseif ($data['image'] || $data['video']) {
    $class[] = $data['text_color'] ? "uk-{$data['text_color']}" : '';
}
// Padding
switch ($data['padding']) {
    case '':
        break;
    case 'none':
        $attrs_section['class'][] = 'uk-padding-remove-vertical';
        break;
    default:
        $attrs_section['class'][] = "uk-section-{$data['padding']}";
}

if ($data['padding'] != 'none') {
    if ($data['padding_remove_top']) {
        $attrs_section['class'][] = 'uk-padding-remove-top';
    }
    if ($data['padding_remove_bottom']) {
        $attrs_section['class'][] = 'uk-padding-remove-bottom';
    }
}

// Height Viewport
if ($data['height']) {
    if ($data['height'] == 'expand') {
        $attrs_section['uk-height-viewport'] = 'expand: true';
    } else {
        // Vertical alignment
        if ($data['vertical_align']) {
            if ($data['title']) {
                $attrs_section_title_container['class'][] = "uk-flex uk-flex-{$data['vertical_align']}";
            } else {
                $attrs_section['class'][] = "uk-flex uk-flex-{$data['vertical_align']}";
            }
            $attrs_viewport_height['class'][] = 'uk-width-1-1';
        }
        $options = ['offset-top: true'];
        switch ($data['height']) {
            case 'percent':
                $options[] = 'offset-bottom: 20';
                break;
            case 'section':
                $options[] = $data['image'] ? 'offset-bottom: ! +' : 'offset-bottom: true';
                break;
        }
        $attrs_section['uk-height-viewport'] = implode(';', array_filter($options));
    }
}
// Container and width
switch ($data['width']) {
    case 'default':
        $attrs_container['class'][] = 'uk-container';
        break;
    case 'small':
    case 'large':
    case 'expand':
        $attrs_container['class'][] = "uk-container uk-container-{$data['width']}";
        break;
}
// Make sure overlay and video is always below content
if ($attrs_overlay || $data['video']) {
    $attrs_container['class'][] = $data['width'] ? 'uk-position-relative' : 'uk-position-relative uk-panel';
}
// Visibility
$visible = 4;
$visibilities = ['xs', 's', 'm', 'l', 'xl'];
/*
if ($visible) {
    $data['visibility'] = $visibilities[$visible];
    $class[] = "uk-visible@{$visibilities[$visible]}";
}
*/
?>
<div<?= Uikit::attrs(compact('id', 'class', 'style'), $attrs, !$attrs_image ? $attrs_section : []) ?>>
    <?php if ($attrs_image) : ?>
    <div<?= Uikit::attrs($attrs_image, $attrs_section) ?>>
        <?php endif ?>

        <?= $data['video'] ?>

        <?php if ($attrs_overlay) : ?>
            <div class="uk-position-cover"<?= Uikit::attrs($attrs_overlay) ?>></div>
        <?php endif ?>

        <?php if ($data['title']) : ?>
        <div<?= Uikit::attrs($attrs_section_title_container) ?>>
            <?php endif ?>

            <?php if ($attrs_viewport_height) : ?>
            <div<?= Uikit::attrs($attrs_viewport_height) ?>>
                <?php endif ?>

                <?php if ($attrs_container) : ?>
                <div<?= Uikit::attrs($attrs_container) ?>>
                    <?php endif ?>
                    <?= $data['content'] ?>
                    <?php if ($attrs_container) : ?>
                </div>
            <?php endif ?>

                <?php if ($attrs_viewport_height) : ?>
            </div>
        <?php endif ?>

            <?php if ($data['title']) : ?>
            <div<?= Uikit::attrs($attrs_section_title) ?>>
                <div class="<?= $data['title_rotation'] == 'left' ? 'avb-rotate-180' : '' ?>"><?= $data['title'] ?></div>
            </div>
        </div>
    <?php endif ?>

        <?php if ($attrs_image) : ?>
    </div>
<?php endif ?>
</div>