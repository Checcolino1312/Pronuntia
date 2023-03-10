<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Caregiver $model */
/** @var yii\widgets\ActiveForm $form */

$id = Yii::$app->session->get('id');


?>

<div class="caregiver-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cognome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'eta')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'diagnosi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_logopedista')->hiddenInput(['maxlength' => true])->label(false) ?>

    <?= $form->field($model, 'id_caregiver')->hiddenInput(['maxlength' => true])->label(false) ?>



    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
