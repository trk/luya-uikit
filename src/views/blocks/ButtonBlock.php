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
$attrs_grid['class'][] = 'uk-flex-middle';
$attrs_grid['class'][] = $data['fullwidth'] ? 'uk-child-width-1-1' : 'uk-child-width-auto';
$attrs_grid['class'][] = $data['gutter'] ? "uk-grid-{$data['gutter']}" : '';
$attrs_grid['uk-grid'] = true;

// Flex alignment
if (!$data['fullwidth']) {
    if ($data['text_align'] && $data['text_align_breakpoint']) {
        $attrs_grid['class'][] = "uk-flex-{$data['text_align']}@{$data['text_align_breakpoint']}";
        if ($data['text_align_fallback']) {
            $attrs_grid['class'][] = "uk-flex-{$data['text_align_fallback']}";
        }
    } else if ($data['text_align']) {
        $attrs_grid['class'][] = "uk-flex-{$data['text_align']}";
    }
}
?>
<div<?= Uikit::attrs(compact('id', 'class'), $attrs) ?>>
    <?php if (count($data["items"]) > 1) : ?>
    <div<?= Uikit::attrs($attrs_grid) ?>>
        <?php endif ?>
        <?php foreach ($data['items'] as $item) :

            $attrs_button = [];
            $lightbox = '';
            $attrs_lightbox = [];
            $connect_id = 'js-' . substr(uniqid(), -3);

            $attrs_button['class'][] = 'el-content';

            // Fullwidth
            $attrs_button['class'][] = $data['fullwidth'] ? 'uk-width-1-1' : '';

            // Style
            switch ($item['button_style']) {
                case '':
                    break;
                case 'link-muted':
                case 'link-text':
                    $attrs_button['class'][] = "uk-{$item['button_style']}";
                    break;
                default:
                    $attrs_button['class'][] = "uk-button uk-button-{$item['button_style']}";
                    $attrs_button['class'][] = $data['button_size'] ? "uk-button-{$data['button_size']}" : '';
            }

            // Link and Lightbox
            if ($item['link_target'] == 'modal') {

                if (Uikit::isImage($item['link'])) {

                    $attrs_lightbox['alt'] = '';

                    if (Uikit::isImage($item['link']) == 'svg') {
                        $lightbox = Uikit::image($item['link'], array_merge($attrs_lightbox, ['width' => $item['lightbox_width'], 'height' => $item['lightbox_height']]));
                    } elseif ($item['lightbox_width'] || $item['lightbox_height']) {
                        $lightbox = Uikit::image([$item['link'], 'thumbnail' => [$item['lightbox_width'], $item['lightbox_height']], 'sizes' => '80%,200%'], $attrs_lightbox);
                    } else {
                        $lightbox = Uikit::image($item['link'], $attrs_lightbox);
                    }

                } elseif ($iframe = Uikit::iframeVideo($item['link']) or Uikit::isVideo($item['link'])) {

                    $attrs_lightbox['width'] = $item['lightbox_width'];
                    $attrs_lightbox['height'] = $item['lightbox_height'];
                    $attrs_lightbox['uk-video'] = true;

                    if ($iframe) {

                        $attrs_lightbox['src'] = $iframe;
                        $attrs_lightbox['frameborder'] = 0;
                        $attrs_lightbox['uk-responsive'] = true;

                        $lightbox = "<iframe" . Uikit::attrs($attrs_lightbox) . "></iframe>";

                    } else {

                        $attrs_lightbox['src'] = $item['link'];
                        $attrs_lightbox['controls'] = true;

                        $lightbox = "<video" . Uikit::attrs($attrs_lightbox) . "></video>";

                    }

                } else {

                    $attrs_lightbox['src'] = $item['link'];
                    $attrs_lightbox['width'] = $item['lightbox_width'];
                    $attrs_lightbox['height'] = $item['lightbox_height'];
                    $attrs_lightbox['frameborder'] = 0;
                    $attrs_lightbox['uk-responsive'] = true;

                    $lightbox = "<iframe" . Uikit::attrs($attrs_lightbox) . "></iframe>";
                }

                $attrs_button['uk-toggle'] = true;
                $attrs_button['href'] = "#{$connect_id}";

            } else {
                $attrs_button['href'] = $item['link'];
                $attrs_button['target'] = $item['link_target'] == 'blank' ? '_blank' : '';
                $attrs_button['uk-scroll'] = strpos($item['link'], '#') === 0;
            }

            $attrs_button['title'] = $item['link_title'];

            ?>

            <?php if (count($data['items']) > 1) : ?>
            <div class="el-item">
        <?php endif ?>

            <a<?= Uikit::attrs($attrs_button) ?>>

                <?php if ($item['icon']) : ?>

                    <?php if ($item['icon_align'] == 'left') : ?>
                        <span uk-icon="<?= $item['icon'] ?>"></span>
                    <?php endif ?>

                    <span class="uk-text-middle"><?= $item['content'] ?></span>

                    <?php if ($item['icon_align'] == 'right') : ?>
                        <span uk-icon="<?= $item['icon'] ?>"></span>
                    <?php endif ?>

                <?php else : ?>
                    <?= $item['content'] ?>
                <?php endif ?>

            </a>

            <?php if ($lightbox && $item['link_target'] == 'modal') : ?>
            <?php // uk-flex-top is needed to make vertical margin work for IE11 ?>
            <div id="<?= $connect_id ?>" class="uk-flex-top" uk-modal>
                <div class="uk-modal-dialog uk-width-auto uk-margin-auto-vertical">
                    <button class="uk-modal-close-outside" type="button" uk-close></button>
                    <?= $lightbox ?>
                </div>
            </div>
        <?php endif ?>

            <?php if (count($data['items']) > 1) : ?>
            </div>
        <?php endif ?>

        <?php endforeach ?>

        <?php if (count($data['items']) > 1) : ?>
    </div>
<?php endif ?>
</div>