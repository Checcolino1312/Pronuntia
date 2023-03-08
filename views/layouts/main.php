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
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<!--<header id="header">-->
<!--    --><?php
//    NavBar::begin([
//        'options' => ['class' => 'navbar-expand-md navbar-dark bg-dark fixed-top']
//    ]);
//
//    $item=[['label' => 'Pronuntia', 'url' => ['/site/index']],
//            ['label' => 'Info', 'url' => ['/site/info']],
//        ['label' => 'Registrati', 'url' => ['/logopedista/create']],
//        ];
//
//        if(Yii::$app->user->isGuest){
//                array_push($item, ['label' => 'Login', 'url' => ['/site/login']]);
//            } else{
//                array_push($item,'<li>'. Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline']). Html::submitButton('Logout (' . Yii::$app->user->identity->email . ')',['class' => 'btn btn-link logout']).Html::endForm().'</li>');
//             }
//    echo Nav::widget([
//        'options' => ['class' => 'navbar-nav'],
//        'items' => $item
//    ]);
//    NavBar::end();
//    ?>
<!--</header>-->

<header>
    <?php
    NavBar::begin([
        'options' => [
            'class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top',
        ],
    ]);
    $navItem = [
        ['label' => 'Pronuntia', 'url' => ['/site/index']],
    ];
    if(Yii::$app->user->isGuest){
        array_push($navItem, ['label' => 'Login', 'url' => ['/site/login']]);
    } else{
        array_push($navItem,'<li>'. Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline']). Html::submitButton('Logout (' . Yii::$app->user->identity->email . ')',['class' => 'btn btn-link logout']).Html::endForm().'</li>');
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => $navItem
    ]);
    NavBar::end();
    ?>
</header>



<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer id="footer" class="mt-auto py-3 bg-light">
    <div class="container">
        <div class="row text-muted">
            <div class="col-md-6 text-center text-md-start">&copy; My Company <?= date('Y') ?></div>
            <div class="col-md-6 text-center text-md-end"><?= Yii::powered() ?></div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
