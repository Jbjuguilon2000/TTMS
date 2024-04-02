<?php

require(dirname(dirname(__DIR__)) . '/Database.php');
require(dirname(dirname(__DIR__)) . '/Functions.php');

$tID = $_POST['ID'];

$trainingQuery = $dbTTMS->query("SELECT * FROM trainings WHERE ID = '$tID'");
$trainingData = $trainingQuery->fetch_all(MYSQLI_ASSOC);

foreach ($trainingData as $r) {
    $CourseID = utilCourse($r['CourseID']);
    $BatchNo = $r['BatchNo'];
    $Remarks = $r['Remarks'];
    $TrainingDate = trainingDateFormat($r['StartDate'], $r['EndDate']);
    $SubjectID = utilSubjects($r['SubjectID']);
    $TrainerID = utilTrainers($r['TrainerID']);
    $StatusID = spanBadge(utilTrainingStatus($r['StatusID']));
}
?>

<div class="my-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page"><a class="text-muted" href="index.php">All Trainings</a></li>
            <li class="breadcrumb-item" aria-current="page" onclick="view(<?= $tID ?>)">Training</li>
            <li class="breadcrumb-item" aria-current="page"><strong class="">Files</strong></li>
        </ol>
    </nav>
</div>

<div class="bg-white py-3 px-4">
    <div class="row">
        <div class="col-md-8">
            <h5><?= $CourseID ?> Batch <?= $BatchNo ?></h5>
        </div>
        <div class="col-md-4 text-end">
            <p><?= $StatusID ?></p>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-6">
            <p class="m-0"><strong>Date:</strong></p>
            <p><?= $TrainingDate ?></p>
            <p class="m-0"><strong>Trainer/s:</strong></p>
            <p><?= $TrainerID ?></p>
            <p class="m-0"><strong>Remarks:</strong></p>
            <p><?= $Remarks ?></p>
        </div>
        <div class="col-md-6">
            <p class="m-0"><strong>Subject/s:</strong></p>
            <p><?= $SubjectID ?></p>
        </div>
    </div>
</div>
<hr>
<div class="d-flex flex-wrap justify-content-start">

    <div class="w-25 p-2">
        <div class="card" style="width: 18rem;">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
                <h6 class="card-title">Card title</h6>
                <a href="#" class="btn btn-primary"><i class="bi bi-eye-fill"></i></a>
                <a href="#" class="btn btn-outline-primary"><i class="bi bi-download"></i></a>
                <a href="#" class="btn btn-outline-danger"><i class="bi bi-trash-fill"></i></a>
            </div>
        </div>
    </div>
</div>