<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>" class="h-100">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>

    <header>
        <?php
        NavBar::begin([
            'brandLabel' => 'Pronuntia',
            'brandUrl' => 'index',
            'options' => [
                'class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top',

            ],
        ]);
        $navItem = [

//            ['label' => 'Bambini', 'url' => ['/logopedista/vedi-bambini']],
            ['label' => 'Crea Caregivers', 'url' => ['/logopedista/create_caregiver']],
            ['label' => 'Vedi Caregivers', 'url' => ['/logopedista/vedi-caregiver']],
            ['label' => 'Logout (' . Yii::$app->session->get('email'). ')', 'url' => ['logopedista/logout']],
//            ['label' => 'Esercizi', 'url' => ['/logopedista/vedi-esercizi']],
        ];
        if(Yii::$app->logopedista->isGuest){
//            array_push($navItem, ['label' => 'Login', 'url' => ['/site/login']],['label' => 'Register', 'url' => ['/site/register']]);
       } else{
            array_push($navItem,'<li>'. Html::beginForm(['/logopedista/logout'], 'post', ['class' => 'form-inline']). Html::submitButton('Logout (' . Yii::$app->logopedista->identity->email . ')',['class' => 'btn btn-link logout']).Html::endForm().'</li>');
        }
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav'],
            'items' => $navItem
        ]);
        NavBar::end();
        ?>
    </header>

    <main role="main" class="flex-shrink-0">
        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </main>



    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>