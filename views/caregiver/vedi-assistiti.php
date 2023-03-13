<?php

use app\models\Assegnazione;
use app\models\Assistito;
use yii\db\Query;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\web\YiiAsset;
use yii\widgets\DetailView;
use app\controllers\LogopedistaController;

/* @var $this yii\web\View */
/* @var $model app\models\Assistito */

$this->title = 'Tutti gli assistiti';
$this->params['breadcrumbs'][] = $this->title;
$id = Yii::$app->session->get('id');

?>
    <div class="caregiver-index">

        <h1><?= Html::encode($this->title) ?></h1>

        </br></br></br>
        <table class="table">
            <thead>
            <tr>
                <th style="text-align: center;">#</th>
                <th style="text-align: center;">Nome</th>
                <th style="text-align: center;">Cognome</th>
                <th style="text-align: center;">Età</th>
                <th style="text-align: center;">Diagnosi</th>
                <th style="text-align: center;">Esercizi assegnati</th>
                <th style="text-align: center;">Azioni</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($dataProvider->models as $index => $model): ?>
            <?php

                $query = new Query();
                $query->from('assegnazione');
                $query->where(['id_assistito' => $model->id]);
                $count = $query->count();?>
                <tr>
                    <td style="text-align: center;"><?= $index + 1 ?></td>
                    <td style="text-align: center;"><?= $model->nome ?></td>
                    <td style="text-align: center;"><?= $model->cognome ?></td>
                    <td style="text-align: center;"><?= $model->eta ?></td>
                    <td style="text-align: center;"><?= $model->diagnosi ?></td>
                    <td style="text-align: center;"><?= $count ?></td>
                    <td style="text-align: center;">

                        <?= yii\helpers\Html::a('Esercizi', ['vedi_esercizi', 'assistito_id' => $model->id], ['class' => 'btn btn-success', 'title' => 'Esercizi']) ?>

                        <?= yii\helpers\Html::a('Visualizza', ['dettaglio_assistito', 'id' => $model->id], ['class' => 'btn btn-info', 'title' => 'Visualizza']) ?>

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