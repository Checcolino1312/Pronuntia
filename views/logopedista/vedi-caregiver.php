<?php

use app\models\Caregiver;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\web\YiiAsset;
use yii\widgets\DetailView;
use app\controllers\LogopedistaController;

/* @var $this yii\web\View */
/* @var $model app\models\Caregiver */

$this->title = 'Tutti i caregiver';
$this->params['breadcrumbs'][] = $this->title;
$id = Yii::$app->session->get('id');
?>
<div class="caregiver-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= Html::beginForm(['create_caregiver'], 'post') ?>
    <?= Html::hiddenInput('id', $id) ?>
    <?= Html::submitButton('Crea CareGiver', ['class' => 'btn btn-warning']) ?>
    <?= Html::endForm() ?>
    </br></br></br>
    <table class="table">
        <thead>
        <tr>
            <th style="text-align: center;">#</th>
            <th style="text-align: center;">Nome</th>
            <th style="text-align: center;">Cognome</th>
            <th style="text-align: center;">Email</th>
            <th style="text-align: center;">Cellulare</th>
            <th style="text-align: center;">Azioni</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($dataProvider->models as $index => $model): ?>
            <tr>
                <td style="text-align: center;"><?= $index + 1 ?></td>
                <td style="text-align: center;"><?= $model->nome ?></td>
                <td style="text-align: center;"><?= $model->cognome ?></td>
                <td style="text-align: center;"><?= $model->email ?></td>
                <td style="text-align: center;"><?= $model->cellulare ?></td>
                <td style="text-align: center;">
                    <?= yii\helpers\Html::a('Crea Assistito', ['create_assistito', 'id_caregiver' => $model->id], ['class' => 'btn btn-success', 'title' => 'Crea Assistito']) ?>
                    <?= yii\helpers\Html::a('Modifica', ['modifica_caregiver', 'id' => $model->id], ['class' => 'btn btn-primary', 'title' => 'Modifica']) ?>
                    <?= yii\helpers\Html::a('Visualizza', ['dettaglio_caregiver', 'id' => $model->id], ['class' => 'btn btn-info', 'title' => 'Visualizza']) ?>
                    <?= yii\helpers\Html::a('Elimina', ['elimina_caregiver','id'=>$model->id], ['title' => 'Elimina','class'=>'btn btn-danger', 'data' => ['confirm' => 'Sicuro di voler eliminare quest\' elemento?', 'method' => 'post', ],]); ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>



</div>
<!--        --><?php //= GridView::widget([
//        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
//        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
//
////            'id',
//            'nome',
//            'cognome',
//            'email:email',
////            'password',
//            'cellulare',
//            //'id_logopedista',
//            [
//                'class' => ActionColumn::className(),
//                'urlCreator' => function ($action, Caregiver $model, $key, $index, $column) {
//                    return Url::toRoute([$action, 'id' => $model->id]);
//                }
//            ],
//        ],
//    ]); ?>