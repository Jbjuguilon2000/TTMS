<?php include('Database.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DOTr-MRT3 | TTMS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/styles.css" rel="stylesheet">
</head>

<body>
    <div id="Printer"></div>
    <div class=" d-print-none">
        <?php include('components/nav-bar.php') ?>
        <div class="text-center">
            <div class="spinner-border text-primary" role="status" id="loader">
            </div>
        </div>
        <div id="main"></div>
        <?php include('components/copyright.php') ?>
    </div>

    <script src="./js/bootstrap.bundle.min.js"></script>
    <script src="./js/jquery.min.js"></script>
    <script src="./js/chart.js"></script>
    <script src="./js/scripts.js"></script>
</body>

</html>