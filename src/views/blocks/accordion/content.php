<?php

use trk\uikit\Uikit;

/**
 * @var $this object
 * @var $data array
 * @var $item array
 */

$attrs_content = [];
$attrs_link = [];

// Content
$attrs_content['class'][] = 'uk-margin el-content';
$attrs_content['class'][] = $data['content_style'] ? "uk-text-{$data['content_style']}" : '';
// Link
if ($item['link']) {
    $attrs_link['href'] = $item['link'];
    $attrs_link['target'] = $data['link_target'] ? '_blank' : '';
    $attrs_link['uk-scroll'] = strpos($item['link'], '#') === 0;
    $attrs_link['class'][] = 'el-link';
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
?>
<?php if ($item['content']) : ?>
<div<?= Uikit::attrs($attrs_content) ?>><?= $item['content'] ?></div>
<?php endif ?>
<?php if ($item['link'] && $data['link_text']) : ?>
<p><a<?= Uikit::attrs($attrs_link) ?>><?= $data['link_text'] ?></a></p>
<?php endif ?>
