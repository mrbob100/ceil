<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Ceilings */

$this->title = $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Ceilings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ceilings-view">
    <div class="container okno_mine">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ID',
            'category_id',
            'user_id',
            'created_at',
            'Sum',
            'Comment',
            'status',
            'UID',
            'img:ntext',
        ],
    ]) ?>



        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                <tr>
                    <th>Чертеж</th>
                    <th>наименование</th>
                    <th>потолок</th>

                </tr>
                </thead>
                <tbody>



                    <tr>
                        <td>  <?= $query->img ?></td>
                        <td>  <?= $query->name ?></td>
                        <td>  <?= $item_substr ?></td>

                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>