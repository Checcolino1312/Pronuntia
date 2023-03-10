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
/* @var $model app\models\Logopedista*/

$this->title = 'Il tuo Logopedista';
$this->params['breadcrumbs'][] = $this->title;
$id = Yii::$app->session->get('id_logopedista');
?>
    <div class="caregiver-index">

        <table class="table">
            <thead>
            <tr>

                <th style="text-align: center;">Nome</th>
                <th style="text-align: center;">Cognome</th>
                <th style="text-align: center;">Email</th>
                <th style="text-align: center;">Cellulare</th>
                <th style="text-align: center;">Indirizzo Studio</th>

            </tr>
            </thead>
            <tbody>
            <?php foreach ($dataProvider->models as $index => $model): ?>
                <tr>

                    <td style="text-align: center;"><?= $model->nome ?></td>
                    <td style="text-align: center;"><?= $model->cognome ?></td>
                    <td style="text-align: center;"><?= $model->email ?></td>
                    <td style="text-align: center;"><?= $model->cellulare ?></td>
                    <td style="text-align: center;"><?= $model->indirizzo_studio ?></td>

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