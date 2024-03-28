<?php

require(dirname(dirname(__DIR__)) . '/Database.php');
require(dirname(dirname(__DIR__)) . '/Functions.php');


$Limit = 10;
$page = 0;
if (isset($_POST["page"])) {
    $page = $_POST["page"];
} else {
    $page = 1;
}
$start_from = ($page - 1) * $Limit;

$empQuery = "SELECT * FROM employee ORDER BY `LastName` ASC";


$total_records = mysqli_num_rows($dbMasterlist->query($empQuery));
$total_pages = ceil($total_records / $Limit);

$empQuery .= " LIMIT $start_from,$Limit";

$employeeQuery = $dbMasterlist->query($empQuery);

?>
<div class="table-responsive mb-3">
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
<?php



if ($total_pages != 1) {

    echo '<div class="d-flex justify-content-end">';
    echo '<div>';
    echo '<ul class="pagination">';
    if ($page > 1) {
        $prev = $page - 1;
        echo '<li class="page-item" id="' . $prev . '">';
        echo '<span class="page-link">Previous</span>';
        echo '</li>';
        echo '<li class="page-item" id="' . 1 . '">';
        echo '<span class="page-link">1</span>';
        echo '</li>';
    } else {
        echo '<li class="disabled">';
        echo '<span class="page-link">Previous</span>';
        echo '</li>';
    }
    if ($page >= 1 && $page <= $total_pages) {
        $max = max(1, $page - 2);
        $min = min($page + 3, $total_pages + 1);
        for (; $max < $min; $max++) {
            $active_page = "";
            if ($max == $page) {
                $active_page = "active";
            }
            echo '<li class="page-item ' . $active_page . '" id="' . $max . '">';
            echo '<span class="page-link">' . $max . '</span>';
            echo '</li>';
        }
    }
    // if ($page < $total_pages) {
    //     $next = $page + 1;
    //     echo '<li class="">';
    //     echo '<span class="page-link">...</span>';
    //     echo '</li>';
    //     echo '<li class="page-item" id="' . $total_pages . '">';
    //     echo '<span class="page-link">' . $total_pages . '</span>';
    //     echo '</li>';
    //     echo '<li class="page-item" id="' . $next . '">';
    //     echo '<span class="page-link">Next</span>';
    //     echo '</li>';
    // } else {
    //     echo '<li class="disabled">';
    //     echo '<span class="page-link">Next</span>';
    //     echo '</li>';
    // }
    echo '</ul>';
    echo '</div>';
    echo '</div>';
}

?>