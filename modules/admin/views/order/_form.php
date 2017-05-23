<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Order */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="container okno_mine">
        <div class="order-form ">

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'created_at')->textInput() ?>

            <?= $form->field($model, 'updated_at')->textInput() ?>

            <?= $form->field($model, 'qty')->textInput() ?>

            <?= $form->field($model, 'sum')->textInput() ?>

            <?= $form->field($model, 'status')->dropDownList([ '0'=>'активен', '1'=> 'завершен', ]) ?>

            <?= $form->field($model, 'comment')->textInput(['maxlength' => true]) ?>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
</div>