<?php

use app\controllers\LogopedistaController;
use app\models\Logopedista;


use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;



/** @var yii\web\View $this */
/** @var app\models\LogopedistaSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

// Verifica se l'utente è autenticato
//if (Yii::$app->user->isGuest){
//    // L'utente non è autenticato, redirect alla pagina di accesso
//    Yii::$app->response->redirect(['logopedista/login']);
//
//    Yii::$app->end();
//}

$user = Yii::$app->user->identity;

$this->title = 'Index Logopedista';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="logopedista-index">

    <h1><?= Html::encode($this->title) ?></h1>






<?php //Html::a('Create Logopedista', ['create'], ['class' => 'btn btn-success']) ?>
<!---->
<!---->
<?php // echo $this->render('_search', ['model' => $searchModel]); ?>
<!---->
<?= GridView::widget([
        'dataProvider' => $dataProvider,

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nome',
            'cognome',
            'email:email',
            'password',
            'cellulare',
            'indirizzo_studio',
            //'status',
            //'auth_key',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Logopedista $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    'summary' => '',
    ]); ?>


</div>
<?= Html::a('Crea CareGiver', ['create_caregiver', 'id' => Yii::$app->user->id], ['class' => 'btn btn-primary']) ?>

<!--<p><a class="btn btn-lg btn-success" href="/logopedista/create_assistito">Aggiungi Assistito &raquo;</a></p>-->
