<?php

use trk\uikit\Uikit;

/**
 * @var $this object
 * @var $data array
 * @var $item array
 */


$attrs_content = [];
$attrs_link = [];

$attrs_content['class'][] = 'el-content';
$attrs_content['class'][] = $data['content_style'] ? "uk-text-{$data['content_style']}" : '';

// Link
$attrs_link['class'][] = $data['link_style'] ? "uk-link-{$data['link_style']}" : '';
$attrs_link['target'] = $item['link_target'] ? '_blank' : '';
$attrs_link['uk-scroll'] = strpos($item['link'], '#') === 0;
?>
<?php if ($item['content']) : ?>
<div<?= Uikit::attrs($attrs_content) ?>>
    <?php if ($item['link']) : ?>
        <?= Uikit::link($item["content"], $item['link'], $attrs_link) ?>
    <?php else : ?>
        <?= $item['content'] ?>
    <?php endif ?>
</div>
<?php endif ?>