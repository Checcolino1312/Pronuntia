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



$id = Yii::$app->session->getFlash('id');



$this->title = 'Index Logopedista';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="logopedista-index">

    <h1><?= Html::encode($this->title) ?></h1>

<!--    <h1>Benvenuto logopedista con ID --><?php //= Yii::$app->request->get('id') ?><!-- </-->
<?php echo 'Il tuo ID è: ' . $id; ?>



<?php //Html::a('Create Logopedista', ['create'], ['class' => 'btn btn-success']) ?>
<!---->
<!---->
<?php // echo $this->render('_search', ['model' => $searchModel]); ?>
<!---->
<!--    <h4>Benvenuto Dott.</h4> <h1>--><?php //= $model->nome ?><!--</h1>-->
<!--    <p>Email: --><?php //= $model->email ?><!--</p>-->







</div>
<?php //= Html::a('Crea CareGiver', ['create_caregiver'], ['class' => 'btn btn-primary']) ?>
<!---->
<!--<p><a class="btn btn-lg btn-success" href="/logopedista/create_assistito">Aggiungi Assistito &raquo;</a></p>-->
<?= Html::beginForm(['create_caregiver'], 'post') ?>
<?= Html::hiddenInput('id', $id) ?>
<?= Html::submitButton('Crea CareGiver', ['class' => 'btn btn-primary']) ?>
<?= Html::endForm() ?>
