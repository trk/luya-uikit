<?php

use trk\uikit\Uikit;

/**
 * @var $this object
 * @var $data array
 */

$attrs_title = [];
$attrs_content = [];
$attrs_meta = [];

// Title
$attrs_title['class'][] = 'el-title uk-margin';
$attrs_title['class'][] = $data['title_style'] ? "uk-{$data['title_style']}" : '';
$attrs_title['class'][] = $data['panel_style'] && !$data['title_style'] ? "uk-card-title" : '';
$attrs_title['class'][] = $data['title_decoration'] ? "uk-heading-{$data['title_decoration']}" : '';
$attrs_title['class'][] = $data['title_color'] && $data['title_color'] != 'background' ? "uk-text-{$data['title_color']}" : '';
// Meta
$attrs_meta['class'][] = 'el-meta uk-margin';
switch ($data['meta_style']) {
    case '':
        break;
    case 'meta':
    case 'muted':
        $attrs_meta['class'][] = "uk-text-{$data['meta_style']}";
        break;
    default:
        $attrs_meta['class'][] = "uk-{$data['meta_style']}";
}
if ($data['meta_align'] == 'top') {
    $attrs_meta['class'][] = 'uk-margin-remove-adjacent';
    $attrs_meta['class'][] = $data['meta_margin'] ? "uk-margin-{$data['meta_margin']}-bottom" : '';
}
if ($data['meta'] && $data['meta_align'] == 'bottom') {
    $attrs_title['class'][] = 'uk-margin-remove-adjacent';
    $attrs_title['class'][] = $data['meta_margin'] ? "uk-margin-{$data['meta_margin']}-bottom" : '';
}
// Content
$attrs_content['class'][] = 'el-content uk-margin';
$attrs_content['class'][] = $data['content_style'] ? "uk-text-{$data['content_style']}" : '';
?>
<?php if ($data['meta'] && $data['meta_align'] == 'top') : ?>
<div<?= Uikit::attrs($attrs_meta) ?>><?= $data['meta'] ?></div>
<?php endif ?>

<?php if ($data['title']) : ?>
<<?= $data['title_element'] . Uikit::attrs($attrs_title) ?>>
    <?php if ($data['title_color'] == 'background') : ?>
    <span class="uk-text-background"><?= $data['title'] ?></span>
    <?php elseif ($data['title_decoration'] == 'line') : ?>
    <span><?= $data['title'] ?></span>
    <?php else : ?>
    <?= $data['title'] ?>
    <?php endif ?>
</<?= $data['title_element'] ?>>
<?php endif ?>

<?php if ($data['meta'] && $data['meta_align'] == 'bottom') : ?>
<div<?= Uikit::attrs($attrs_meta) ?>><?= $data['meta'] ?></div>
<?php endif ?>

<?php if ($data['image_align'] == 'between') : ?>
<?= $data['image'] ?>
<?php endif ?>

<?php if ($data['content']) : ?>
<div<?= Uikit::attrs($attrs_content) ?>><?= $data['content'] ?></div>
<?php endif ?>

<?php if ($data['link'] && $data['link_style'] != 'panel' && $data['link_text']) : ?>
<p><a<?= Uikit::attrs($attrs_link) ?>><?= $data['link_text'] ?></a></p>
<?php endif ?>
