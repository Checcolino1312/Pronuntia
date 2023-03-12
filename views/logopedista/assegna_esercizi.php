<?php

use app\models\Esercizio;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $assistito app\models\Assistito */
/* @var $form ActiveForm */

$this->title = "Assegna Esercizi";
$this->params['breadrumbs'][] = $this->title;

?>
<h1><?= Html::encode($this->title) ?></h1>

</br>

</br></br>


<?php $esercizi = Esercizio::find()->all();

$eserciziAssegnati = Yii::$app->db->createCommand('SELECT id_esercizio FROM assegnazione WHERE id_assistito=:id')
    ->bindValue(':id',$assistito->id)
    ->queryColumn();

?>








<div class="container">
    <div class="row">
        <?php foreach ($esercizi as $model){

            $esercizioAssegnato = false;
            //controllo se l' esercizio è stato già assegnato o meno
            for ($i = 0; $i < count($eserciziAssegnati); $i++) {
                if ($model->id == $eserciziAssegnati[$i]) {
                    $esercizioAssegnato = true;
                    break;
                }
            }





        if(!$esercizioAssegnato)
        {
        ?>
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
                        <?= yii\helpers\Html::a('Assegna', ['crea_assegnazione', 'id_assistito' => $assistito->id, 'id_esercizio'=>$model->id,], ['class' => 'btn btn-primary', 'title' => 'Modifica']) ?>

                    </div>
                </div>
            </div>

        <?php } }?>
    </div>
</div>
</div>
