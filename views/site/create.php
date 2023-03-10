<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Logopedista */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Registrazione Logopedista';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="logopedista-registrazione">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>Compila il seguente modulo per registrarti come Logopedista:</p>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cognome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cellulare')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'indirizzo_studio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>


    <!--   <?php //= $form->field($model, 'conferma_password')->passwordInput(['maxlength' => true]) ?> -->

    <div class="form-group">
        <?= Html::submitButton('Registrati', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
