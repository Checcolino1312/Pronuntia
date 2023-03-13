<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\Esercizio */
/* @var $assistito app\models\Assistito */
/* @var $form ActiveForm */

$this->title = "Dashboard esercizi";
$this->params['breadrumbs'][] = $this->title;



?>
<h1><?= Html::encode($this->title) ?></h1>

</br>

</br></br>
<div class="container">
    <div class="row">
        <?php foreach ($dataProvider->models as $index => $model): ?>
            <div class="col-md-3">
                <div class="card" >
                    <img class="card-img-top" src="<?php echo Yii::getAlias('@web').'/'.$model->immagine_filepath; ?>" alt="Card image cap" >
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $model->titolo;?></h5>
                        <p class="card-text"><?php echo $model->descrizione;?></p>
<!--                        <audio style="width: 100%;" controls>-->
<!---->
<!--                            <source src="--><?php //echo Yii::getAlias('@web').'/'.$model->audio_filepath;?><!--" type="audio/mpeg">-->
<!--                            Your browser does not support the audio element.-->
<!--                        </audio>-->
                        </br>

<!--                        --><?php //= yii\helpers\Html::a('SVOLGI ESERCIZIO', ['esercizio', 'assistito_id' => $id_assistito, 'esercizio_id' => $model->id, 'eseguito'=>false], ['class' => 'btn btn-success', 'title' => 'Svolgi']) ?>
                        <?php
                        $assegnazione = app\models\Assegnazione::findOne(['id_assistito' => $id_assistito, 'id_esercizio' => $model->id]);
                        if($assegnazione && $assegnazione->eseguito == 1) {
                            echo yii\helpers\Html::a('ESERCIZIO SVOLTO', ['vedi_esercizi', 'assistito_id' => $id_assistito], ['class' => 'btn btn-warning btn-lg btn-block', 'title' => 'Vedi gli esercizi']);
                        } else {
                            echo yii\helpers\Html::a('SVOLGI ESERCIZIO', ['esercizio', 'assistito_id' => $id_assistito, 'esercizio_id' => $model->id], ['class' => 'btn btn-success btn-lg btn-block', 'title' => 'Approva svolgimento']);

                        }
                        ?>


                    </div>
                </div>
            </div>

        <?php endforeach; ?>
    </div>


</div>


</div>
