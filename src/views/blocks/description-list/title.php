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
switch ($data['title_style']) {
    case '':
    case 'strong':
        $attrs_title['class'][] = 'uk-display-block';
        break;
    case 'muted':
        $attrs_title['class'][] = 'uk-display-block uk-text-muted';
        break;
    default:
        $attrs_title['class'][] = "uk-{$data['title_style']} uk-margin-remove";
}

// Color
$attrs_title['class'][] = $data['title_color'] && $data['title_color'] != 'background' ? "uk-text-{$data['title_color']}" : '';
$item['title'] = $data['title_color'] == 'background' ? "<span class=\"uk-text-background\">{$item['title']}</span>" : $item['title'];

// Leader
if ($data['leader'] && $data['layout'] == 'grid-2-m' && $data['width'] == 'expand') {
    $attrs_title['uk-leader'] = $data['breakpoint'] ? "media: @{$data['breakpoint']}" : true;
}
// Colon
$item['title'] .= $item['title'] && $data['title_colon'] ? ':' : '';
?>
<?php if ($item['title']) : ?>
    <?php if ($data['title_style'] == 'strong') : ?>
        <strong<?= Uikit::attrs($attrs_title) ?>><?= $item['title'] ?></strong>
    <?php elseif (in_array($data['title_style'], ['h1', 'h2', 'h3', 'h4', 'h5', 'h6'])) : ?>
        <h3<?= Uikit::attrs($attrs_title) ?>><?= $item['title'] ?></h3>
    <?php else : ?>
        <span<?= Uikit::attrs($attrs_title) ?>><?= $item['title'] ?></span>
    <?php endif ?>
<?php endif ?>
