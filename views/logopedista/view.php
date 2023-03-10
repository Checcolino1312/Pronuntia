<?php

use yii\helpers\Html;
use yii\widgets\DetailView;


/** @var yii\web\View $this */
/** @var app\models\Caregiver $model */









$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tutti i caregivers', 'url' => ['vedi-caregiver']];
$this->params['breadcrumbs'][] = ['label' => 'Dettaglio', 'url' => ['view', 'id' => $model->id]];
\yii\web\YiiAsset::register($this);
?>
<div class="logopedista-view">


    <h1>Dettaglio Caregiver n.<?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>





    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nome',
            'cognome',
            'email:email',
           // 'password',
            'cellulare',

        ],
    ]) ?>

</div>
