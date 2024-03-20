



<header class="bg-white border-body mb-3">
    <div class="container container-fluid">
        <h3 class="m-0">Dashboard</h3>
    </div>
</header>

<main class="container container-fluid">

    <div class="dashboard-page">
        <!-- Search form for filtering the data by date -->
        <form id="search-form">
            <div class="d-flex flex-wrap mb-3">
                <div class="d-flex justify-content-evenly ph-width me-2">
                    <div class="me-2 ph-width">
                        <label for="start-date">Start Date</label>
                        <input type="date" id="start-date" class="form-control border-bottom">
                    </div>
                    <div class="ph-width">
                        <label for="start-date">End Date</label>
                        <input type="date" id="end-date" class="form-control border-bottom">
                    </div>
                </div>
                <div class="ph-width align-self-end mt-3">
                    <button type="submit" class="btn w-100 btn-primary">Search</button>
                </div>
            </div>
        </form>

        <div class="row mb-3">

            <div class="col-md-12 col-lg-6 mb-3">
                <div class="row row-cols-1">
                    <div class="col-md-6 col-lg-12 mb-3">
                        <div class="card rounded-0">
                            <div class="card-body">
                            </div>
                        </div>
                    </div>
                    <!-- Chart 2 -->
                    <div class="col-md-6 col-lg-12">
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

            <!-- Chart 1 -->
            <div class="col-md-12 col-lg-6 mb-3">
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



        </div>

    </div>

</main>
<div class="h-25 mb-3">&nbsp;</div>

<script src="./js/dashboard-scripts.js"></script>