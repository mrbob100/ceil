<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>
<div class="container ">
<?php
$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="order-index  okno_mine">



    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Order', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'created_at',
            'updated_at',
            'qty',
            'sum',
            [
                'attribute' =>'status',
                'value' => function($data){
                    return ! $data->status ? '<span class ="text-danger">Активен </span>' :'<span class ="text-success">завершен</span>';
                },
                'format' =>'raw',

            ],
            // 'status',
            // 'comment',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
</div>