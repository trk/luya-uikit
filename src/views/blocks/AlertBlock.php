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
$class[] = $data['alert_style'] ? "uk-alert uk-alert-{$data['alert_style']}" : 'uk-alert';

// Size
$class[] = $data['alert_size'] ? "uk-padding" : '';

?>
<div<?= Uikit::attrs(compact('id', 'class'), $attrs) ?>>
    <?php if ($data['title']) : ?>
        <h3 class="el-title"><?= $data['title'] ?></h3>
    <?php endif ?>
    <div class="el-content"><?= $data['content'] ?></div>
</div>