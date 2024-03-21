<header class="border-body mb-3">
    <div class="container container-fluid">
        <h2 class="m-0">Dashboard</h2>
    </div>
</header>

<main class="container container-fluid">

    <div class="dashboard-page">
        <!-- Search form for filtering the data by date -->
        <form id="search-form">
            <div class="d-flex flex-wrap mb-4">
                <div class="d-flex justify-content-evenly ph-width me-2">
                    <div class="me-2 ph-width">
                        <label for="start-date">Start Date</label>
                        <input type="date" id="start-date" min="1999-01-01" value="<?php echo date('Y-01-01'); ?>" class="form-control">
                    </div>
                    <div class="ph-width">
                        <label for="start-date">End Date</label>
                        <input type="date" id="end-date" min="1999-01-01" value="<?php echo date('Y-12-31'); ?>" class="form-control">
                    </div>
                </div>
                <div class="ph-width align-self-end mt-3">
                    <button type="button" onclick="chart1()" class="btn w-100 btn-primary">Search</button>
                </div>
            </div>
        </form>

        <!-- Cards -->
        <div class="row mb-3">
            <div class="col-12 mb-3">
                <div class="d-flex align-items-center justify-content-center">
                    <div class="spinner-border text-primary" role="status" id="cards-loader"></div>
                </div>
                <!-- Cards Display -->
                <div id="cards"></div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-12 col-lg-6 mb-3">
                <!-- Chart 1 -->
                <div class="col-md-6 col-lg-12">
                    <div class="d-flex align-items-center justify-content-center">
                        <div class="spinner-border text-primary" role="status" id="chart2-loader"></div>
                    </div>
                    <!-- Chart Display -->
                    <div id="chart1"></div>
                </div>
            </div>
            <!-- Chart 2 -->
            <div class="col-md-12 col-lg-6 mb-3">
                <div class="d-flex align-items-center justify-content-center">
                    <div class="spinner-border text-primary" role="status" id="chart1-loader"></div>
                </div>
                <!-- Chart Display -->
                <div id="chart2"></div>
            </div>
        </div>

    </div>

</main>
<div class="h-25 mb-3">&nbsp;</div>

<script src="./js/dashboard-scripts.js"></script>