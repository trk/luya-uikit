<?php

use trk\uikit\Uikit;

/**
 * @var $this object
 * @var $data array
 */

$id    = $data['id'];
$class = $data['class'];
$attrs = $data['attrs'];
$attrs_image = [];
$attrs_link = [];
$lightbox = '';
$attrs_lightbox = [];
$connect_id = 'js-' . substr(uniqid(), -3);

// Image
$attrs_image['class'][] = 'el-image';
$attrs_image['class'][] = $data['image_border'] ? "uk-border-{$data['image_border']}" : '';
$attrs_image['class'][] = $data['image_box_shadow'] ? "uk-box-shadow-{$data['image_box_shadow']}" : '';
$attrs_image['class'][] = $data['link'] && $data['image_hover_box_shadow'] ? "uk-box-shadow-hover-{$data['image_hover_box_shadow']}" : '';
$attrs_image['alt'] = $data['image_alt'];

if (Uikit::isImage($data['image']) == 'gif') {
    $attrs_image['uk-gif'] = true;
}

if (Uikit::isImage($data['image']) == 'svg') {
    $data['image'] = Uikit::image($data['image'], array_merge($attrs_image, ['width' => $data['image_width'], 'height' => $data['image_height']]));
} elseif ($data['image_width'] || $data['image_height']) {
    $data['image'] = Uikit::image([$data['image'], 'thumbnail' => [$data['image_width'], $data['image_height']], 'sizes' => '80%,200%'], $attrs_image);
} else {
    $data['image'] = Uikit::image($data['image'], $attrs_image);
}
// Link and Lightbox
if ($data['link_modal']) {
    if (Uikit::isImage($data['link'])) {
        $attrs_lightbox['alt'] = '';
        if (Uikit::isImage($data['link']) == 'svg') {
            $lightbox = Uikit::image($data['link'], array_merge($attrs_lightbox, ['width' => $data['lightbox_width'], 'height' => $data['lightbox_height']]));
        } elseif ($data['lightbox_width'] || $data['lightbox_height']) {
            $lightbox = Uikit::image([$data['link'], 'thumbnail' => [$data['lightbox_width'], $data['lightbox_height']], 'sizes' => '80%,200%'], $attrs_lightbox);
        } else {
            $lightbox = Uikit::image($data['link'], $attrs_lightbox);
        }
    } elseif ($iframe = Uikit::iframeVideo($data['link']) or Uikit::isVideo($data['link'])) {
        $attrs_lightbox['width'] = $data['lightbox_width'];
        $attrs_lightbox['height'] = $data['lightbox_height'];
        $attrs_lightbox['uk-video'] = true;

        if ($iframe) {
            $attrs_lightbox['src'] = $iframe;
            $attrs_lightbox['frameborder'] = 0;
            $lightbox = "<iframe" . Uikit::attrs($attrs_lightbox) . "></iframe>";
        } else {
            $attrs_lightbox['src'] = $data['link'];
            $attrs_lightbox['controls'] = true;

            $lightbox = "<video" .Uikit::attrs($attrs_lightbox) . "></video>";
        }
    } else {
        $attrs_lightbox['src'] = $data['link'];
        $attrs_lightbox['width'] = $data['lightbox_width'];
        $attrs_lightbox['height'] = $data['lightbox_height'];
        $attrs_lightbox['frameborder'] = 0;

        $lightbox = "<iframe" . Uikit::attrs($attrs_lightbox) . "></iframe>";
    }
    $attrs_link['uk-toggle'] = true;
    $data['link'] = "#{$connect_id}";
} else {
    $attrs_link['target'] = $data['link_target'] == 'blank' ? '_blank' : '';
    $attrs_link['uk-scroll'] = strpos($data['link'], '#') === 0;
}
$attrs_link['class'][] = 'el-link';
// Box-shadow bottom
if ($data['image_box_shadow_bottom']) {
    if ($data['link']) {
        $attrs_link['class'][] = 'uk-box-shadow-bottom';
    } else {
        $data['image'] = "<div class=\"uk-box-shadow-bottom\">{$data['image']}</div>";
    }
}
?>
<div<?= Uikit::attrs(compact('id', 'class'), $attrs) ?>>
    <?php if ($data['link']) : ?>
        <?= Uikit::link($data['image'], $data['link'], $attrs_link) ?>
    <?php else : ?>
        <?= $data['image'] ?>
    <?php endif ?>
    <?php if ($lightbox && $data['link_modal']) : ?>
        <?php // uk-flex-top is needed to make vertical margin work for IE11 ?>
        <div id="<?= $connect_id ?>" class="uk-flex-top" data-uk-modal>
            <div class="uk-modal-dialog uk-width-auto uk-margin-auto-vertical">
                <button class="uk-modal-close-outside" type="button" data-uk-close></button>
                <?= $lightbox ?>
            </div>
        </div>
    <?php endif ?>
</div>