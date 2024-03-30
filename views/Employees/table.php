<?php

require(dirname(dirname(__DIR__)) . '/Database.php');
require(dirname(dirname(__DIR__)) . '/Functions.php');
require(dirname(dirname(__DIR__)) . '/components/set_page_limit.php');

$empQuery = "SELECT * FROM employee ORDER BY `LastName` ASC";

$total_records = mysqli_num_rows($dbMasterlist->query($empQuery));
$total_pages = ceil($total_records / $Limit);

$empQuery .= " LIMIT $start_from,$Limit";

$employeeQuery = $dbMasterlist->query($empQuery);

?>
<div class="table-responsive mb-3">
    <table class="table table-hover">
        <thead>
            <tr>
                <th class="text-center">Employee ID</th>
                <th>Name</th>
                <th class="text-center">Sex</th>
                <th>Designation</th>
                <th>Division</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($r = $employeeQuery->fetch_assoc()) {
                $ID = $r['ID'];
                $EmployeeID = $r['EmployeeID'];
                $LastName = $r['LastName'];
                $FirstName = $r['FirstName'];
                $MiddleName = explode(' ', $r['MiddleName']);
                $ExtName = $r['ExtensionName'];
                $MI = middleInitials($MiddleName);
                $Sex = ($r['Sex'] == 'unknown') ? '' : $r['Sex'];
                $DesignationID = utilDesignationID($r['DesignationID']);
                $DivisionID = utilDivisionID($r['DivisionID']);
                $AppointmentStatusID = $r['AppointmentStatusID'];

                echo "<tr>
                        <td class='align-middle text-center'>$EmployeeID</td>
                        <td class='align-middle'>$LastName, $FirstName ($MI) $ExtName</td>
                        <td class='align-middle text-center'>$Sex</td>
                        <td class='align-middle'>$DesignationID</td>
                        <td class='align-middle'>$DivisionID</td>
                        <td class='align-middle text-center'>
                        <button type='button' class='btn btn-primary btn-sm' data-bs-toggle='modal' onclick='view($ID)' data-bs-target='#viewEmployeeModal'>
                        View
                        </button></td>
                    </tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php require(dirname(dirname(__DIR__)) . '/components/pagination.php') ?>
