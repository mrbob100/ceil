<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use iutbay\yii2kcfinder\KCFinderInputWidget;
/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">
    <div class="container okno_mine">
    <?php $form = ActiveForm::begin(); ?>
    <div class="form-group field-product-category_id has-success">
        <label class="control-label" for="product-category_id">Родительская категория</label>
        <select id="product-category_id" class="form-control" name="Product[category_id]">
            <!--?= \app\components\MenuWidget::widget(['tpl' => 'select_product', 'model' => $model])? -->
        </select>
    </div>
    <?= $form->field($model, 'category_id')->textInput() ?>

    <?= $form->field($model, 'UID')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'Name')->widget(KCFinderInputWidget::className(), [
            'multiple' => true,
        ]); ?>
        <?= $form->field($model, 'Name')->widget(CKEditor::className(), [
            'options' => ['rows' => 6],
            'preset' => 'basic'
        ]) ?>

    <?= $form->field($model, 'IsGroup')->textInput() ?>

    <?= $form->field($model, 'ParentUID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TypeID')->textInput() ?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
 </div>
</div>
