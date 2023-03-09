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
?>
<div class="caregiver-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'nome',
            'cognome',
            'email:email',
//            'password',
            'cellulare',
            //'id_logopedista',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Caregiver $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>

</div>
