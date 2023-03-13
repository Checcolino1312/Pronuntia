<?php

use yii\helpers\Html;
use yii\widgets\DetailView;


/** @var yii\web\View $this */
/** @var app\models\Caregiver $model */
/** @var app\models\Assistito $assistito */





$nome = $model->nome;
$cognome = $model->cognome;




$this->title = 'Dettaglio';
$this->params['breadcrumbs'][] = ['label' => 'Tutti gli assistiti', 'url' => ['vedi-assistiti']];

\yii\web\YiiAsset::register($this);
?>
<div class="logopedista-view">


    <h1><?php echo 'Dettaglio assistito:  ' . $cognome . ' ' . $nome ?></h1>
    <p>
        <?= Html::a('Modifica dati', ['modifica_assistito', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Elimina', ['elimina_assistito', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Sei sicuro di voler eliminare questo assistito?',
                'method' => 'post',
            ],
        ]) ?>
    </p>





    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nome',
            'cognome',
            'eta',
            'diagnosi',
//            'cellulare',

        ],
    ]) ?>

</div>
