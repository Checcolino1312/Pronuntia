<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\Esercizio */
/* @var $form ActiveForm */

$this->title = "Dashboard esercizi";
$this->params['breadrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>

</br>
<?= Html::a('Crea Esercizio', ['logopedista/crea_esercizio'], ['class' => 'btn btn-success']) ?>
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
                                        <audio style="width: 100%;" controls>

                                            <source src="<?php echo Yii::getAlias('@web').'/'.$model->audio_filepath;?>" type="audio/mpeg">
                                            Your browser does not support the audio element.
                                        </audio>
                                       </br>
                                        <?= yii\helpers\Html::a('Modifica', ['modifica_esercizio', 'id' => $model->id], ['class' => 'btn btn-primary', 'title' => 'Modifica']) ?>
                                    <?php echo Html::a('Elimina', ['elimina_esercizio', 'id' => $model->id], ['class' => 'btn btn-danger', 'data' => ['confirm' => 'Sicuro di voler eliminare quest\' elemento?', 'method' => 'post', ]]); ?>
                                    </div>
                    </div>
            </div>

<?php endforeach; ?>
    </div>
</div>
</div>
