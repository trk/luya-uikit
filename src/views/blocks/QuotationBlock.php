<?php

use trk\uikit\Uikit;

/**
 * @var $this object
 * @var $data array
 */

$id    = $data['id'];
$class = $data['class'];
$attrs = $data['attrs'];

$attrs_link = [
    'href' => $data['link'],
    'target' => $data['link_target'] ? '_blank' : '',
    'class' => $data['link_style'] ? "uk-link-{$data['link_style']}" : '',
];
?>
<blockquote<?= Uikit::attrs(compact('id', 'class'), $attrs) ?>>
    <?= $data['content'] ?>
    <?php if ($data['footer'] || $data['author']) : ?>
        <footer class="el-footer">
            <?= $data['footer'] ?>
            <?php if ($data['author']) : ?>
                <?php if ($data['link']) : ?>
                    <cite class="el-author"><a<?= Uikit::attrs($attrs_link) ?>><?= $data['author'] ?></a></cite>
                <?php else : ?>
                    <cite class="el-author"><?= $data['author'] ?></cite>
                <?php endif ?>
            <?php endif ?>
        </footer>
    <?php endif ?>
</blockquote>