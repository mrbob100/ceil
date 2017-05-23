<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ceilings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ceilings-index">
    <div class="container okno_mine">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Ceilings', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID',
            'category_id',
            'user_id',
            'created_at',
            'Sum',
             'Comment',
             'status',
            // 'createdat',
             'UID',
            // 'img:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    </div>
</div>
