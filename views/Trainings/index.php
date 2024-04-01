<?php
require(dirname(dirname(__DIR__)) . '/Database.php');
require(dirname(dirname(__DIR__)) . '/Functions.php');
?>

<header class="border-body">
    <div class="container container-fluid">
        <h2 class="m-0">Trainings</h2>
    </div>
</header>

<main class="container container-fluid mb-3">

    <div class="training-page">
        <form id="search-form">
            <div class="row g-2 mb-3">
                <div class="col-4 col-md-2">
                    <label for="select-course">Course</label>
                    <select id="select-course" class="form-select">
                        <option selected value=''>-</option>
                        <?php
                        foreach (getAllCourse() as $r) {
                            $ID = $r['ID'];
                            $Course = $r['Course'];
                            echo "<option value='$ID'>$Course</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-2 col-md-1">
                    <label for="search-batch">Batch</label>
                    <input type="number" min="0" id="search-batch" placeholder="-" class="form-control">
                </div>
                <div class="col-3 col-md-2">
                    <label for="select-trainer">Trainer</label>
                    <select id="select-trainer" class="form-select">
                        <option selected value=''>-</option>
                        <?php
                        foreach (getAllTrainers() as $r) {
                            $ID = $r['ID'];
                            $Trainer = $r['Trainer'];
                            echo "<option value='$ID'>$Trainer</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-3 col-md-2">
                    <label for="select-status">Status</label>
                    <select id="select-status" class="form-select">
                        <option selected value=''>-</option>
                        <?php
                        foreach (getAllTrainingStatus() as $r) {
                            $ID = $r['ID'];
                            $Status = $r['Status'];
                            echo "<option value='$ID'>$Status</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-6 col-md-2">
                    <label for="start-date">Start Date</label>
                    <input id="start-date" type="date" class="form-control">
                </div>
                <div class="col-6 col-md-2">
                    <label for="end-date">End Date</label>
                    <input type="date" id="end-date" class="form-control">
                </div>

                <div class="col-12 col-xl-1 col-md-2">
                    <label for="">&nbsp;</label>
                    <button type="button" class="btn w-100 btn-outline-primary" onclick="table()">Search</button>
                </div>
            </div>
        </form>

        <hr>
        <div class="my-3 d-flex justify-content-end">
            <button class="btn btn-primary"><i class="bi bi-plus-lg"></i> Add Training</button>
        </div>

        <div>
            <div class="d-flex align-items-center justify-content-center">
                <div class="spinner-border text-primary" role="status" id="table-loader"></div>
            </div>
            <div id="table"></div>
        </div>


    </div>


</main>
<div class="h-25 mb-3">&nbsp;</div>
<script src="./js/training-scripts.js"></script>