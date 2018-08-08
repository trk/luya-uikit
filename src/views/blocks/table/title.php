<?php

use trk\uikit\Uikit;

/**
 * @var $this object
 * @var $data array
 * @var $item array
 */

$attrs_title = [];

$attrs_title['class'][] = 'el-title';
// Style
$attrs_title['class'][] = $data['title_style'] ? "uk-{$data['title_style']}" : '';
// Color
$attrs_title['class'][] = $data['title_color'] && $data['title_color'] != 'background' ? "uk-text-{$data['title_color']}" : '';
$item['title'] = $data['title_color'] == 'background' ? "<span class=\"uk-text-background\">{$item['title']}</span>" : $item['title'];
?>
<?php if ($item['title']) : ?>
    <div<?= Uikit::attrs($attrs_title) ?>><?= $item['title'] ?></div>
<?php endif ?>
