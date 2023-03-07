<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'Accedi';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
</br>
    <p><a class="btn btn-lg btn-success" href="/logopedista/login">Login Logopedista &raquo;</a></p>
    </br>
    <p><a class="btn btn-lg btn-success" href="/caregiver/login">Login CareGiver &raquo;</a></p>



<!--    <code>--><?php //= __FILE__ ?><!--</code>-->
</div>
