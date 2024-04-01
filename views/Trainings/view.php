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

$attendanceQuery = $dbTTMS->query("SELECT * FROM attendance WHERE TrainingID = '$tID'");
$attendanceData = $attendanceQuery->fetch_all(MYSQLI_ASSOC);

$employeeQuery = $dbMasterlist->query("SELECT * FROM employee");
$employeeData = $employeeQuery->fetch_all(MYSQLI_ASSOC);

foreach ($employeeData as $r) {
    $LastName = $r['LastName'];
    $FirstName = $r['FirstName'];
    $MI = $r['MiddleName'];

}

?>
<div class="my-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Trainings</a></li>
            <li class="breadcrumb-item active" aria-current="page">view</li>
        </ol>
    </nav>
</div>

<div class="rounded shadow py-3 px-4 mb-3">
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
        <div class="col-md-5">
            <p class="m-0"><strong>Date:</strong></p>
            <p><?= $TrainingDate ?></p>
            <p class="m-0"><strong>Trainer/s:</strong></p>
            <p><?= $TrainerID ?></p>
            <p class="m-0"><strong>Remarks:</strong></p>
            <p><?= $Remarks ?></p>
        </div>
        <div class="col-md-5">
            <p class="m-0"><strong>Subject/s:</strong></p>
            <p><?= $SubjectID ?></p>
        </div>

    </div>
</div>
<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Employee ID</th>
                <th>Name</th>
                <th>Designation</th>
                <th>Division</th>
                <th>Group No</th>
                <th>Results</th>
                <th>Remarks</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $Count = 1;
            foreach ($attendanceData as $r) {
                $eID = $r['EmployeeID'];
                $ResultID = spanBadge(utilResults($r['ResultID']));
                $GroupNo = $r['GroupNo'];
                $Remarks = $r['Remarks'];

                echo "<tr>
                    <td class='align-middle'>$Count</td>
                    <td class='align-middle'>$eID</td>
                    <td class='align-middle'>$eID</td>
                    <td class='align-middle'>$eID</td>
                    <td class='align-middle'>$eID</td>
                    <td class='align-middle'>$GroupNo</td>
                    <td class='align-middle'>$ResultID</td>
                    <td class='align-middle'>$Remarks</td>
                    <td class='align-middle'><button class='btn btn-outline-secondary btn-sm'><i class='bi bi-pencil-fill'></i></button></td>
                </tr>";

                $Count++;
            }
            ?>
        </tbody>
    </table>
</div>