<?php

use trk\uikit\Uikit;

/**
 * @var $this object
 * @var $data array
 */

$id    = $data['id'];
$class = $data['class'];
$attrs = $data['attrs'];
$attrs_container = [];

$attrs['uk-grid'] = true;
$class[] = $data['gutter'] ? "uk-grid-{$data['gutter']}" : '';
$class[] = $data['divider'] && $data['gutter'] != 'collapse' ? 'uk-grid-divider' : '';
$class[] = $data['vertical_align'] ? 'uk-flex-middle' : '';
// Visibility
$visibilities = ['xs', 's', 'm', 'l', 'xl'];
$visible = 4;
/*
if ($visible) {
    $data['visibility'] = $visibilities[$visible];
    $class[] = "uk-visible@{$visibilities[$visible]}";
}
*/
// Margin
$margin = '';
switch ($data['margin']) {
    case '':
        switch ($data['gutter']) {
            case '':
                $margin = 'uk-grid-margin';
                break;
            case 'small':
            case 'medium':
            case 'large':
                $margin = "uk-grid-margin-{$data['gutter']}";
        }
        break;
    case 'default':
        $margin = 'uk-margin';
        break;
    default:
        $margin = "uk-margin-{$data['margin']}";
}
if ($data['margin'] != 'remove-vertical') {
    if ($data['margin_remove_top']) {
        $margin .= ' uk-margin-remove-top';
    }
    if ($data['margin_remove_bottom']) {
        $margin .= ' uk-margin-remove-bottom';
    }
}
// Container and width
if ($data['width']) {
    switch ($data['width']) {
        case 'default':
            $attrs_container['class'][] = 'uk-container';
            break;
        case 'small':
        case 'large':
        case 'expand':
            $attrs_container['class'][] = "uk-container uk-container-{$data['width']}";
    }
    // Margin
    $attrs_container['class'][] = $margin;
} else {
    // Margin
    $class[] = $margin;
}
?>
<?php if ($attrs_container) : ?><div<?= Uikit::attrs($attrs_container) ?>><?php endif ?>
    <div<?= Uikit::attrs(compact('id', 'class'), $attrs) ?>>
        <?php foreach ($data['items'] as $name => $item) {
            echo $this->render('row/column', ['data' => $item, 'parent' => $data]);
        } ?>
    </div>
<?php if ($attrs_container) : ?></div><?php endif ?>