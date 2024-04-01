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

$employeeQuery = $dbMasterlist->query("SELECT * FROM employee");
$employeeData = $employeeQuery->fetch_all(MYSQLI_ASSOC);

foreach ($employeeData as $r) {
    $LastName = $r['LastName'];
    $FirstName = $r['FirstName'];
    $MI = middleInitials($r['MiddleName']);
    $NameExt = $r['ExtensionName'];
    $FullName[$r['ID']] = "$LastName, $FirstName $MI. $NameExt";
    $EmployeeID[$r['ID']] = $r['EmployeeID'];
    $DesignationID[$r['ID']] = $r['DesignationID'];
    $DivisionID[$r['ID']] = $r['DivisionID'];
}

$attendanceQuery = $dbTTMS->query("SELECT * FROM attendance WHERE TrainingID = '$tID'");
$attendanceData = $attendanceQuery->fetch_all(MYSQLI_ASSOC);

$Attendees = array();

foreach ($attendanceData as $r) {
    $Attendee = array(
        'ResultID' => $r['ResultID'],
        'GroupNo' => $r['GroupNo'],
        'Remarks' => $r['Remarks'],
        'Name' => $FullName[$r['EmployeeID']],
        'MRT3ID' => $EmployeeID[$r['EmployeeID']],
        'Designation' => $DesignationID[$r['EmployeeID']],
        'Division' => $DivisionID[$r['EmployeeID']],
    );

    $Attendees[] = $Attendee;
}

// Sort attendees array by FullName
usort($Attendees, function ($a, $b) {
    if ($a['GroupNo'] == $b['GroupNo']) {
        return strcmp($a['Name'], $b['Name']);
    }
    return $a['GroupNo'] - $b['GroupNo'];
});

?>
<div class="my-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Trainings</a></li>
            <li class="breadcrumb-item active" aria-current="page">view</li>
        </ol>
    </nav>
</div>

<div class="rounded border border-5 py-3 px-4">
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
<hr>
<h5>Attendees</h5>
<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th>Employee ID</th>
                <th>Name</th>
                <th>Designation</th>
                <th>Division</th>
                <th class="text-center">Group No</th>
                <th class="text-center">Results</th>
                <th>Remarks</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($Attendees)) {
                $Count = 1;
                foreach ($Attendees as $r) {
                    $MRT3ID = $r['MRT3ID'];
                    $Name = $r['Name'];
                    $Designation = utilDesignationID($r['Designation']);
                    $Division = utilDivisionID($r['Division']);
                    $GroupNo = $r['GroupNo'];
                    $ResultID = spanBadge(utilResults($r['ResultID']));
                    $Remarks = $r['Remarks'];

                    echo "<tr>
                    <td class='align-middle text-center'>$Count</td>
                    <td class='align-middle'>$MRT3ID</td>
                    <td class='align-middle'>$Name</td>
                    <td class='align-middle'>$Designation</td>
                    <td class='align-middle'>$Division</td>
                    <td class='align-middle text-center'>$GroupNo</td>
                    <td class='align-middle text-center'>$ResultID</td>
                    <td class='align-middle'>$Remarks</td>
                    <td class='align-middle text-center'><button class='btn btn-outline-secondary btn-sm'><i class='bi bi-pencil-fill'></i></button></td>
                    </tr>";

                    $Count++;
                }
            } else {
                echo "<tr>
                    <td class='align-middle'>-</td>
                    <td class='align-middle'>-</td>
                    <td class='align-middle'>-</td>
                    <td class='align-middle'>-</td>
                    <td class='align-middle'>-</td>
                    <td class='align-middle'>-</td>
                    <td class='align-middle'>-</td>
                    <td class='align-middle'>-</td>
                    <td class='align-middle'>-</td>
                    </tr>";
            }
            ?>
        </tbody>
    </table>
</div>