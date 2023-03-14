<?php

use yii\bootstrap5\Modal;
use yii\db\Query;
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

<?php
$query = new Query();
$query->from('assegnazione');
$query->where(['id_assistito' => $id_assistito]);
$count = $query->count();

$query2 = new Query();
$query2->from('assegnazione');
$query2->where(['id_assistito' => $id_assistito])
    ->andWhere(['eseguito' => 1]);
$count2 = $query2->count();


//if($count == 0){ $count = 1;}
//if($count2 == 0){ $count2 = 0;}
?>


<td style="text-align: center;"><?php

    if($count == 0){
        echo '<div> NON SONO STATI ANCORA ASSEGNATI ESERCIZI </div>';
    }
    else {

        if ($count2 - $count == 0) {
            echo '<h1 class="text-success"> TUTTI GLI ESERCIZI SONO STATI SVOLTI </h1>';

            Modal::begin([
                'title' => 'CLICCA!',
                'toggleButton' => [
                    'label' => '☆ ☆ ☆ PREMIO ☆ ☆ ☆',
                    'class' => 'btn btn-success',
                ],
            ]);
// Anteprima del video
            echo '<a href="https://www.youtube.com/embed/anDQEBF7f-o" class="video-link" data-toggle="modal" data-target="#video-modal"><img width="100%" height="300" src="https://img.youtube.com/vi/anDQEBF7f-o/maxresdefault.jpg" alt="Anteprima del video"></a>';

            Modal::end();

// Modale per la riproduzione del video
            Modal::begin([
                'title' => 'ECCO IL TUO PREMIO',
                'id' => 'video-modal',
                'size' => Modal::SIZE_LARGE,

            ]);
            echo '<div class="embed-responsive embed-responsive-16by9"><iframe width="100%" height="400" class="embed-responsive-item" src=""></iframe></div>';
            Modal::end();

// Aggiungi il seguente codice JavaScript per avviare la riproduzione del video quando l'utente fa clic sull'anteprima del video
            $js = <<<JS
$(document).on('click', '.video-link', function(e) {
    e.preventDefault();
    var videoUrl = $(this).attr('href');
    $('#video-modal iframe').attr('src', videoUrl);
    $('#video-modal').modal('show');
});

    $('#video-modal').on('hidden.bs.modal', function() {
    $('#video-modal iframe').attr('src', '');
});
JS;
            $this->registerJs($js);
        } else {
            echo '<h1 class="text-warning"> SVOLGI TUTTI GLI ESERCIZI PER RICEVERE UN PREMIO!</h1>';
        }
    }

    ?></td>


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
