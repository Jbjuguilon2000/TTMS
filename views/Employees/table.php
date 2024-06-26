<?php

require(dirname(dirname(__DIR__)) . '/Database.php');
require(dirname(dirname(__DIR__)) . '/Functions.php');
require(dirname(dirname(__DIR__)) . '/components/set_page_limit.php');

$search_name = $_POST['name'];
$search_designation = $_POST['designation'];
$search_division = $_POST['division'];

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
<div class="table-responsive mb-3" style="max-height: 600px; overflow-y:auto;">
    <table class="table table-hover">
        <thead class="sticky-top">
            <tr>
                <th class="col-1">Employee ID</th>
                <th class="col-3 ">Name</th>
                <th class="col-1 text-center">Sex</th>
                <th class="col-4 ">Designation</th>
                <th class="col-2 ">Division</th>
                <th class="col-1 text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($r = $employeeQuery->fetch_assoc()) {
                $ID = $r['ID'];
                $EmployeeID = $r['EmployeeID'];
                $LastName = $r['LastName'];
                $FirstName = $r['FirstName'];
                $ExtName = $r['ExtensionName'];
                $MI = middleInitials($r['MiddleName']);
                $Sex = ($r['Sex'] == 'unknown') ? '' : $r['Sex'];
                $DesignationID = utilDesignationID($r['DesignationID']);
                $DivisionID = utilDivisionID($r['DivisionID']);

                echo "<tr>
                        <td class='align-middle'>$EmployeeID</td>
                        <td class='align-middle'>$LastName, $FirstName ($MI) $ExtName</td>
                        <td class='align-middle text-center'>$Sex</td>
                        <td class='align-middle'>$DesignationID</td>
                        <td class='align-middle'>$DivisionID</td>
                        <td class='align-middle text-center' colspan='4'>
                        <button type='button' class='btn btn-outline-primary btn-sm' data-bs-toggle='modal' onclick='view($ID)' data-bs-target='#viewEmployeeModal'>
                        <i class='bi bi-eye-fill'></i>
                        </button></td>
                    </tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php require(dirname(dirname(__DIR__)) . '/components/pagination.php') ?>