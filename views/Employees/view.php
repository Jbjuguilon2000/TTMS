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
    $MiddleName = explode(' ', $r['MiddleName']);
    $MI = middleInitials($MiddleName);
    $ExtName = $r['ExtensionName'];
    $Sex = ($r['Sex'] == 'unknown') ? '' : $r['Sex'];
    $Sex = ($Sex == 'M') ? "Male" : (($Sex == 'F') ? "Female" : $Sex);
    $DesignationID = utilDesignationID($r['DesignationID']);
    $SectionID = utilSection($r['SectionID']);
    $DivisionID = utilDivisionID($r['DivisionID']);
    $EmploymentStatusID = utilEmployment($r['EmploymentStatusID']);
    $AppointmentStatusID = utilAppointment($r['AppointmentStatusID']);
}

$selectTraining = $dbTTMS->query("SELECT ResultID, CourseID, StartDate, EndDate, StatusID, BatchNo FROM attendance AS a LEFT JOIN trainings AS t ON a.TrainingID = t.ID WHERE EmployeeID = '$eID'");
?>


<main class="container container-fluid">

    <div class="header mb-3">
        <div class="border-bottom">
            <div>
                <p class="float-end">
                    <span class='badge <?= ($EmploymentStatusID === "Currently Employed") ? "text-bg-success" : "text-bg-secondary" ?>'>
                        <?= $EmploymentStatusID ?>
                    </span>
                </p>
                <p class="text-muted"><?= $EmployeeID ?></p>
                <h1 class="text-uppercase"><?= "$LastName, $FirstName $MI. $ExtName" ?></h1>
                <p>Sex: <strong><?= $Sex ?></strong></p>
                <p>Designation: <strong><?= $DesignationID ?></strong></p>
                <p>Section/Division: <strong><?= "$SectionID / $DivisionID" ?></strong></p>
                <p>Appointment: <strong><?= $AppointmentStatusID ?></strong></p>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover table-stripped">
            <thead>
                <tr>
                    <th>Course</th>
                    <th>Batch</th>
                    <th>Date</th>
                    <th>Result</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($r = $selectTraining->fetch_assoc()) {
                    $ResultID = utilResults($r['ResultID']);
                    $CourseID = $r['CourseID'];
                    $StartDate = $r['StartDate'];
                    $EndDate = $r['EndDate'];
                    $StatusID = utilTrainingStatus($r['StatusID']);
                    $BatchNo = $r['BatchNo'];
                    echo "<tr>
                            <td>$CourseID</td>
                            <td>$BatchNo</td>
                            <td>$StartDate to $EndDate</td>
                            <td>$ResultID</td>
                            <td>$StatusID</td>
                            <td><button class='btn btn-primary btn-sm'>View</button></td>
                        </tr>";
                }
                ?>

            </tbody>
        </table>
    </div>

</main>