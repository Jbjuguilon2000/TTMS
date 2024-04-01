<?php

require(dirname(dirname(__DIR__)) . '/Database.php');
require(dirname(dirname(__DIR__)) . '/Functions.php');

?>

<header class="border-body">
    <div class="container container-fluid">
        <h2 class="m-0">Employees</h2>
    </div>
</header>

<main class="container container-fluid mb-3">

    <div class="employee-page">
        <form id="search-form">
            <div class="row g-2 mb-3">
                <div class="col-4 col-md-2">
                    <label for="search-name">Employee</label>
                    <input type="text" id="search-name" class="form-control" placeholder="-" list="employeeList">
                    <datalist id="employeeList">
                        <?php
                        foreach (getAllEmployee() as $r) {
                            $LastName = $r['LastName'];
                            $FirstName = $r['FirstName'];
                            $employeeName = "$LastName, $FirstName";
                            echo "<option value='$employeeName'>$employeeName</option>";
                        }
                        ?>
                    </datalist>
                </div>
                <div class="col-4 col-md-2">
                    <label for="select-designation">Designation</label>
                    <select id="select-designation" class="form-select">
                        <option selected value=''>-</option>
                        <?php
                        foreach (getAllDesignation() as $r) {
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
                        foreach (getAllDivision() as $r) {
                            $ID = $r['ID'];
                            $Division = $r['Division'];
                            echo "<option value='$ID'>$Division</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-12 col-xl-1 col-md-2">
                    <label for="">&nbsp;</label>
                    <button type="button" class="btn w-100 btn-outline-primary" onclick="table()">Search</button>
                </div>
            </div>
        </form>

        <div>
            <div class="d-flex align-items-center justify-content-center">
                <div class="spinner-border text-primary" role="status" id="table-loader"></div>
            </div>
            <div id="table"></div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="viewEmployeeModal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="viewEmployeeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="viewEmployeeModalLabel">Employee Details</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex align-items-center justify-content-center">
                            <div class="spinner-border text-primary" role="status" id="view-loader"></div>
                        </div>
                        <div id="view"></div>
                        <input type="hidden" id="hiddenID" />
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-printer me-2"></i>Certificate</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<div class="h-25 mb-3">&nbsp;</div>
<script src="./js/employee-scripts.js"></script>