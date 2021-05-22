<?php
/**
 * @var \App\View\AppView $this
 * @var array $params
 * @var string $message
 */
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>

<div class="alert alert-info fade in nomargin">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
    <span class="glyphicon glyphicon-ok-circle mr-xs"></span><?= $message ?>
</div>