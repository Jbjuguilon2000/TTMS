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
            <div class="d-flex flex-wrap mb-4">
                <div class="d-flex justify-content-evenly ph-width me-2">
                    <div class="me-2 ph-width">
                        <label for="search-name">Search</label>
                        <input type="text" id="search-name" class="form-control">
                    </div>
                    <div class="me-2 ph-width">
                        <label for="search-designation">Designation</label>
                        <select name="" class="form-select" id="search-designation">
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
                    <div class="ph-width">
                        <label for="search-division">Division</label>
                        <select name="" class="form-select" id="search-division">
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
                </div>
                <div class="ph-width align-self-end mt-3">
                    <button type="button" onclick="chart1()" class="btn w-100 btn-primary">Search</button>
                </div>
            </div>
        </form>
    </div>

</main>