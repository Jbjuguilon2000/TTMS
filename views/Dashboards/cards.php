<?php

require(dirname(dirname(__DIR__)) . '/Database.php');

$utilStatusQuery = $dbTTMS->query("SELECT * FROM util_Status");
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



<div class="row row-cols-md-2 g-3">
    <?php
    foreach ($Status as $key => $value) {
        $StatusName = $value;
        if (isset($StatusData[$key])) {
            $StatusCount = $StatusData[$key];
        } else {
            $StatusCount = 0;
        }
        $color = $colors[$key];
        echo "<div class='col-6 col-sm-6'>";
        echo "<div class='card border-0'>";
        echo "<div class='card-body'>";
        echo "<h3 class='m-0'>$StatusCount</h3>";
        echo "<h5 class='m-0'>$StatusName</h5>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }
    ?>
</div>