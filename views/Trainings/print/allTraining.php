<?php

require(dirname(dirname(dirname(__DIR__))) . '/Database.php');
require(dirname(dirname(dirname(__DIR__))) . '/Functions.php');

$search_course = $_POST['course'];
$search_batch = $_POST['batch'];
$search_trainer = $_POST['trainer'];
$search_status = $_POST['status'];
$start_date = $_POST['startDate'];
$end_date = $_POST['endDate'];

$trnQuery = "SELECT * FROM trainings ";

if ($search_course != '') {
    $trnQuery .= " WHERE CourseID = '$search_course' ";
}

if ($search_batch != '') {
    $separator = ($search_course != '') ? " AND " : " WHERE ";
    $trnQuery .= $separator . " BatchNo = '$search_batch' ";
}

if ($search_trainer != '') {
    $separator = ($search_course || $search_batch) ? " AND " : " WHERE ";
    $trnQuery .= $separator . " TrainerID LIKE '%$search_trainer%' ";
}

if ($search_status != '') {
    $separator = ($search_course || $search_batch || $search_trainer) ? " AND " : " WHERE ";
    $trnQuery .= $separator . " StatusID = '$search_status' ";
}

if ($start_date != "") {
    if ($end_date == '') {
        $end_date = date("Y-m-d", strtotime("last day of this month"));
    }
    $separator = ($search_course || $search_batch || $search_trainer || $search_status) ? " AND " : " WHERE ";
    $trnQuery .= $separator . " (StartDate BETWEEN '$start_date' AND '$end_date') ";
}

$trnQuery .= "  ORDER BY `StartDate` ASC";

$trainingQuery = $dbTTMS->query($trnQuery);

$attendanceQuery = $dbTTMS->query("SELECT COUNT(EmployeeID) AS Trainees, TrainingID FROM attendance GROUP BY TrainingID");
while ($r = $attendanceQuery->fetch_assoc()) {
    $fetchTrainees[$r['TrainingID']] = $r['Trainees'];
}

$attendanceQuery2 = $dbTTMS->query("SELECT COUNT(EmployeeID) AS Passers, TrainingID FROM attendance WHERE ResultID = 1 GROUP BY TrainingID");
while ($r = $attendanceQuery2->fetch_assoc()) {
    $fetchPassers[$r['TrainingID']] = $r['Passers'];
}

$Trainings = array();
$count = 1;
while ($r = $trainingQuery->fetch_assoc()) {
    $ID = $r['ID'];
    $Trainees = (isset($fetchTrainees[$ID])) ? $fetchTrainees[$ID] : 0;
    $Passers = (isset($fetchPassers[$ID])) ? $fetchPassers[$ID] : 0;
    $CourseID = utilCourse($r['CourseID']);
    $BatchNo = $r['BatchNo'];
    $Remarks = $r['Remarks'];
    $SubjectID = utilSubjects($r['SubjectID']);
    $TrainerID = trainerMapping($r['TrainerID']);
    $TrainingDate = trainingDateFormat($r['StartDate'], $r['EndDate']);
    $StatusID = utilTrainingStatus($r['StatusID']);
    if (isset($r['StartDate']) && $r['StartDate'] !== null) {
        $StartDate[] = $r['StartDate'];
    }
    if (isset($r['EndDate']) && $r['EndDate'] !== null) {
        $EndDate[] = $r['EndDate'];
    }
    $Trainings[] = "<tr>
            <td class='align-middle text-center'>$count</td>
            <td class='align-middle'>$CourseID<br><span class='text-muted'>$TrainingDate</span></td>
            <td class='align-middle text-center'>$BatchNo</td>
            <td class='align-middle'>$SubjectID</td>
            <td class='align-middle'>$TrainerID</td>
            <td class='align-middle text-center'>$Trainees</td>
            <td class='align-middle text-center'>$Passers</td>
            <td class='align-middle text-center'>$StatusID</td>
        </tr>";
    $count++;
}
$edCount = count($EndDate);
$TrainingDates = trainingDateFormat($StartDate[0], $EndDate[$edCount - 1]);

?>

<style>
    @page {
        size: landscape;
        margin: .5in;
    }

    .table-title {
        font-size: 12pt;
    }

    .table-sub-title {
        font-size: 10pt;
    }
</style>

<div class="text-center mb-3">
    <p class="m-0 table-title"><strong>Technical Trainings</strong></p>
    <p class="m-0 table-sub-title"><?= $TrainingDates ?></p>
</div>

<table class="table print-table">
    <thead class="sticky-top">
        <tr>
            <th class="align-middle col-1 text-center">#</th>
            <th class="align-middle col-2">Course</th>
            <th class="align-middle col-1 text-center">Batch</th>
            <th class="align-middle col-3">Subject</th>
            <th class="align-middle col-2">Trainer/s</th>
            <th class="align-middle col-1 text-center">No. of Trainees</th>
            <th class="align-middle col-1 text-center">No. of Passers</th>
            <th class="align-middle col-1 text-center">Status</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($Trainings as $Training) {
            echo $Training;
        }
        ?>
    </tbody>
</table>