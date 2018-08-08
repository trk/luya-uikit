<?php

use trk\uikit\Uikit;

/**
 * @var $this
 * @var $data
 */

$id    = $data['id'];
$class = $data['class'];
$attrs = $data['attrs'];

// Accordion
$attrs['uk-accordion'] = Uikit::json(Uikit::pick($data, ['multiple', 'collapsible']));
?>
<div<?= Uikit::attrs(compact('id', 'class'), $attrs) ?>>
    <?php foreach ($data['items'] as $item) : ?>
        <div class="el-item">
            <a class="el-title uk-accordion-title" href="#"><?= $item['title'] ?></a>
            <div class="uk-accordion-content">
                <?= $this->render('accordion/item', compact('item', 'data')) ?>
            </div>
        </div>
    <?php endforeach ?>
</div>
