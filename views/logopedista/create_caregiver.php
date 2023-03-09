<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Caregiver $model */

$this->title = 'Create Caregiver';
$this->params['breadcrumbs'][] = ['label' => 'Logopedista', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="caregiver-create">

    <h1><?= Html::encode($this->title) ?></h1>

<!--    --><?php //= $this->render('/caregiver/_form', [
//        'model' => $model,
//    ]) ?>
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'cognome')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'cellulare')->textInput(['maxlength' => true]) ?>

        <!--    --><?php //= $form->field($model, 'id_logopedista')->hiddenInput()->label(false);?>

<!--        --><?php //= $form->field($model, 'id_logopedista')->hiddenInput(['value' => $id])->label(false) ?>




        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>




</div>
