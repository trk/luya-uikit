<?php

use trk\uikit\Uikit;

/**
 * @var $this object
 * @var $data array
 */

$id = $data['id'];
$class = $data['class'];
$attrs = $data['attrs'];
$attrs_content = [];
$attrs_image = [];
$attrs_grid = [];
$attrs_cell_image = [];
$attrs_image_container = [];
$attrs_link = [];
$attrs_icon = [];

// Image
if ($data['image']) {
    $src = $data['image'];

    $attrs_image['class'][] = 'el-image';
    $attrs_image['class'][] = $data['image_border'] ? "uk-border-{$data['image_border']}" : '';
    $attrs_image['class'][] = $data['image_box_shadow'] && !$data['panel_style'] ? "uk-box-shadow-{$data['image_box_shadow']}" : '';
    $attrs_image['class'][] = $data['link'] && $data['image_hover_box_shadow'] && !$data['panel_style'] && $data['link_style'] == 'panel' ? "uk-box-shadow-hover-{$data['image_hover_box_shadow']}" : '';
    $attrs_image['alt'] = $data['image_alt'];
    $attrs_image['uk-cover'] = ($data['panel_style'] && $data['image_card'] && in_array($data['image_align'], ['left', 'right'])) ? true : false;

    if (Uikit::isImage($data['image']) == 'gif') {
        $attrs_image['uk-gif'] = true;
    }
    if (Uikit::isImage($data['image']) == 'svg') {
        $data['image'] = Uikit::image($src, array_merge($attrs_image, ['width' => $data['image_width'], 'height' => $data['image_height']]));
    } elseif ($data['image_width'] || $data['image_height']) {
        $data['image'] = Uikit::image([$src, 'thumbnail' => [$data['image_width'], $data['image_height']], 'sizes' => '80%,200%'], $attrs_image);
    } else {
        $data['image'] = Uikit::image($src, $attrs_image);
    }
    // Placeholder image if card and layout left or right
    if ($data['panel_style'] && $data['image_card'] && in_array($data['image_align'], ['left', 'right'])) {
        $attrs_image['class'][] = 'uk-invisible';
        $attrs_image['uk-cover'] = false;
        if ($data['image_width'] || $data['image_height']) {
            $data['image'] .= Uikit::image([$src, 'thumbnail' => [$data['image_width'], $data['image_height']], 'sizes' => '80%,200%'], $attrs_image);
        } else {
            $data['image'] .= Uikit::image($src, $attrs_image);
        }
    }
} elseif ($data['icon']) {
    $options = ["icon: {$data['icon']}"];
    $options[] = $data['icon_ratio'] ? "ratio: {$data['icon_ratio']}" : '';
    $attrs_icon['uk-icon'] = implode(';', array_filter($options));

    $attrs_icon['class'][] = 'el-image';
    $attrs_icon['class'][] = $data['icon_color'] ? "uk-text-{$data['icon_color']}" : '';

    $data['image'] = "<span " . Uikit::attrs($attrs_icon) . "></span>";
    $data['image_card'] = false;
}
// Card
if ($data['panel_style']) {
    $class[] = "uk-card uk-{$data['panel_style']}";
    $class[] = $data['panel_size'] ? "uk-card-{$data['panel_size']}" : '';
    $class[] = $data['link'] && $data['link_style'] == 'panel' && $data['panel_style'] != 'card-hover' ? 'uk-card-hover' : '';
    // Card media
    if ($data['image'] && $data['image_card'] && $data['image_align'] != 'between') {
        $attrs_content['class'][] = 'uk-card-body';
    } else {
        $class[] = 'uk-card-body';
    }
} else {
    $class[] = 'uk-panel';
}

// Image Align
$attrs_grid['class'][] = 'uk-child-width-expand';
if ($data['panel_style'] && $data['image_card']) {
    $attrs_grid['class'][] = 'uk-grid-collapse uk-grid-match';
} else {
    $attrs_grid['class'][] = $data['image_gutter'] ? "uk-grid-{$data['image_gutter']}" : '';
}

$attrs_grid['class'][] = $data['image_vertical_align'] ? 'uk-flex-middle' : '';
$attrs_grid['uk-grid'] = true;

if ($data['image_breakpoint']) {
    $attrs_cell_image['class'][] = "uk-width-{$data['image_grid_width']}@{$data['image_breakpoint']}";
    $attrs_cell_image['class'][] = $data['image_align'] == 'right' ? "uk-flex-last@{$data['image_breakpoint']}" : '';
} else {
    $attrs_cell_image['class'][] = "uk-width-{$data['image_grid_width']}";
    $attrs_cell_image['class'][] = $data['image_align'] == 'right' ? 'uk-flex-last' : '';
}
if ($data['panel_style'] && $data['image_card'] && in_array($data['image_align'], ['left', 'right'])) {
    $attrs_image_container['class'][] = 'uk-cover-container';
}
// Card media
if ($data['panel_style'] && $data['image'] && $data['image_card'] && $data['image_align'] != 'between' ) {
    $attrs_image_container['class'][] = "uk-card-media-{$data['image_align']}";
    $data['image'] = "<div" . Uikit::attrs($attrs_image_container) . ">{$data['image']}</div>";
}
// Link
if ($data['link']) {
    $attrs_link['href'] = $data['link'];
    $attrs_link['target'] = $data['link_target'] ? '_blank' : '';
    $attrs_link['uk-scroll'] = strpos($data['link'], '#') === 0;
    $attrs_link['class'][] = 'el-link';
    if ($data['link_style'] == 'panel') {
        if ($data['panel_style']) {
            $attrs_link['class'][] = 'uk-position-cover uk-position-z-index uk-margin-remove-adjacent';
        }
        if (!$data['panel_style'] && $data['image']) {
            $attrs_link['class'][] = $data['image_box_shadow_bottom'] ? 'uk-box-shadow-bottom' : '';
            $data['image'] = "<a" . Uikit::attrs($attrs_link) . ">{$data['image']}</a>";
        }
    } else {
        switch ($data['link_style']) {
            case '':
                break;
            case 'link-muted':
            case 'link-text':
                $attrs_link['class'][] = "uk-{$data['link_style']}";
                break;
            default:
                $attrs_link['class'][] = "uk-button uk-button-{$data['link_style']}";
                $attrs_link['class'][] = $data['link_size'] ? "uk-button-{$data['link_size']}" : '';
        }
    }
}
// Box-shadow bottom
if ((!$data['link'] || ($data['link'] && $data['link_style'] != 'panel')) && !$data['panel_style'] && $data['image_box_shadow_bottom']) {
    $data['image'] = "<div class=\"uk-box-shadow-bottom\">{$data['image']}</div>";
}
?>
<div<?= Uikit::attrs(compact('id', 'class'), $attrs) ?>>
    <?php if ($data['link'] && $data['link_style'] == 'panel' && $data['panel_style']) : ?>
        <a<?= Uikit::attrs($attrs_link) ?>></a>
    <?php endif ?>
    <?php if ($data['image'] && in_array($data['image_align'], ['left', 'right'])) : ?>
        <div<?= Uikit::attrs($attrs_grid) ?>>
            <div<?= Uikit::attrs($attrs_cell_image) ?>>
                <?= $data['image'] ?>
            </div>
            <div>
                <?php if ($data['panel_style'] && $data['image']) : ?>
                    <div<?= Uikit::attrs($attrs_content) ?>>
                        <?= $this->render('panel/content', compact('attrs_link', 'data')) ?>
                    </div>
                <?php else : ?>
                    <?= $this->render('panel/content', compact('attrs_link', 'data')) ?>
                <?php endif ?>
            </div>
        </div>
    <?php else : ?>
        <?php if ($data['image_align'] == 'top') : ?>
            <?= $data['image'] ?>
        <?php endif ?>
        <?php if ($data['panel_style'] && $data['image'] && $data['image_card'] && in_array($data['image_align'], ['top', 'bottom'])) : ?>
            <div<?= Uikit::attrs($attrs_content) ?>>
                <?= $this->render('panel/content', compact('attrs_link', 'data')) ?>
            </div>
        <?php else : ?>
            <?= $this->render('panel/content', compact('attrs_link', 'data')) ?>
        <?php endif ?>
        <?php if ($data['image_align'] == 'bottom') : ?>
            <?= $data['image'] ?>
        <?php endif ?>
    <?php endif ?>
</div>