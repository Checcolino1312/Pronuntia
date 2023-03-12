<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\Esercizio */
/* @var $form ActiveForm */
$this->title = "Crea Esercizio";
$this->params['breadrumbs'][] = $this->title;
?>
<div class="esercizi-upload">
    <h1><?php echo Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'titolo')->textInput() ?>

    <?= $form->field($model, 'descrizione')->textarea(['rows' => '3', 'class' => 'form-control']) ?>

    <?= $form->field($model, 'immagine')->label('Immagine (jpeg,png,jpg)')->fileInput(['accept' => 'image/jpeg, image/png, image/jpg', 'required'=>'true','class'=>'form-control custom-file' ]) ?>

    <?= $form->field($model, 'audio')->label('Audio (mp3)')->fileInput(['accept' => 'audio/mpeg', 'required'=>'true','class'=>'form-control custom-file']) ?>

</br>

    <div class="form-group">
        <?= Html::submitButton('Conferma creazione', ['class' => 'btn btn-primary btn-lg btn-block']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- esercizi-upload -->
