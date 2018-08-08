<?php

use trk\uikit\Uikit;

/**
 * @var $this object
 * @var $data array
 * @var $item array
 */

$attrs_content = [];

$attrs_content['class'][] = 'el-content';
$attrs_content['class'][] = $data['content_style'] ? "uk-text-{$data['content_style']}" : '';
?>
<?php if ($item['content']) : ?>
    <div<?= Uikit::attrs($attrs_content) ?>>
        <?= $item['content'] ?>
    </div>
<?php endif ?>