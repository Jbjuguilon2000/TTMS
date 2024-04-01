<?php

require(dirname(dirname(__DIR__)) . '/Database.php');
require(dirname(dirname(__DIR__)) . '/Functions.php');
require(dirname(dirname(__DIR__)) . '/components/set_page_limit.php');

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


$total_records = mysqli_num_rows($dbTTMS->query($trnQuery));
$total_pages = ceil($total_records / $Limit);

$trnQuery .= "  ORDER BY `StartDate` DESC LIMIT $start_from,$Limit";

$trainingQuery = $dbTTMS->query($trnQuery);

$attendanceQuery = $dbTTMS->query("SELECT COUNT(EmployeeID) AS Trainees, TrainingID FROM attendance GROUP BY TrainingID");
while ($r = $attendanceQuery->fetch_assoc()) {
    $fetchTrainees[$r['TrainingID']] = $r['Trainees'];
}

?>

<div class="table-responsive mb-3" style="max-height: 500px; overflow-y:auto;">
    <table class="table table-hover">
        <thead class="sticky-top">
            <tr>
                <th class="align-middle">Course</th>
                <th class="align-middle text-center">Batch</th>
                <th class="align-middle">Subject</th>
                <th class="align-middle">Trainer/s</th>
                <th class="align-middle text-center">Number of Trainees</th>
                <th class="align-middle text-center">Status</th>
                <th class="align-middle">Remarks</th>
                <th class="align-middle text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($r = $trainingQuery->fetch_assoc()) {
                $ID = $r['ID'];
                $Trainees = (isset($fetchTrainees[$ID])) ? $fetchTrainees[$ID] : 0;
                $CourseID = utilCourse($r['CourseID']);
                $BatchNo = $r['BatchNo'];
                $Remarks = $r['Remarks'];
                $SubjectID = utilSubjects($r['SubjectID']);
                $TrainerID = utilTrainers($r['TrainerID']);
                $TrainingDate = trainingDateFormat($r['StartDate'], $r['EndDate']);
                $StatusID = spanBadge(utilTrainingStatus($r['StatusID']));
                echo "<tr>
                        <td class='align-middle'>$CourseID<br><span class='text-muted'>$TrainingDate</span></td>
                        <td class='align-middle text-center'>$BatchNo</td>
                        <td class='align-middle'>$SubjectID</td>
                        <td class='align-middle'>$TrainerID</td>
                        <td class='align-middle text-center'>$Trainees</td>
                        <td class='align-middle text-center'>$StatusID</td>
                        <td class='align-middle'>$Remarks</td>
                        <td class='align-middle text-center'>
                        <button type='button' class='btn btn-outline-secondary btn-sm'><i class='bi bi-eye-fill'></i></button>
                        <button type='button' class='btn btn-outline-secondary btn-sm'><i class='bi bi-pencil-fill'></i></button>
                        <button type='button' class='btn btn-outline-danger btn-sm'><i class='bi bi-trash-fill'></i></button>
                        </td>
                    </tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php require(dirname(dirname(__DIR__)) . '/components/pagination.php') ?>