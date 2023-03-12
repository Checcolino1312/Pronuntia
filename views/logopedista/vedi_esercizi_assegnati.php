<?php
/* @var $this yii\web\View */

use app\models\Assegnazione;
use app\models\Esercizio;
use yii\helpers\html;

/* @var $this yii\web\View */
/* @var $assistito app\models\Assistito */
/* @var $assegnazioni Assegnazione[] */

$this->title = "Esercizi assegnati";


$this->params['breadcrumbs'][] = $this->title;
$nome = $assistito->nome;
$cognome = $assistito->cognome;
?>

<h1><?php echo 'Esercizi assegnati a ' . $cognome . ' ' . $nome ?></h1>

<p>
    <?= Html::a('Assegna Esercizi', ['assegna_esercizi', 'id' => $assistito->id], ['title' => 'Assegna Esercizi', 'class' => 'btn btn-primary']) ?>
</p>

<div class="container">
    <div class="row">
    <?php
    if(count($assegnazioni)>0)
    {

        foreach($assegnazioni as $assegnazione){
            $model = Esercizio::findOne($assegnazione->id_esercizio);
            //prendo valutazione, is svolto,titolo, descrizione
//            $valutazione= $assegnazione->valutazione;
            $isSvolto = $assegnazione->eseguito;
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
                                        </br></br>
                                        <?php                     echo Html::a('Rimuovi Assegnazione', ['elimina-assegnazione', 'assegnazione_id' => $assegnazione->id, 'assistito_id' => $assistito->id], [
                                            'title' => 'Elimina',
                                            'class' => 'btn btn-danger',
                                            'data' => [
                                                'confirm' => 'Sei sicuro di voler eliminare il seguente elemento?',
                                                'method' => 'post'
                                            ]
                                        ]);?>
                                      </div>
                                </div>
                            </div>
                    <?php if($assegnazione->eseguito){
                        echo "<h6 style='color:green;'>" . "ESEGUITO </h6>";
//                        echo "<p style='color:#FF8000;'>" . "Valutato: $assegnazione->valutazione su 5</p>";
                    }
                    else{
//                        echo "<h6 style='color:red;'>" . "NON ESEGUITO </h6>";
                    }
                    //rimuovi assegnazione

                    ?>


        <?php
        }

    }

    else{
        echo"Nessun ESERCIZIO assegnato ancora";
    }?>
    </div>
</div>