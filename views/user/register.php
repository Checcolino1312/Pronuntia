<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Registrazione';

$form = ActiveForm::begin([
    'id' => 'register-form',
    'options' => ['class' => 'form-horizontal'],
    'fieldConfig' => [
        'template' => "{label}\n<div class=\"col-lg-6\">{input}</div>\n<div class=\"col-lg-3\">{error}</div>",
        'labelOptions' => ['class' => 'col-lg-3 control-label'],
    ],
]); ?>

<?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

<?= $form->field($model, 'email') ?>

<?= $form->field($model, 'password')->passwordInput() ?>

<?= $form->field($model, 'password_repeat')->passwordInput() ?>

<div class="form-group">
    <div class="col-lg-offset-3 col-lg-6">
        <?= Html::submitButton('Registrati', ['class' => 'btn btn-primary']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>
