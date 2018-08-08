<?php

use trk\uikit\Uikit;

/**
 * @var $this object
 * @var $data array
 */

$id    = $data['id'];
$class = $data['class'];
$attrs = $data['attrs'];

// Column
if ($data['column'] && $data['column_breakpoint']) {
    $class[] = "uk-column-{$data['column']}@{$data['column_breakpoint']}";
    $breakpoints = [
        's'  => [''],
        'm'  => ['s',''],
        'l'  => ['m','s',''],
        'xl' => ['l','m','s','']
    ];
    $breakpoints = $breakpoints[$data['column_breakpoint']];
    list($base, $columns) = explode('-', $data['column']);
    foreach ($breakpoints as $breakpoint) {
        if ($columns < 2) {
            break;
        }
        $class[] = 'uk-column-1-'.(--$columns).($breakpoint ? "@{$breakpoint}" : '');
    }
} else if ($data['column']) {
    $class[] = "uk-column-{$data['column']}";
}
$class[] = ($data['column'] && $data['column_divider']) ? 'uk-column-divider' : '';
// Drop Cap
$class[] = $data['dropcap'] ? 'uk-dropcap' : '';
// Style
$class[] = $data['text_style'] ? "uk-text-{$data['text_style']}" : '';
// Color
$class[] = !$data['text_style'] && $data['text_color'] ? "uk-text-{$data['text_color']}" : '';
// Size
$class[] = !$data['text_style'] && $data['text_size'] ? "uk-text-{$data['text_size']}" : '';
?>
<div<?= Uikit::attrs(compact('id', 'class'), $attrs) ?>>
    <?= $data['content'] ?>
</div>