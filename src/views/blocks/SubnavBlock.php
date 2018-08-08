<?php

use trk\uikit\Uikit;

/**
 * @var $this object
 * @var $data array
 */

$id    = $data['id'];
$class = $data['class'];
$attrs = $data['attrs'];
$attrs_subnav = [];
$attrs_link = [];

// Style
$attrs_subnav['class'][] = 'uk-subnav uk-margin-remove-bottom';
$attrs_subnav['class'][] = $data['subnav_style'] ? "uk-subnav-{$data['subnav_style']}" : '';
// Flex alignment
if ($data['text_align'] && $data['text_align_breakpoint']) {
    $attrs_subnav['class'][] = "uk-flex-{$data['text_align']}@{$data['text_align_breakpoint']}";
    if ($data['text_align_fallback']) {
        $attrs_subnav['class'][] = "uk-flex-{$data['text_align_fallback']}";
    }
} else if ($data['text_align']) {
    $attrs_subnav['class'][] = "uk-flex-{$data['text_align']}";
}
// Link
$attrs_link['class'][] = 'el-link';
// $attrs_link['class'][] = $data['link_style'] ? "uk-link-{$data['link_style']}" : '';
// Margin
$attrs_subnav['uk-margin'] = true;
?>
<div<?= Uikit::attrs(compact('id', 'class'), $attrs) ?>>
    <ul<?= Uikit::attrs($attrs_subnav) ?>>
        <?php foreach ($data['items'] as $item) :
            $attrs_link['href'] = $item['link'];
            $attrs_link['target'] = $item['link_target'] ? '_blank' : '';
            $attrs_link['uk-scroll'] = strpos($item['link'], '#') === 0;
            ?>
            <li class="el-item">
                <?php if ($item['link']) : ?>
                    <a<?= Uikit::attrs($attrs_link) ?>><?= $item['content'] ?></a>
                <?php else : ?>
                    <a class="el-content uk-disabled"><?= $item['content'] ?></a>
                <?php endif ?>
            </li>
        <?php endforeach ?>
    </ul>
</div>