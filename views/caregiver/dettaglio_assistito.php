<?php

use yii\helpers\Html;
use yii\widgets\DetailView;


/** @var yii\web\View $this */
/** @var app\models\Caregiver $model */
/** @var app\models\Assistito $assistito */





$nome = $model->nome;
$cognome = $model->cognome;




$this->title = 'Dettaglio';
$this->params['breadcrumbs'][] = ['label' => 'Tutti gli assistiti', 'url' => ['vedi-assistiti']];

\yii\web\YiiAsset::register($this);
?>
<div class="logopedista-view">


    <h1><?php echo 'Dettaglio assistito:  ' . $cognome . ' ' . $nome ?></h1>






    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
            'nome',
            'cognome',
            'eta',
            'diagnosi',
//            'cellulare',

        ],
    ]) ?>

</div>
<div class="grafico">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


    <div id="grafico-valutazioni"></div>

    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable(<?= json_encode($data) ?>);

            var options = {
                title: 'Andamento',
                chartArea: {width: '50%'},
                hAxis: {
                    title: 'Valutazione',
                    minValue: 0,
                    maxValue: 5,
                    format: '#'
                },
                vAxis: {
                    title: 'Esercizi',
                    textPosition: 'none' // rimuove i testi dall'asse verticale
                }
            };


            var chart = new google.visualization.BarChart(document.getElementById('grafico-valutazioni'));
            chart.draw(data, options);
        }
    </script>
</div>

<?php echo 'Media aritmetica:  ' . $media_valutazioni; ?>