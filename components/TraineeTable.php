<?php

require(dirname(__DIR__) . "/Database.php");
require(dirname(__DIR__) . "/Functions.php");
require('set_page_limit.php');

$search_name = $_POST['search'];
$search_designation = $_POST['division'];
$search_division = $_POST['designation'];

$empQuery = "SELECT * FROM employee";

if ($search_name != '') {
    $empQuery .= " WHERE CONCAT(LastName, ', ', FirstName, ' ', ExtensionName, ' ', MiddleName, '.') LIKE '%$search_name%' ";
}

if ($search_designation != '') {
    $separator = ($search_name != '') ? " AND " : " WHERE ";
    $empQuery .= $separator . " DesignationID = '$search_designation' ";
}

if ($search_division != '') {
    $separator = ($search_name || $search_designation) ? " AND " : " WHERE ";
    $empQuery .= $separator . " DivisionID = '$search_division' ";
}

$total_records = mysqli_num_rows($dbMasterlist->query($empQuery));
$total_pages = ceil($total_records / $Limit);

$empQuery .= "  ORDER BY `LastName` ASC LIMIT $start_from,$Limit";

$employeeQuery = $dbMasterlist->query($empQuery);

?>

<table class="table table-hover">
    <thead>
        <tr>
            <th class="col-1">#</th>
            <th class="col-2">Employee ID</th>
            <th class="col-3">Name</th>
            <th class="col-3">Designation</th>
            <th class="col-2">Division</th>
            <th class="col-1">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $count = 1;
        while ($r = $employeeQuery->fetch_assoc()) {
            $ID = $r['ID'];
            $EmployeeID = $r['EmployeeID'];
            $LastName = $r['LastName'];
            $FirstName = $r['FirstName'];
            $ExtName = $r['ExtensionName'];
            $MI = middleInitials($r['MiddleName']);
            $DesignationID = utilDesignationID($r['DesignationID']);
            $DivisionID = utilDivisionID($r['DivisionID']);

            echo "<tr>
                    <td class='align-middle text-center'>$count</td>
                    <td class='align-middle text-center'>$EmployeeID</td>
                    <td class='align-middle'>$LastName, $FirstName ($MI) $ExtName</td>
                    <td class='align-middle'>$DesignationID</td>
                    <td class='align-middle'>$DivisionID</td>
                    <td class='align-middle text-center'>Add/Delete</td>
                </tr>";
            $count++;
        }
        ?>
    </tbody>

</table>

<?php require('pagination.php') ?>