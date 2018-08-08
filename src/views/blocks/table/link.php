<?php

use trk\uikit\Uikit;

/**
 * @var $this object
 * @var $data array
 * @var $item array
 */

$attrs_link = [];

// Link
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
        if ($data['link_fullwidth'] && $data['link_style'] != 'text') {
            $attrs_link['class'][] = $data['table_responsive'] == 'responsive' ? 'uk-width-auto uk-width-1-1@m' : 'uk-width-1-1';
        }
}
?>
<?php if ($item['link'] && ($item['link_text'] || $data['link_text'])) : ?>
    <a<?= Uikit::attrs($attrs_link) ?>><?= $item['link_text'] ? $item['link_text'] : $data['link_text'] ?></a>
<?php endif ?>