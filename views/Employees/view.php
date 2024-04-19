<?php
require(dirname(dirname(__DIR__)) . '/Database.php');
require(dirname(dirname(__DIR__)) . '/Functions.php');

$eID = $_POST['ID'];

$selectEmployee = $dbMasterlist->query("SELECT * FROM employee WHERE ID = '$eID'");
$employeeDetails = $selectEmployee->fetch_all(MYSQLI_ASSOC);

foreach ($employeeDetails as $r) {
    $EmployeeID = $r['EmployeeID'];
    $LastName = $r['LastName'];
    $FirstName = $r['FirstName'];
    $MI = middleInitials($r['MiddleName']);
    $ExtName = $r['ExtensionName'];
    $Sex = ($r['Sex'] == 'unknown') ? '' : $r['Sex'];
    $Sex = ($Sex == 'M') ? "Male" : (($Sex == 'F') ? "Female" : $Sex);
    $DesignationID = utilDesignationID($r['DesignationID']);
    $SectionID = utilSection($r['SectionID']);
    $DivisionID = utilDivisionID($r['DivisionID']);
    $EmploymentStatusID = spanBadge(utilEmployment($r['EmploymentStatusID']));
    $AppointmentStatusID = utilAppointment($r['AppointmentStatusID']);
}

$selectTraining = $dbTTMS->query("SELECT ResultID, CourseID, StatusID, TrainerID, StartDate, EndDate, BatchNo FROM attendance AS a LEFT JOIN trainings AS t ON a.TrainingID = t.ID WHERE EmployeeID = '$eID'");
?>


<main class="container container-fluid">

    <div class="header mb-3">
        <div>
            <p class="float-end"><?= $EmploymentStatusID ?></p>
            <p class="text-muted"><?= $EmployeeID ?></p>
            <h1 class="text-uppercase"><?= "$LastName, $FirstName $MI. $ExtName" ?></h1>
            <p>Sex: <strong><?= $Sex ?></strong></p>
            <p>Designation: <strong><?= $DesignationID ?></strong></p>
            <p>Section/Division: <strong><?= "$SectionID / $DivisionID" ?></strong></p>
            <p>Appointment: <strong><?= $AppointmentStatusID ?></strong></p>
        </div>
    </div>
    <hr>
    <div class="table-responsive">
        <table class="table table-hover table-stripped">
            <thead>
                <tr>
                    <th>Course</th>
                    <th class="text-center">Batch</th>
                    <th>Trainer/s</th>
                    <th class="text-center">Result</th>
                    <th class="text-center">Training Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($r = $selectTraining->fetch_assoc()) {
                    $CourseID = utilCourse($r['CourseID']);
                    $TrainerID = trainerMapping($r['TrainerID']);
                    $TrainingDate = trainingDateFormat($r['StartDate'], $r['EndDate']);
                    $ResultID = spanBadge(utilResults($r['ResultID']));
                    $StatusID = spanBadge(utilTrainingStatus($r['StatusID']));
                    $BatchNo = $r['BatchNo'];
                    echo "<tr>
                            <td class='align-middle'>$CourseID<br><span class='text-muted'>$TrainingDate</span></td>
                            <td class='text-center align-middle'>$BatchNo</td>
                            <td class='align-middle'>$TrainerID</td>
                            <td class='text-center align-middle'>$ResultID</td>
                            <td class='text-center align-middle'>$StatusID</td>
                        </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</main>