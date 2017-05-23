<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Ceilings */

$this->title = 'Create Ceilings';
$this->params['breadcrumbs'][] = ['label' => 'Ceilings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ceilings-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
