<?php

require(dirname(dirname(__DIR__)) . '/Database.php');
require(dirname(dirname(__DIR__)) . '/Functions.php');

$employeeQuery = $dbMasterlist->query("SELECT * FROM employee ORDER BY `LastName` ASC LIMIT 10");

?>
<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <th class="text-center">Employee ID</th>
            <th>Name</th>
            <th class="text-center">Sex</th>
            <th>Designation</th>
            <th>Division</th>
            <th class="text-center">Action</th>
        </thead>
        <tbody>

            <?php
            while ($r = $employeeQuery->fetch_assoc()) {
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
                        <td class='text-center'>$EmployeeID</td>
                        <td>$LastName, $FirstName ($MI) $ExtName</td>
                        <td class='text-center'>$Sex</td>
                        <td>$DesignationID</td>
                        <td>$DivisionID</td>
                        <td class='text-center'><button class='btn btn-sm btn-primary'>View</button></td>
                    </tr>";
            }
            ?>

        </tbody>
    </table>
</div>