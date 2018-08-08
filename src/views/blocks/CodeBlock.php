<?php

use trk\uikit\Uikit;

/**
 * @var $this
 * @var $data
 */

$id    = $data['id'];
$class = $data['class'];
$attrs = $data['attrs'];
?>
<pre<?= Uikit::attrs(compact('id', 'class'), $attrs) ?>><code class="el-content"><?= str_replace("\n", '', htmlspecialchars(nl2br($data["content"]), ENT_COMPAT, 'UTF-8')) ?></code></pre>