<?php

use trk\uikit\Uikit;

/**
 * @var $this object
 * @var $data array
 */

$id    = $data['id'];
$class = $data['class'];
$attrs = $data['attrs'];
$attrs_table = [];
$attrs_cell_title = [];
$attrs_cell_meta = [];
$attrs_cell_content = [];
$attrs_cell_image = [];
$attrs_cell_link = [];

// Find empty fields
$title_empty = true;
$meta_empty = true;
$content_empty = true;
$image_empty = true;
$link_empty = true;

foreach ($data['items'] as $item) {
    if ($item['title']) { $title_empty = false; }
    if ($item['meta']) { $meta_empty = false; }
    if ($item['content']) { $content_empty = false; }
    if ($item['image']) { $image_empty = false; }
    if ($item['link']) { $link_empty = false; }
}

if ($title_empty) { $data['show_title'] = false; }
if ($meta_empty) { $data['show_meta'] = false; }
if ($content_empty) { $data['show_content'] = false; }
if ($image_empty) { $data['show_image'] = false; }
if ($link_empty) { $data['show_link'] = false; }
// Style
$attrs_table['class'][] = $data['table_style'] ? "uk-table uk-table-{$data['table_style']}" : 'uk-table';
$attrs_table['class'][] = $data['table_hover'] ? 'uk-table-hover' : '';
$attrs_table['class'][] = $data['table_justify'] ? 'uk-table-justify' : '';
// Size
$attrs_table['class'][] = $data['table_size'] ? "uk-table-{$data['table_size']}" : '';
// Vertical align
$attrs_table['class'][] = $data['table_vertical_align'] ? 'uk-table-middle' : '';
// Responsive
$attrs_table['class'][] = $data['table_responsive'] == 'responsive' ? 'uk-table-responsive' : '';
$class[] = $data['table_responsive'] == 'overflow' ? 'uk-overflow-auto' : '';
// Text wrap
$attrs_cell_title['class'][] = $data['table_width_title'] == 'shrink' ? 'uk-text-nowrap' : '';
$attrs_cell_meta['class'][] = $data['table_width_meta'] == 'shrink' ? 'uk-text-nowrap' : '';
$attrs_cell_content['class'][] = $data['table_width_content'] == 'shrink' ? 'uk-text-nowrap' : '';
$attrs_cell_link['class'][] = 'uk-text-nowrap';
// Last column alignment
if ($data['table_last_align']) {
    $breakpoint = $data['table_responsive'] == 'responsive' ? '@m' : '';
    switch ($data['table_order']) {
        case 1:
            if ($data['show_link']) {
                $attrs_cell_link['class'][] = "uk-text-{$data['table_last_align']}{$breakpoint}";
            } elseif ($data['show_content']) {
                $attrs_cell_content['class'][] = "uk-text-{$data['table_last_align']}{$breakpoint}";
            } else {
                $attrs_cell_title['class'][] = "uk-text-{$data['table_last_align']}{$breakpoint}";
            }
            break;
        case 3:
            if ($data['show_link']) {
                $attrs_cell_link['class'][] = "uk-text-{$data['table_last_align']}{$breakpoint}";
            } elseif ($data['show_meta']) {
                $attrs_cell_meta['class'][] = "uk-text-{$data['table_last_align']}{$breakpoint}";
            } else {
                $attrs_cell_content['class'][] = "uk-text-{$data['table_last_align']}{$breakpoint}";
            }
            break;
        case 2:
        case 4:
            if ($data['show_link']) {
                $attrs_cell_link['class'][] = "uk-text-{$data['table_last_align']}{$breakpoint}";
            } elseif ($data['show_content']) {
                $attrs_cell_content['class'][] = "uk-text-{$data['table_last_align']}{$breakpoint}";
            } else {
                $attrs_cell_meta['class'][] = "uk-text-{$data['table_last_align']}{$breakpoint}";
            }
            break;
        case 5:
        case 6:
            if ($data['show_image']) {
                $attrs_cell_image['class'][] = "uk-text-{$data['table_last_align']}{$breakpoint}";
            } elseif ($data['show_link']) {
                $attrs_cell_link['class'][] = "uk-text-{$data['table_last_align']}{$breakpoint}";
            } else {
                $attrs_cell_content['class'][] = "uk-text-{$data['table_last_align']}{$breakpoint}";
            }
            break;
    }
}
?>
<?php if ($data['table_responsive'] == 'overflow') : ?>
    <div<?= Uikit::attrs(compact('id', 'class'), $attrs) ?>>
    <table<?= Uikit::attrs($attrs_table) ?>>
<?php else : ?>
    <table<?= Uikit::attrs(compact('id', 'class'), $attrs, $attrs_table) ?>>
<?php endif ?>
<?php if ($data['table_head_title'] ||
    $data['table_head_meta'] ||
    $data['table_head_content'] ||
    $data['table_head_image'] ||
    $data['table_head_link']) : ?>
    <?php
    // Templates
    $data['table_head_meta'] = $data['show_meta'] ? "<th" . Uikit::attrs($attrs_cell_meta) . ">{$data['table_head_meta']}</th>" : '';
    $data['table_head_image'] = $data['show_image'] ? "<th" . Uikit::attrs($attrs_cell_image) . ">{$data['table_head_image']}</th>" : '';
    $data['table_head_title'] = $data['show_title'] ? "<th" . Uikit::attrs($attrs_cell_title) . ">{$data['table_head_title']}</th>" : '';
    $data['table_head_content'] = $data['show_content'] ? "<th" . Uikit::attrs($attrs_cell_content) . ">{$data['table_head_content']}</th>" : '';
    $data['table_head_link'] = $data['show_link'] ? "<th" . Uikit::attrs($attrs_cell_link) . ">{$data['table_head_link']}</th>" : '';
    ?>
    <thead>
    <tr>
        <?php if ($data['table_order'] == '1') : ?>
            <?= $data['table_head_meta'] ?>
            <?= $data['table_head_image'] ?>
            <?= $data['table_head_title'] ?>
            <?= $data['table_head_content'] ?>
            <?= $data['table_head_link'] ?>
        <?php elseif ($data['table_order'] == '2') : ?>
            <?= $data['table_head_title'] ?>
            <?= $data['table_head_image'] ?>
            <?= $data['table_head_meta'] ?>
            <?= $data['table_head_content'] ?>
            <?= $data['table_head_link'] ?>
        <?php elseif ($data['table_order'] == '3') : ?>
            <?= $data['table_head_image'] ?>
            <?= $data['table_head_title'] ?>
            <?= $data['table_head_content'] ?>
            <?= $data['table_head_meta'] ?>
            <?= $data['table_head_link'] ?>
        <?php elseif ($data['table_order'] == '4') : ?>
            <?= $data['table_head_image'] ?>
            <?= $data['table_head_title'] ?>
            <?= $data['table_head_meta'] ?>
            <?= $data['table_head_content'] ?>
            <?= $data['table_head_link'] ?>
        <?php elseif ($data['table_order'] == '5') : ?>
            <?= $data['table_head_title'] ?>
            <?= $data['table_head_meta'] ?>
            <?= $data['table_head_content'] ?>
            <?= $data['table_head_link'] ?>
            <?= $data['table_head_image'] ?>
        <?php elseif ($data['table_order'] == '6') : ?>
            <?= $data['table_head_meta'] ?>
            <?= $data['table_head_title'] ?>
            <?= $data['table_head_content'] ?>
            <?= $data['table_head_link'] ?>
            <?= $data['table_head_image'] ?>
        <?php endif ?>
    </tr>
    </thead>
<?php endif ?>
    <tbody>
    <?php $first = true; ?>
    <?php foreach ($data['items'] as $item) : ?>
        <?php
        // Display
        if (!$data['show_title']) { $item['title'] = ''; }
        if (!$data['show_meta']) { $item['meta'] = ''; }
        if (!$data['show_content']) { $item['content'] = ''; }
        if (!$data['show_image']) { $item['image'] = ''; }
        if (!$data['show_link']) { $item['link'] = ''; }
        // Widths
        $attrs_width_title = [];
        $attrs_width_meta = [];
        $attrs_width_content = [];
        $attrs_width_image = [];
        $attrs_width_link = [];
        if ($first) {
            switch ($data['table_width_title']) {
                case '':
                    break;
                case 'shrink':
                    $attrs_width_title['class'][] = "uk-table-{$data['table_width_title']}";
                    break;
                default:
                    $attrs_width_title['class'][] = "uk-width-{$data['table_width_title']}";
            }
            switch ($data['table_width_meta']) {
                case '':
                    break;
                case 'shrink':
                    $attrs_width_meta['class'][] = "uk-table-{$data['table_width_meta']}";
                    break;
                default:
                    $attrs_width_meta['class'][] = "uk-width-{$data['table_width_meta']}";
            }
            switch ($data['table_width_content']) {
                case '':
                    break;
                case 'shrink':
                    $attrs_width_content['class'][] = "uk-table-{$data['table_width_content']}";
                    break;
                default:
                    $attrs_width_content['class'][] = "uk-width-{$data['table_width_content']}";
            }
            $attrs_width_image['class'][] = 'uk-table-shrink';
            $attrs_width_link['class'][] = 'uk-table-shrink';
        }
        // Templates
        if ($data['show_title']) {
            $item['title'] = "<td" . Uikit::attrs($attrs_cell_title, $attrs_width_title) . ">{$this->render('table/title', compact('item', 'data'))}</td>";
        }
        if ($data['show_meta']) {
            $item['meta'] = "<td" . Uikit::attrs($attrs_cell_meta, $attrs_width_meta) . ">{$this->render('table/meta', compact('item', 'data'))}</td>";
        }
        if ($data['show_content']) {
            $item['content'] = "<td" . Uikit::attrs($attrs_cell_content, $attrs_width_content) . ">{$this->render('table/content', compact('item', 'data'))}</td>";
        }
        if ($data['show_image']) {
            $item['image'] = "<td" . Uikit::attrs($attrs_cell_image, $attrs_width_image) . ">{$this->render('table/image', compact('item', 'data'))}</td>";
        }
        if ($data['show_link']) {
            $item['link'] = "<td" . Uikit::attrs($attrs_cell_link, $attrs_width_link) . ">{$this->render('table/link', compact('item', 'data'))}</td>";
        }
        ?>
        <tr class="el-item">
            <?php if ($data['table_order'] == '1') : ?>
                <?= $item['meta'] ?>
                <?= $item['image'] ?>
                <?= $item['title'] ?>
                <?= $item['content'] ?>
                <?= $item['link'] ?>
            <?php elseif ($data['table_order'] == '2') : ?>
                <?= $item['title'] ?>
                <?= $item['image'] ?>
                <?= $item['meta'] ?>
                <?= $item['content'] ?>
                <?= $item['link'] ?>
            <?php elseif ($data['table_order'] == '3') : ?>
                <?= $item['image'] ?>
                <?= $item['title'] ?>
                <?= $item['content'] ?>
                <?= $item['meta'] ?>
                <?= $item['link'] ?>
            <?php elseif ($data['table_order'] == '4') : ?>
                <?= $item['image'] ?>
                <?= $item['title'] ?>
                <?= $item['meta'] ?>
                <?= $item['content'] ?>
                <?= $item['link'] ?>
            <?php elseif ($data['table_order'] == '5') : ?>
                <?= $item['title'] ?>
                <?= $item['meta'] ?>
                <?= $item['content'] ?>
                <?= $item['link'] ?>
                <?= $item['image'] ?>
            <?php elseif ($data['table_order'] == '6') : ?>
                <?= $item['meta'] ?>
                <?= $item['title'] ?>
                <?= $item['content'] ?>
                <?= $item['link'] ?>
                <?= $item['image'] ?>
            <?php endif ?>
        </tr>
        <?php
        if ($first) {
            $first = false;
        }
        ?>
    <?php endforeach ?>
    </tbody>
    </table>
<?php if ($data['table_responsive'] == 'overflow') : ?>
    </div>
<?php endif ?>