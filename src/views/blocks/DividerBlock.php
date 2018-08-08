<?php

use trk\uikit\Uikit;

/**
 * @var $this object
 * @var $data array
 */

$id    = $data['id'];
$class = $data['class'];
$attrs = $data['attrs'];

// Style
$class[] = $data['divider_style'] ? "uk-divider-{$data['divider_style']}" : '';
$class[] = !$data['divider_style'] && $data['divider_element'] == 'div' ? 'uk-hr' : '';

// Alignment
if ($data['divider_style'] == 'small') {
    if ($data['divider_align'] && $data['divider_align'] != 'justify' && $data['divider_align_breakpoint']) {
        $class[] = "uk-text-{$data['divider_align']}@{$data['divider_align_breakpoint']}";
        if ($data['divider_align_fallback']) {
            $class[] = "uk-text-{$data['divider_align_fallback']}";
        }
    } else if ($data['divider_align']) {
        $class[] = "uk-text-{$data['divider_align']}";
    }
}
?>
<?php if ($data['divider_element'] == 'div') : ?>
    <div <?= Uikit::attrs(compact('id', 'class'), $attrs) ?>></div>
<?php else : ?>
    <hr <?= Uikit::attrs(compact('id', 'class'), $attrs) ?>>
<?php endif ?>