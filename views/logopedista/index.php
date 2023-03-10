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



$cognome = Yii::$app->session->get('cognome');
$id = Yii::$app->session->get('id');





?>
<div class="logopedista-index">

    <h1><?= Html::encode($this->title) ?></h1>

<!--    <h1>Benvenuto logopedista con ID --><?php //= Yii::$app->request->get('id') ?><!-- </-->
<?php echo 'Benvenuto dott. ' . $cognome . '  con ID:' . $id; ?>


</br>
    <h1 class="display-4">Benvenuto dott. <?php echo $cognome; ?> con ID: <?php echo $id; ?></h1>





</div>
<?php //= Html::a('Crea CareGiver', ['create_caregiver'], ['class' => 'btn btn-primary']) ?>
<!---->
<!--<p><a class="btn btn-lg btn-success" href="/logopedista/create_assistito">Aggiungi Assistito &raquo;</a></p>-->

