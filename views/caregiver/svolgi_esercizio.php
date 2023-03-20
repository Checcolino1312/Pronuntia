<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\Esercizio */
/* @var $assistito app\models\Assistito */
/* @var $form ActiveForm */

$this->title = "Svolgi esercizio";
$this->params['breadrumbs'][] = $this->title;



?>
<h1><?= Html::encode($this->title) ?></h1>

</br>

</br></br>
<div class="container">
    <div class="row">
        <?php foreach ($dataProvider->models as $index => $model): ?>
            <div class="col-md-4">
                <div class="card" >
                    <img class="card-img-top" src="<?php echo Yii::getAlias('@web').'/'.$model->immagine_filepath; ?>" alt="Card image cap" >
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $model->titolo;?></h5>
                        <p class="card-text"><?php echo $model->descrizione;?></p>
                        <audio style="width: 100%;" controls>

                            <source src="<?php echo Yii::getAlias('@web').'/'.$model->audio_filepath;?>" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>
                        </br>

                        <?php
                        $assegnazione = app\models\Assegnazione::findOne(['id_assistito' => $id_assistito, 'id_esercizio' => $model->id]);
                        if($assegnazione && $assegnazione->eseguito == 1) {
                            echo "Svolgimento approvato.";
                            echo yii\helpers\Html::a('TORNA AGLI ESERCIZI', ['vedi_esercizi', 'assistito_id' => $id_assistito], ['class' => 'btn btn-warning btn-lg btn-block', 'title' => 'Torna agli esercizi']);
                        } else {            if($assegnazione->valutazione == 0) {
                            echo "Valuta lo svolgimento dell' esercizio: </br>";
                            for ($i = 1; $i <= 5; $i++) {
                                //CLICCA SULLA STELLA E METTE ESEGUITO = TRUE E VALUTAZIONE IL VALORE DELLA STELLA
                                echo Html::a($i . ' ☆', ['svolgi_esercizio', 'assistito_id' => $id_assistito, 'esercizio_id' => $model->id, 'valutazione' => $i], ['class' => 'btn btn-warning m-1']);
                            }
                        }

                        }
                        ?>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>
    </div>
</div>
</div>
