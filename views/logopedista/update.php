<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Caregiver $model */

$this->title = 'Update Logopedista: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Logopedistas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="logopedista-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
