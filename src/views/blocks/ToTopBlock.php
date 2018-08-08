<?php

use trk\uikit\Uikit;

/**
 * @var $this object
 * @var $data array
 */

$id    = $data['id'];
$class = $data['class'];
$attrs = $data['attrs'];

// Link Title
$attrs['title'] = $data['link_title'];
?>
<div<?= Uikit::attrs(compact('id', 'class')) ?>>
    <a href="#" data-uk-totop data-uk-scroll<?= Uikit::attrs($attrs) ?>></a>
</div>