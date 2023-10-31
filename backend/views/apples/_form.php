<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Apples $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="apples-form">

    <?php $form = ActiveForm::begin(); ?>

<!--    --><?//= $form->field($model, 'color')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'date_growing')->textInput() ?>

<!--    --><?//= $form->field($model, 'date_fall')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'eat')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
