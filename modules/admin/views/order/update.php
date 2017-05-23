<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Order */
?>
   <div class="container okno_mine">
 <?php
        $this->title = 'Update Order: ' . $model->id;
        $this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
        $this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
        $this->params['breadcrumbs'][] = 'Update';
?>
   <div class="order-update">

    <h3>Редактирование заказа №<?= $model->id ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
