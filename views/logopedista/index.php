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
<!--    <h4>Benvenuto Dott.</h4> <h1>--><?php //= $model->nome ?><!--</h1>-->
<!--    <p>Email: --><?php //= $model->email ?><!--</p>-->







</div>
<?= Html::a('Crea CareGiver', ['create_caregiver', 'id' => Yii::$app->user->id], ['class' => 'btn btn-primary']) ?>

<!--<p><a class="btn btn-lg btn-success" href="/logopedista/create_assistito">Aggiungi Assistito &raquo;</a></p>-->
