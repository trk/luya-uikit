<?php

use trk\uikit\Uikit;

/**
 * @var $this object
 * @var $data array
 * @var $item array
 */

$attrs_title = [];
$attrs_content = [];
$attrs_meta = [];

// Title
$attrs_title['class'][] = 'el-title uk-margin';
$attrs_title['class'][] = $data['title_style'] ? "uk-{$data['title_style']}" : '';
$attrs_title['class'][] = $data['title_decoration'] ? "uk-heading-{$data['title_decoration']}" : '';
$attrs_title['class'][] = $data['title_color'] && $data['title_color'] != 'background' ? "uk-text-{$data['title_color']}" : '';
$attrs_title['class'][] = $data['overlay_hover'] && $data['title_transition'] ? "uk-transition-{$data['title_transition']}" : '';

// Meta
$attrs_meta['class'][] = 'el-meta uk-margin';
$attrs_meta['class'][] = $data['overlay_hover'] && $data['meta_transition'] ? "uk-transition-{$data['meta_transition']}" : '';

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

if ($item['meta'] && $data['meta_align'] == 'bottom') {
    $attrs_title['class'][] = 'uk-margin-remove-adjacent';
    $attrs_title['class'][] = $data['meta_margin'] ? "uk-margin-{$data['meta_margin']}-bottom" : '';
}

// Content
$attrs_content['class'][] = 'el-content uk-margin';
$attrs_content['class'][] = $data['content_style'] ? "uk-text-{$data['content_style']}" : '';
$attrs_content['class'][] = $data['overlay_hover'] && $data['content_transition'] ? "uk-transition-{$data['content_transition']}" : '';

?>

<?php if ($item['meta'] && $data['meta_align'] == 'top') : ?>
<div<?= Uikit::attrs($attrs_meta) ?>><?= $item['meta'] ?></div>
<?php endif ?>

<?php if ($item['title']) : ?>
<<?= $data['title_element'] . Uikit::attrs($attrs_title) ?>>
    <?php if ($data['title_color'] == 'background') : ?>
    <span class="uk-text-background"><?= $item['title'] ?></span>
    <?php elseif ($data['title_decoration'] == 'line') : ?>
    <span><?= $item['title'] ?></span>
    <?php else : ?>
    <?= $item['title'] ?>
    <?php endif ?>
</<?= $data['title_element'] ?>>
<?php endif ?>

<?php if ($item['meta'] && $data['meta_align'] == 'bottom') : ?>
<div<?= Uikit::attrs($attrs_meta) ?>><?= $item['meta'] ?></div>
<?php endif ?>

<?php if ($item['content']) : ?>
<div<?= Uikit::attrs($attrs_content) ?>><?= $item['content'] ?></div>
<?php endif ?>
