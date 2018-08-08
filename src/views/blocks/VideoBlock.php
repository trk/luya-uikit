<?php

use trk\uikit\Uikit;

/**
 * @var $this object
 * @var $data array
 */

$id    = $data['id'];
$class = $data['class'];
$attrs = $data['attrs'];

// Video
$attrs_video['width'] = $data['video_width'];
$attrs_video['height'] = $data['video_height'];
$attrs_video['class'][] = $data['video_box_shadow'] ? "uk-box-shadow-{$data['video_box_shadow']}" : '';
if ($iframe = Uikit::iframeVideo($data['video'], [], false)) {
    $attrs_video['src'] = $iframe;
    $attrs_video['frameborder'] = 0;
    $attrs_video['allowfullscreen'] = true;
    $attrs_video['uk-responsive'] = true;
} else {
    $attrs_video['src'] = $data['video'];
    $attrs_video['controls'] = $data['video_controls'];
    $attrs_video['autoplay'] = $data['video_autoplay'];
    $attrs_video['loop'] = $data['video_loop'];
    $attrs_video['muted'] = $data['video_muted'];
    $attrs_video['playsinline'] = $data['video_playsinline'];
    $attrs_video['poster'] = $data['video_poster'];
}
?>
<div<?= Uikit::attrs(compact('id', 'class'), $attrs) ?>>
    <?php if ($data['video_box_shadow_bottom']): ?>
        <div class="uk-box-shadow-bottom">
            <?php endif ?>

            <?php if ($iframe) : ?>
                <iframe<?= Uikit::attrs($attrs_video) ?>></iframe>
            <?php else : ?>
                <video<?= Uikit::attrs($attrs_video) ?>></video>
            <?php endif ?>

            <?php if ($data['video_box_shadow_bottom']): ?>
        </div>
    <?php endif ?>
</div>