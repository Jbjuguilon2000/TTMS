<?php

require(dirname(dirname(__DIR__)) . '/Database.php');

$utilStatusQuery = $dbTTMS->query("SELECT * FROM util_status");
$utilStatus = $utilStatusQuery->fetch_all(MYSQLI_ASSOC);
foreach ($utilStatus as $r) {
    $Status[$r['ID']] = $r['Status'];
}

// FilterDates
$StartDate = $_POST['StartDate'];
$EndDate = $_POST['EndDate'];

$trainingsQuery = $dbTTMS->query("SELECT StatusID, COUNT(StatusID) AS StatusCount FROM trainings WHERE (`StartDate` BETWEEN '$StartDate' AND '$EndDate') GROUP BY StatusID");
$trainingsAll = $trainingsQuery->fetch_all(MYSQLI_ASSOC);

foreach ($trainingsAll as $r) {
    $StatusData[$r['StatusID']] = $r['StatusCount'];
}

$colors = [
    '1' => '#06d6a0',
    '2' => '#118ab2',
    '3' => '#ffd166',
    '4' => '#ef476f'
];
?>

<style>
    .statsindicator {
        height: 30px;
        width: 30px;
        border-radius: 99px;
        position: absolute;
        top: -5px;
        right: 10%;
    }


    .card-hoverstyle {
        transition: transform 0.3s;
    }

    .card-hoverstyle:hover {
        transform: scale(1.07);
    }
</style>

<div class="row row-cols-lg-4 row-cols-md-2 g-3">
    <?php
    foreach ($Status as $key => $value) {
        $StatusName = $value;
        if (isset($StatusData[$key])) {
            $StatusCount = $StatusData[$key];
        } else {
            $StatusCount = 0;
        }
        $color = $colors[$key];
        echo "<div class='col-6 col-lg-3'>";
        echo "<div class='card-hoverstyle card border-0 shadow-sm rounded-5'>";
        echo "<div class='card-body'>";
        echo "<div class='statsindicator' style='background-color: $color;'>";
        echo "</div>";
        echo "<h3 class='m-0'>$StatusCount</h3>";
        echo "<h5 class='m-0 text-muted'>$StatusName</h5>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }
    ?>
</div>