<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\Esercizio */
/* @var $form ActiveForm */
$this->title = "Crea Esercizi";
$this->params['breadrumbs'][] = $this->title;
?>
<div class="esercizi-upload">
    <h1><?php echo Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'titolo')->textInput() ?>
    <?= $form->field($model, 'descrizione')->textInput() ?>

    <?= $form->field($model, 'immagine')->fileInput() ?>
    <?= $form->field($model, 'audio')->fileInput() ?>


    <div class="form-group">
        <?= Html::submitButton('Conferma creazione', ['class' => 'btn btn-primary btn-lg btn-block']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- esercizi-upload -->
