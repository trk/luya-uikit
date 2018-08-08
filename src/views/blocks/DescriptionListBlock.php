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
$class[] = $data['list_style'] ? "uk-list uk-list-{$data['list_style']}" : 'uk-list';
// Size
$class[] = $data['list_size'] ? 'uk-list-large' : '';
?>
<ul<?=Uikit::attrs(compact('id', 'class'), $attrs) ?>>
    <?php foreach ($data["items"] as $item) : ?>
        <li class="el-item"><?= $this->render('description-list/item', compact('item', 'data')) ?></li>
    <?php endforeach ?>
</ul>