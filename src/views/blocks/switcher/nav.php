<?php

use trk\uikit\Uikit;

/**
 * @var $this object
 * @var $data array
 * @var $item array
 */

$attrs_nav = [];

// Switcher
$options = ["connect: #{$connect_id}"];
$options[] = $data['switcher_animation'] ? "animation: uk-animation-{$data['switcher_animation']}" : '';
if ($data['switcher_breakpoint'] && in_array($data['switcher_position'], ['left', 'right'])) {

    if ($data['switcher_style'] == 'tab') {
        $options[] = "media: @{$data['switcher_breakpoint']}";
    }

}
if ($data['switcher_style'] == "tab") {
    $attrs_nav['uk-tab'] = implode(';', array_filter($options));
} else {
    $attrs_nav['uk-switcher'] = implode(';', array_filter($options));
}
// Margin
if (in_array($data['switcher_position'], ['top', 'bottom'])) {
    switch ($data['switcher_margin']) {
        case '':
            $attrs_nav['class'][] = 'uk-margin';
            break;
        default:
            $attrs_nav['class'][] = "uk-margin-{$data['switcher_margin']}";
    }
}
// Style Horizontal
switch ($data['switcher_style']) {
    case 'subnav':
        $nav_horizontal = "uk-{$data['switcher_style']}";
        break;
    case 'subnav-pill':
    case 'subnav-divider':
        $nav_horizontal = "uk-subnav uk-{$data['switcher_style']}";
        break;
    case 'tab':
        $nav_horizontal = $data['switcher_position'] == 'bottom' ? "uk-tab-{$data['switcher_position']}" : '';
        break;
    case 'thumbnav':
        $nav_horizontal = '';
        $attrs_nav['class'][] = 'uk-thumbnav';
        break;
}
// Alignment
switch ($data['switcher_align']) {
    case 'right':
    case 'center':
        $nav_horizontal .= " uk-flex-{$data['switcher_align']}";
        break;
    case 'justify':
        $nav_horizontal .= ' uk-child-width-expand';
        break;
}
// Style Vertical
switch ($data['switcher_style']) {
    case 'subnav':
    case 'subnav-pill':
    case 'subnav-divider':
        $nav_vertical = $data['switcher_style_primary'] ? 'uk-nav uk-nav-primary' : 'uk-nav uk-nav-default';
        break;
    case 'tab':
        $nav_vertical = "uk-tab-{$data['switcher_position']}";
        break;
    case 'thumbnav':
        $nav_vertical = 'uk-thumbnav-vertical';
        break;
}
if (in_array($data['switcher_position'], ['top', 'bottom'])) {
    $attrs_nav['class'][] = $nav_horizontal;
} else {
    $attrs_nav['class'][] = $nav_vertical;
    if ($data['switcher_style'] != 'tab') {
        $attrs_nav['uk-toggle'] =  "cls: {$nav_vertical} {$nav_horizontal}; mode: media; media: @{$data['switcher_breakpoint']}";
    }
}
$attrs_nav['class'][] = 'el-nav';
$attrs_nav['class'] = array_unique($attrs_nav['class']);
?>
<ul<?= Uikit::attrs($attrs_nav) ?>>
    <?php foreach ($data['items'] as $item) :
        // Display
        if (!$data['show_title']) { $item['title'] = ''; }
        if (!$data['show_meta']) { $item['meta'] = ''; }
        if (!$data['show_content']) { $item['content'] = ''; }
        if (!$data['show_image']) { $item['image'] = ''; }
        if (!$data['show_link']) { $item['link'] = ''; }
        if (!$data['show_label']) { $item['label'] = ''; }
        if (!$data['show_thumbnail']) { $item['thumbnail'] = ''; }
        // Image
        $thumbnail = '';
        $src = $item['thumbnail'] ? $item['thumbnail'] : $item['image'];
        if ($data['switcher_style'] == 'thumbnav' && $src) {
            $attrs_thumbnail['alt'] = $item['label'] ? $item['label'] : $item['title'];
            if (Uikit::isImage($src) == 'svg') {
                $thumbnail = Uikit::image($src, array_merge($attrs_thumbnail, ['width' => $data['switcher_thumbnail_width'], 'height' => $data['switcher_thumbnail_height']]));
            } elseif ($data['switcher_thumbnail_width'] || $data['switcher_thumbnail_height']) {
                $thumbnail = Uikit::image([$src, 'thumbnail' => [$data['switcher_thumbnail_width'], $data['switcher_thumbnail_height']], 'sizes' => '80%,200%'], $attrs_thumbnail);
            } else {
                $thumbnail = Uikit::image($src, $attrs_thumbnail);
            }
        }
    ?>
    <li>
        <a href="#"><?= $thumbnail ? $thumbnail : ($item['label'] ? $item['label'] : $item['title']) ?></a>
    </li>
    <?php endforeach ?>
</ul>
