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
$attrs_cell_nav = [];
$connect_id = 'js-' . substr(uniqid(), -3);
// Nav Alignment
$attrs_grid['class'][] = 'uk-child-width-expand';
$attrs_grid['class'][] = $data['switcher_gutter'] ? "uk-grid-{$data['switcher_gutter']}" : '';
$attrs_grid['class'][] = $data['switcher_vertical_align'] ? 'uk-flex-middle' : '';
$attrs_grid['uk-grid'] = true;
$attrs_cell_nav['class'][] = "uk-width-{$data['switcher_grid_width']}@{$data['switcher_breakpoint']}";
$attrs_cell_nav['class'][] = $data['switcher_position'] == 'right' ? "uk-flex-last@{$data['switcher_breakpoint']}" : '';
// Content
$attrs_content['id'][] = $connect_id;
$attrs_content['class'][] = 'uk-switcher';
$attrs_content['uk-height-match'][] = $data['switcher_height'] ? 'row: false' : false;
?>
<div<?= Uikit::attrs(compact('id', 'class'), $attrs) ?>>
    <?php if (in_array($data['switcher_position'], ['left', 'right'])) : ?>
        <div<?= Uikit::attrs($attrs_grid) ?>>
            <div<?= Uikit::attrs($attrs_cell_nav) ?>>
                <?= $this->render('switcher/nav', compact('item', 'data', 'connect_id')) ?>
            </div>
            <div>
                <ul<?= Uikit::attrs($attrs_content) ?>>
                    <?php foreach ($data['items'] as $item) : ?>
                        <li class="el-item"><?= $this->render('switcher/item', compact('item', 'data')) ?></li>
                    <?php endforeach ?>
                </ul>
            </div>
        </div>
    <?php else : ?>
        <?php if ($data['switcher_position'] == 'top') : ?>
            <?= $this->render('switcher/nav', compact('item', 'data', 'connect_id')) ?>
        <?php endif ?>

        <ul<?= Uikit::attrs($attrs_content) ?>>
            <?php foreach ($data['items'] as $item) : ?>
                <li class="el-item"><?= $this->render('switcher/item', compact('item', 'data')) ?></li>
            <?php endforeach ?>
        </ul>

        <?php if ($data['switcher_position'] == 'bottom') : ?>
            <?= $this->render('switcher/nav', compact('item', 'data', 'connect_id')) ?>
        <?php endif ?>
    <?php endif ?>
</div>