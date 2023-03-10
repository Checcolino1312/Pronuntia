<?php

use app\models\Caregiver;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\Logopedista;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\CaregiverSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */


$cognome = Yii::$app->session->get('cognome');
$id = Yii::$app->session->get('id');
$this->title = 'Caregiver Home';


?>
<div class="caregiver-index">




    <h1 class="display-4">Benvenuto Sig. <?php echo $cognome; ?> con ID: <?php echo $id; ?></h1>


</div>
