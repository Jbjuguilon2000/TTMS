<?php
require(dirname(dirname(dirname(__DIR__))) . '/Database.php');
require(dirname(dirname(dirname(__DIR__))) . '/Functions.php');

$eID = $_POST['ID'];

$Employee = $dbMasterlist->query("SELECT * FROM employee WHERE ID = '$eID'");
$employeeDetails = $Employee->fetch_all(MYSQLI_ASSOC);

foreach ($employeeDetails as $r) {
    $LastName = $r['LastName'];
    $FirstName = $r['FirstName'];
    $MI = middleInitials($r['MiddleName']);
    $ExtName = $r['ExtensionName'];
    $Sex = ($r['Sex'] == 'unknown') ? '' : $r['Sex'];
    $Sex = ($Sex == 'M') ? "Mr." : (($Sex == 'F') ? "Ms." : $Sex);
}

$Training = $dbTTMS->query("SELECT ResultID, CourseID, StatusID, TrainerID, StartDate, EndDate, BatchNo 
FROM attendance AS a LEFT JOIN trainings AS t ON a.TrainingID = t.ID WHERE EmployeeID = '$eID' ORDER BY StartDate ASC");

while ($r = $Training->fetch_assoc()) {
    $CourseID = utilCourse($r['CourseID']);
    if (isset($r['StartDate']) && $r['StartDate'] !== null) {
        $StartDate[] = $r['StartDate'];
    }
    if (isset($r['EndDate']) && $r['EndDate'] !== null) {
        $EndDate[] = $r['EndDate'];
    }
    $TrainingDate = trainingDateFormat($r['StartDate'], $r['EndDate']);
    $BatchNo = isset($r['BatchNo']) ? $r['BatchNo'] : 1;
    $Trainings[] = "
    <div class='d-flex' style='gap: 10px;'>
        <div><p>•</p></div>
        <div><p class='m-0'><strong>$CourseID Batch $BatchNo</strong></p><p class='m-0'>$TrainingDate</p></div>
    </div>
    ";
}
$edCount = count($EndDate);

$StarttoLastDate = trainingDateFormat($StartDate[0], $EndDate[$edCount - 1]);
?>

<div class="PrintHeader">
    <div class="d-flex align-items-center">
        <img class="img1" src="Assets/logos/BagongPilipinas.png" alt="">
        <img class="img2" src="Assets/logos/DOTr.png" alt="">
        <div class="mx-4">
            <p class="m-0">Republic of the Philippines</p>
            <p class="m-0"><strong>Department of Transportation - Metro Rail Transit 3</strong></p>
            <p class="m-0"><strong>(DOTr-MRT3)</strong></p>
        </div>
    </div>
    <div class="double-hr"></div>
</div>
<div class="PrintFooter">
    <div class="double-hr"></div>
    <div class="text-center">
        <p class="m-0 text-uppercase"><strong>mrt3 depot, edsa corner north avenue, brgy. bagong pag-asa, quezon city 1105</strong></p>
        <p class="m-0 text-uppercase"><strong>trunkline:8929-5347</strong></p>
    </div>
</div>

<table>
    <thead>
        <tr>
            <th>
                <div class="header-space">&nbsp;</div>
            </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <div class="content mx-5 px-2">
                    <p><?= date("F d, Y") ?></p>
                    <br><br>
                    <p class="text-center"><strong><u>CERTIFICATION</u></strong></p>
                    <p class="text-justify">
                        This certifies that <strong><?= "$Sex $FirstName $MI. $LastName $ExtName" ?></strong>
                        satisfactorily completed and passed the following trainings conducted by the
                        Department of Transportation - Metro Rail Transit 3 (DOTr-MRT3), Support Staff/Computer Section/AFCS Office from <strong><?= $StarttoLastDate ?></strong>.
                    </p>
                    <br>
                    <div class="mx-3">
                        <?php foreach ($Trainings as $value) {
                            echo $value;
                        } ?>
                    </div>
                    <br>
                    <p>This certification is being issued upon the request of <strong><?= "$Sex $LastName" ?></strong> for whatever purpose it may serve.</p>
                    <br><br><br>
                    <p class="m-0"><strong>OFELIA D. ASTRERA</strong></p>
                    <p class="m-0">Chief Transportation Development Officer</p>
                    <p class="m-0">Support Staf/Computer Section/AFCS Office</p>
                </div>
            </td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <td>
                <div class="footer-space">&nbsp;</div>
            </td>
        </tr>
    </tfoot>
</table>