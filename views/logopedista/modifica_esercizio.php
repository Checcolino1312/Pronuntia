<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Caregiver $model */

$this->title = 'Modifica Esercizio: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Esercizi', 'url' => ['vedi_esercizi']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Modifica';
?>
<div class="esercizio-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'titolo')->textInput() ?>
    <?= $form->field($model, 'descrizione')->textInput() ?>

    <?= $form->field($model, 'immagine')->label('Immagine (jpeg,png,jpg)')->fileInput(['accept' => 'image/jpeg, image/png, image/jpg', 'required'=>'true','class'=>'form-control custom-file' ]) ?>

    <?= $form->field($model, 'audio')->label('Audio (mp3)')->fileInput(['accept' => 'audio/mpeg', 'required'=>'true','class'=>'form-control custom-file']) ?>

    </br>

    <div class="form-group">
        <?= Html::submitButton('Conferma modifica', ['class' => 'btn btn-primary btn-lg btn-block']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
