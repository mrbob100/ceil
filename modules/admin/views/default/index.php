<?php
use yii\helpers\Url;
?>

<div class="admin-default-index">
    <? \vova07\imperavi\Widget::widget([
    'selector' => '#my-textarea-id',
    'settings' => [
    'lang' => 'ru',
    'minHeight' => 200,
    'imageManagerJson' => Url::to(['/default/images-get']),
    'plugins' => [
    'imagemanager'
    ]
    ]
    ]);
    ?>
</div>
