<?php

use trk\uikit\Uikit;

/**
 * @var $this object
 * @var $data array
 * @var $item array
 */

$attrs_grid = [];
$attrs_cell = [];

// Display
if (!$data['show_title']) { $item['title'] = ''; }
if (!$data['show_meta']) { $item['meta'] = ''; }
if (!$data['show_content']) { $item['content'] = ''; }
if (!$data['show_link']) { $item['link'] = ''; }
// Layout
if ($data['layout'] != 'stacked') {
    $attrs_grid['uk-grid'] = true;
    $attrs_cell['class'][] = in_array($data['width'], ['small', 'medium']) ? 'uk-text-break' : '';
    if ($data['width'] == 'expand') {
        $attrs_grid['class'][] = $data['breakpoint'] ? "uk-child-width-auto@{$data['breakpoint']}" : 'uk-child-width-auto';
    } else {
        $attrs_grid['class'][] = $data['breakpoint'] ? "uk-child-width-expand@{$data['breakpoint']}" : 'uk-child-width-expand';
    }
    $attrs_cell['class'][] = $data['breakpoint'] ? "uk-width-{$data['width']}@{$data['breakpoint']}" : "uk-width-{$data['width']}";
    if ($data['layout'] == 'grid-2-m') {
        if ($data['width'] == 'expand' && $data['leader']) {
            $attrs_grid['class'][] = 'uk-grid-small uk-flex-bottom';
        } else {
            $attrs_grid['class'][] = $data['gutter'] ? "uk-grid-{$data['gutter']}" : '';
            $attrs_grid['class'][] = 'uk-flex-middle';
        }
    } else {
        $attrs_grid['class'][] = $data['gutter'] ? "uk-grid-{$data['gutter']}" : '';
    }
}
?>
<?php if ($data['layout'] == 'stacked') : ?>
    <?php if ($data['meta_align'] == 'top-title') : ?>
        <?= $this->render('@builder/description-list/template-meta', compact('item', 'data')) ?>
    <?php endif ?>
    <?= $this->render('@builder/description-list/template-title', compact('item', 'data')) ?>
    <?php if (in_array($data['meta_align'], ['bottom-title', 'top-content'])) : ?>
        <?= $this->render('@builder/description-list/template-meta', compact('item', 'data')) ?>
    <?php endif ?>
    <?= $this->render('@builder/description-list/template-content', compact('item', 'data')) ?>
    <?php if ($data['meta_align'] == 'bottom-content') : ?>
        <?= $this->render('@builder/description-list/template-meta', compact('item', 'data')) ?>
    <?php endif ?>
<?php elseif ($data['layout'] == 'grid-2') : ?>
    <div<?= Uikit::attrs($attrs_grid) ?>>
        <div<?= Uikit::attrs($attrs_cell) ?>>
            <?php if ($data['meta_align'] == 'top-title') : ?>
                <?= $this->render('meta', compact('item', 'data')) ?>
            <?php endif ?>
            <?= $this->render('title', compact('item', 'data')) ?>
            <?php if ($data['meta_align'] == 'bottom-title') : ?>
                <?= $this->render('meta', compact('item', 'data')) ?>
            <?php endif ?>
        </div>
        <div>
            <?php if ($data['meta_align'] == 'top-content') : ?>
                <?= $this->render('meta', compact('item', 'data')) ?>
            <?php endif ?>
            <?= $this->render('content', compact('item', 'data')) ?>
            <?php if ($data['meta_align'] == 'bottom-content') : ?>
                <?= $this->render('meta', compact('item', 'data')) ?>
            <?php endif ?>
        </div>
    </div>
<?php else : ?>
    <div<?= Uikit::attrs($attrs_grid) ?>>
        <div<?= Uikit::attrs($attrs_cell) ?>>
            <?= $this->render('title', compact('item', 'data')) ?>
        </div>
        <div>
            <?= $this->render('meta', compact('item', 'data')) ?>
        </div>
    </div>
    <?= $this->render('content', compact('item', 'data')) ?>
<?php endif ?>

