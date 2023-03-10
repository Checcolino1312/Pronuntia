<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Assistito $model */

$this->title = 'Modifica Assistito: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Logopedistas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="logopedista-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('../assistito/_form', [
        'model' => $model,
    ]) ?>

</div>
