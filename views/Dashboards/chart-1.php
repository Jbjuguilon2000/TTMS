<?php

require(dirname(dirname(__DIR__)) . '/Database.php');

$utilTrainersQuery = $dbTTMS->query('SELECT * FROM util_trainers WHERE ID');
$utilTrainersAll = $utilTrainersQuery->fetch_all(MYSQLI_ASSOC);

foreach ($utilTrainersAll as $trainer) {
    if ($trainer['ID'] < 6) {
        $utTrainer[$trainer['ID']] = $trainer['Short'];
    }
}

$trainingsQuery = $dbTTMS->query('SELECT * FROM trainings');
$trainingsAll = $trainingsQuery->fetch_all(MYSQLI_ASSOC);

foreach ($trainingsAll as $Training) {
    $tTrainerID = explode(',', $Training['TrainerID']);
    for ($x = 0; $x < count($tTrainerID); $x++) {
        $TrainerName = str_replace('', '', $tTrainerID[$x]);
        if (empty($CountTrainer[$TrainerName])) {
            $CountTrainer[$TrainerName] = 1;
        } else {
            $CountTrainer[$TrainerName] += 1;
        }
    }
}

foreach ($utTrainer as $key => $value) {
    $Trainer[] = $value;
    if (isset($CountTrainer[$key])) {
        $Trainings[] = $CountTrainer[$key];
    } else {
        $Trainings[] = 0;
    }
}

?>
<style>
    .chart1-container {
        height: 50vh;
        width: 100%;
    }
</style>

<div class="chart1-container">
    <canvas id="myChart1"></canvas>
</div>

<script>
    // setup 
    var data = {
        labels: <?php echo json_encode($Trainer); ?>,
        datasets: [{
            label: 'Number of Trainings',
            data: <?php echo json_encode($Trainings); ?>,
            backgroundColor: [
                'rgba(255, 26, 104)',
                'rgba(54, 162, 235)',
                'rgba(255, 206, 86)',
                'rgba(75, 192, 192)',
                'rgba(153, 102, 255)',
                'rgba(255, 159, 64)',
                'rgba(0, 0, 0)'
            ],
        }]
    };

    // config 
    var Chart1config = {
        type: 'bar',
        data,
        options: {
            maintainAspectRatio: false,
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                }
            }
        }
    };

    // render init block
    var myChart1 = new Chart(
        document.getElementById('myChart1'),
        Chart1config
    );
</script>