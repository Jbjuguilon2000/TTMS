<?php

require(dirname(dirname(__DIR__)) . '/Database.php');
require(dirname(dirname(__DIR__)) . '/Functions.php');
require(dirname(dirname(__DIR__)) . '/components/set_page_limit.php');

$search_name = $_POST['name'];
$search_designation = $_POST['designation'];
$search_division = $_POST['division'];


$empQuery = "SELECT * FROM employee";

if ($search_name != '') {
    $empQuery .= " WHERE CONCAT(Lastname, ', ', Firstname, ' ', ExtensionName, ' ', MiddleName, '.') LIKE '%$search_name%' ";
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

                echo "<tr>
                        <td class='align-middle text-center'>$EmployeeID</td>
                        <td class='align-middle'>$LastName, $FirstName ($MI) $ExtName</td>
                        <td class='align-middle text-center'>$Sex</td>
                        <td class='align-middle'>$DesignationID</td>
                        <td class='align-middle'>$DivisionID</td>
                        <td class='align-middle text-center'>
                        <button type='button' class='btn btn-primary btn-sm' data-bs-toggle='modal' onclick='view($ID)' data-bs-target='#viewEmployeeModal'>
                        <i class='bi bi-eye-fill'></i>
                        </button></td>
                    </tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php require(dirname(dirname(__DIR__)) . '/components/pagination.php') ?>