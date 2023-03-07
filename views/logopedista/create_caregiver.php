<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Caregiver $model */

$this->title = 'Create Caregiver';
$this->params['breadcrumbs'][] = ['label' => 'Caregivers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="caregiver-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('/caregiver/_form', [
        'model' => $model,
    ]) ?>

</div>
