<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Logopedista */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="logopedista-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cognome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cellulare')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'indirizzo_studio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password_hash')->hiddenInput(['value' => Yii::$app->security->generateRandomString()])->label(false) ?>

    <?= $form->field($model, 'auth_key')->hiddenInput()->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>



