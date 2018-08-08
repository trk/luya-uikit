<?php

use trk\uikit\Uikit;

/**
 * @var $this object
 * @var $data array
 */

$id    = $data['id'];
$class = $data['class'];
$attrs = $data['attrs'];
$attrs_icon = [];

// Icon
$options = ["icon: {$data['icon']}"];
$options[] = ($data['icon_ratio'] && $data['link_style'] != 'button') ? "ratio: {$data['icon_ratio']}" : '';
$attrs_icon['uk-icon'] = implode(';', array_filter($options));
$attrs_icon['class'][] = ($data['icon_color'] && !$data['link']) ? "uk-text-{$data['icon_color']}" : '';
// Link
if ($data['link']) {
    $attrs_icon['href'] = $data['link'];
    $attrs_icon['target'] = $data['link_target'] ? '_blank' : '';
    $attrs_icon['uk-scroll'] = strpos($data['link'], '#') === 0;
    switch ($data['link_style']) {
        case '':
            $attrs_icon['class'][] = "uk-icon-link";
            break;
        case 'button':
            $attrs_icon['class'][] = 'uk-icon-button';
            break;
        case 'link':
            $attrs_icon['class'][] = "";
            break;
        case 'muted':
        case 'text':
        case 'reset':
            $attrs_icon['class'][] = "uk-link-{$data['link_style']}";
            break;
    }
}
?>
<div<?= Uikit::attrs(compact('id', 'class'), $attrs) ?>>
    <?php if ($data['link']) : ?>
        <a<?= Uikit::attrs($attrs_icon) ?>></a>
    <?php else : ?>
        <span<?= Uikit::attrs($attrs_icon) ?>></span>
    <?php endif ?>
</div>