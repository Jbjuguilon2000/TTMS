<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DOTr-MRT3 | TTMS</title>
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/styles.css" rel="stylesheet">
</head>

<body>

    <?php include('components/nav-bar.php') ?>
    
    <div class="text-center">
        <div class="spinner-border text-primary" role="status" id="loader">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <div id="main"></div>

    <?php include('components/footer.php') ?>

    <script src="./js/bootstrap.bundle.min.js"></script>
    <script src="./js/jquery.min.js"></script>
    <script src="./js/scripts.js"></script>
</body>

</html>