<?php

use trk\uikit\Uikit;

/**
 * @var $this object
 * @var $data array
 * @var $item array
 */


$attrs_meta = [];

$attrs_meta['class'][] = 'el-meta';

switch ($data['meta_style']) {
    case '':
        break;
    case 'meta':
    case 'muted':
    case 'primary':
        $attrs_meta['class'][] = "uk-text-{$data['meta_style']}";
        break;
    default:
        $attrs_meta['class'][] = "uk-{$data['meta_style']} uk-margin-remove";
}
?>
<?php if ($item['meta']) : ?>
    <div<?= Uikit::attrs($attrs_meta) ?>><?= $item['meta'] ?></div>
<?php endif ?>