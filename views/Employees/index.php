<?php

require(dirname(dirname(__DIR__)) . '/Database.php');

$divisionQuery = $dbMasterlist->query("SELECT * FROM util_division");
$divisionAll = $divisionQuery->fetch_all(MYSQLI_ASSOC);

$designationQuery = $dbMasterlist->query("SELECT * FROM util_designation");
$designationAll = $designationQuery->fetch_all(MYSQLI_ASSOC);

?>

<header class="border-body">
    <div class="container container-fluid">
        <h2 class="m-0">Employees</h2>
    </div>
</header>

<main class="container container-fluid">

    <div class="employee-page">
        <form id="search-form">
            <div class="row g-2 mb-3">
                <div class="col-4 col-md-2">
                    <label for="search-name">Employee</label>
                    <input type="text" id="search-name" class="form-control" placeholder="-">
                </div>
                <div class="col-4 col-md-2">
                    <label for="select-designation">Designation</label>
                    <select id="select-designation" class="form-select">
                        <option selected value=''>-</option>
                        <?php
                        foreach ($designationAll as $r) {
                            $ID = $r['ID'];
                            $Designation = $r['Designation'];
                            echo "<option value='$ID'>$Designation</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-4 col-md-2">
                    <label for="select-division">Division</label>
                    <select id="select-division" class="form-select">
                        <option selected value=''>-</option>
                        <?php
                        foreach ($divisionAll as $r) {
                            $ID = $r['ID'];
                            $Division = $r['Division'];
                            echo "<option value='$ID'>$Division</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-12 col-xl-1 col-md-2">
                    <label for="">&nbsp;</label>
                    <button class="btn w-100 btn-primary">Search</button>
                </div>
            </div>
        </form>

        <div>
            <div class="d-flex align-items-center justify-content-center">
                <div class="spinner-border text-primary" role="status" id="table-loader"></div>
            </div>
            <div id="table"></div>
        </div>

    </div>
</main>
<div class="h-25 mb-3">&nbsp;</div>
<script src="./js/employee-scripts.js"></script>