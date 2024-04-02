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
    $TrainersID = trainerMapping($r['TrainerID']);
    $DivisionsID = divisionMapping($r['DivisionID']);
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
        'Name' => (isset($FullName[$r['EmployeeID']])) ? $FullName[$r['EmployeeID']] : '',
        'MRT3ID' => (isset($EmployeeID[$r['EmployeeID']])) ? $EmployeeID[$r['EmployeeID']] : '',
        'Designation' => (isset($DesignationID[$r['EmployeeID']])) ? $DesignationID[$r['EmployeeID']] : '0',
        'Division' => (isset($DivisionID[$r['EmployeeID']])) ? $DivisionID[$r['EmployeeID']] : '0',
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
<div class="my-3 d-flex justify-content-between">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="text-muted" href="index.php">All Trainings</a></li>
                <li class="breadcrumb-item active" aria-current="page"><strong>Training</strong></li>
            </ol>
        </nav>
    </div>
    <div>
        <button class="btn btn-outline-secondary" onclick="files(<?= $tID ?>)"><i class="bi bi-folder-fill h6 align-middle me-1"></i> Files</button>
    </div>
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
            <p><?= $TrainersID ?></p>
            <p class="m-0"><strong>Division:</strong></p>
            <p><?= $DivisionsID ?></p>
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
<div class="mb-3 d-flex justify-content-between align-items-center">
    <h3>Attendee List</h3>
    <div class="d-flex">
        <div class="dropdown">
            <button class="btn btn-link text-muted dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-printer-fill h5 align-middle"></i> Print
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Memorandum</a></li>
                <li><a class="dropdown-item" href="#">List of Attendees</a></li>
                <li><a class="dropdown-item" href="#">Completion Report</a></li>
                <li><a class="dropdown-item" href="#">Certificate <span class="text-muted">(Refresher)</span></a></li>
                <li><a class="dropdown-item" href="#">Certificate <span class="text-muted">(w/ Subjects)</span></a></li>
                <li><a class="dropdown-item" href="#">Certificate <span class="text-muted">(w/o Subject)</span></a></li>
            </ul>
            <button class="btn btn-sm btn-primary"><i class="bi bi-plus-lg"></i> Add Attendees</button>
        </div>
    </div>
</div>
<div class="table-responsive ">
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

            if (isset($Attendee)) {
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
                <td class='align-middle text-center'>-</td>
                <td class='align-middle'>-</td>
                <td class='align-middle'>-</td>
                <td class='align-middle'>-</td>
                <td class='align-middle'>-</td>
                <td class='align-middle text-center'>-</td>
                <td class='align-middle text-center'>-</td>
                <td class='align-middle'>-</td>
                <td class='align-middle text-center'><button class='btn btn-outline-secondary btn-sm'><i class='bi bi-pencil-fill'></i></button></td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
</div>