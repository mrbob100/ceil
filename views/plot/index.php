<section>
<div class="container okno_mine">
    <?php
use yii\widgets\ActiveForm;
?>

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($model, 'imageFile')->fileInput() ?>

    <button>Submit</button>

    <?php ActiveForm::end() ?>
</div>
</section>