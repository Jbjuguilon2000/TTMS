<?php

require(dirname(dirname(__DIR__)) . '/Database.php');

$utilTrainersQuery = $dbTTMS->query('SELECT * FROM util_trainers WHERE ID');
$utilTrainersAll = $utilTrainersQuery->fetch_all(MYSQLI_ASSOC);

foreach ($utilTrainersAll as $trainer) {
    // Display Trainings only for the Current Trainers
    // Alpapara, Santos, Saman Jr., and Martin Jr. 

    if ($trainer['ID'] <= 5 && $trainer['ID'] > 1) {
        $utTrainer[$trainer['ID']] = $trainer['Short'];
    }
}
// FilterDates
$StartDate = $_POST['StartDate'];
$EndDate = $_POST['EndDate'];

$trainingsQuery = $dbTTMS->query("SELECT TrainerID FROM trainings WHERE (`StartDate` BETWEEN '$StartDate' AND '$EndDate') AND `StatusID` = 1");
$trainingsAll = $trainingsQuery->fetch_all(MYSQLI_ASSOC);

foreach ($trainingsAll as $Training) {
    // splits the trainers
    $tTrainerID = explode(',', $Training['TrainerID']);
    // count each trainers
    for ($x = 0; $x < count($tTrainerID); $x++) {
        $TrainerName = str_replace('', '', $tTrainerID[$x]);
        if (empty($CountTrainer[$TrainerName])) {
            $CountTrainer[$TrainerName] = 1;
        } else {
            $CountTrainer[$TrainerName] += 1;
        }
    }
}

foreach ($CountTrainer as $key => $value) {
    $Trainings[] = $value;
    if (isset($utTrainer[$key])) {
        $Trainer[] = $utTrainer[$key];
    }
}

?>
<style>
    .chart1-container {
        height: 300px;
        width: 100%;
    }
</style>
<div class="mb-3">
    <h3 class="m-0">Trainers</h3>
    <p class="text-muted m-0">Chart shows the number of trainings conducted by trainers. </p>
</div>
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
                '#0466c8',
            ],
            barPercentage: 0.5,
        }]
    };

    // config 
    var Chart1config = {
        type: 'bar',
        data,
        options: {
            maintainAspectRatio: false,
            responsive: true,
            plugins: {
                legend: {
                    display: false,
                },
            },
            scales: {
                y: {
                    grid: {
                        display: false,
                    },
                    ticks: {
                        stepSize: 10,
                    }
                },
                x: {
                    grid: {
                        display: false,
                    },

                }
            }
        },
    };

    // render init block
    var myChart1 = new Chart(
        document.getElementById('myChart1'),
        Chart1config
    );
</script>