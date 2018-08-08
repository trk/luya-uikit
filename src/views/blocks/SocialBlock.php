<?php

use trk\uikit\Uikit;

/**
 * @var $this object
 * @var $data array
 */

$id    = $data['id'];
$class = $data['class'];
$attrs = $data['attrs'];
$attrs_grid = [];

// Grid
$attrs_grid['class'][] = 'uk-child-width-auto';
$attrs_grid['class'][] = $data['gutter'] ? "uk-grid-{$data['gutter']}" : '';
$attrs_grid['uk-grid'] = true;

// Flex alignment
if ($data['text_align'] && $data['text_align_breakpoint']) {
    $attrs_grid['class'][] = "uk-flex-{$data['text_align']}@{$data['text_align_breakpoint']}";
    if ($data['text_align_fallback']) {
        $attrs_grid['class'][] = "uk-flex-{$data['text_align_fallback']}";
    }
} else if ($data['text_align']) {
    $attrs_grid['class'][] = "uk-flex-{$data['text_align']}";
}
?>
<div<?= Uikit::attrs(compact('id', 'class'), $attrs) ?>>
    <div<?= Uikit::attrs($attrs_grid) ?>>
        <?php foreach ($data['items'] as $item) :
            // Icon
            $options = ["icon: {$item['icon']}"];
            $options[] = ($data['icon_ratio'] && $data['link_style'] != 'button') ? "ratio: {$data['icon_ratio']}" : '';
            $attrs_icon = ['uk-icon' => implode(';', array_filter($options))];
            // Link
            $attrs_icon['href'] = $item['link'];
            $attrs_icon['target'] = $data['link_target'] ? '_blank' : '';
            $attrs_icon['class'][] = 'el-link';
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
            ?>
            <div>
                <a<?= Uikit::attrs($attrs_icon) ?>></a>
            </div>
        <?php endforeach ?>
    </div>
</div>