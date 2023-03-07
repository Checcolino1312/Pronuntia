<?php

use app\models\Logopedista;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\controllers\LogopedistaController;

/* @var $this yii\web\View */
/* @var $model app\models\Logopedista */
/* @var $form yii\widgets\ActiveForm */

$user = Yii::$app->user->identity;
$this->title = 'Registrazione Logopedista';
$this->params['breadcrumbs'][] = $this->title;
?>

ciao a tutti


