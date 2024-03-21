<?php
require(dirname(dirname(__DIR__)) . '/Database.php');

// FilterDates
$StartDate = $_POST['StartDate'];
$EndDate = $_POST['EndDate'];

$utilCourseQuery = $dbTTMS->query("SELECT * FROM util_course");
$utilCourses = $utilCourseQuery->fetch_all(MYSQLI_ASSOC);

foreach ($utilCourses as $uc) {
    $uCourse[$uc['ID']] = $uc['Course'];
}

$trainingsQuery = $dbTTMS->query("SELECT CourseID ,COUNT(CourseID) AS CourseCount FROM trainings WHERE (`StartDate` BETWEEN '$StartDate' AND '$EndDate') AND `StatusID` = 1 GROUP BY CourseID");
$trainingsAll = $trainingsQuery->fetch_all(MYSQLI_ASSOC);

foreach ($trainingsAll as $training) {
    $Courses[$training['CourseID']] = $training['CourseCount'];
}

foreach ($Courses as $key => $value) {
    $CourseCounts[] = $value;
    if (isset($uCourse[$key])) {
        $Course[] = $uCourse[$key];
    }
}


?>
<style>
    .chart2-container {
        height: 300px;
        width: 100%;
    }
</style>

<div class="mb-3">
    <h3 class="m-0">Courses</h3>
    <p class="text-muted m-0">Chart shows the frequency of courses conducted. </p>
</div>
<div class="chart2-container">
    <canvas id="myChart2"></canvas>
</div>

<script>
    // setup 
    var data = {
        labels: <?php echo json_encode($Course) ?>,
        datasets: [{
            label: 'Conducted',
            data: <?php echo json_encode($CourseCounts) ?>,
            backgroundColor: [
                '#06d6a0',
                '#118ab2',
                '#ffd166',
                '#ef476f',
                '#073b4c',
            ],

            borderWidth: 1
        }]
    };

    // config 
    var Chart2config = {
        type: 'doughnut',
        data,
        options: {
            indexAxis: 'y',
            maintainAspectRatio: false,
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom',
                    align: 'start',
                },
            }
        }
    };

    // render init block
    var myChart2 = new Chart(
        document.getElementById('myChart2'),
        Chart2config
    );
</script>