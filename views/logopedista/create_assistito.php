<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Assistito $model */

$this->title = 'Crea Assistito';
$this->params['breadcrumbs'][] = ['label' => 'Logopedista', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$id = Yii::$app->session->get('id');
$id_caregiver = Yii::$app->request->get('id_caregiver');

echo 'Il tuo ID è: ' . $id;

?>
<div class="caregiver-create">

    <h1><?= Html::encode($this->title) ?></h1>


    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cognome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'eta')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'diagnosi')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'id_logopedista')->hiddenInput(['value' => $id])->label(false) ?>

    <?= $form->field($model, 'id_caregiver')->hiddenInput(['value' => $id_caregiver])->label(false) ?>




    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>



</div>
