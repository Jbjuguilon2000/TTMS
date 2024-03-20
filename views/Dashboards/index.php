<?php
require(dirname(dirname(__DIR__)) . '/Database.php');

$Query = $DBTTMS->query('SELECT * FROM util_trainers WHERE ID');
$UtilTrainers = $Query->fetch_all(MYSQLI_ASSOC);

?>


<header class="bg-white border-body mb-3">
    <div class="container container-fluid">
        <h3 class="m-0">Dashboard</h3>
    </div>
</header>

<main class="container container-fluid">

    <div class="dashboard-page">
        <!-- Search form for filtering the data by date -->
        <form id="search-form">
            <div class="d-flex mb-3">
                <div class="me-3">
                    <label for="start-date">Start Date</label>
                    <input type="date" id="start-date" class="form-control border-bottom">
                </div>
                <div class="me-3">
                    <label for="start-date">End Date</label>
                    <input type="date" id="end-date" class="form-control border-bottom">
                </div>
                <div class="me-3 align-self-end">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>

        <div class="row mb-3">
            <!-- Chart 1 -->
            <div class="col-md-6 mb-3 order-sm-2 order-md-1">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-center">
                            <div class="spinner-border text-primary" role="status" id="chart1-loader"></div>
                        </div>
                        <!-- Chart Display -->
                        <div id="chart1"></div>
                    </div>
                </div>
            </div>


            <div class="col-md-6 mb-3 order-sm-1 order-md-2">
                <div class="row m-0 g-0 mb-3">
                    <div class="col-md-12">
                        <div class="card rounded-0">
                            <div class="card-body">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row m-0 g-0 mb-3">
                    <!-- Chart 2 -->
                    <div class="col-md-12">
                        <div class="card rounded-0">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-center">
                                    <div class="spinner-border text-primary" role="status" id="chart2-loader"></div>
                                </div>
                                <!-- Chart Display -->
                                <div id="chart2"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

</main>
<div class="h-25 mb-3">&nbsp;</div>

<script src="./js/dashboard-scripts.js"></script>