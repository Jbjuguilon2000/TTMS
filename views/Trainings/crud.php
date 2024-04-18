<?php

require(dirname(dirname(__DIR__)) . '/Database.php');

if (isset($_POST['create'])) {

    $course = $_POST['course'];
    $batch = $_POST['batch'];
    $subjects = $_POST['subjects'];
    $startdate = $_POST['startdate'];
    $enddate = $_POST['enddate'];
    $status = $_POST['status'];
    $trainers = $_POST['trainers'];
    $divisions = $_POST['divisions'];
    $remarks = $dbTTMS->real_escape_string($_POST['remarks']);

    $query = $dbTTMS->query("INSERT INTO `trainings` (CourseID, BatchNo, SubjectID, StartDate, EndDate, StatusID, TrainerID, DivisionID, Remarks) 
        VALUES ('$course','$batch','$subjects','$startdate','$enddate','$status','$trainers','$divisions','$remarks')");

    if ($query) {
        echo "<span class='feedback-design'>Training Created</span>";
    } else {
        echo "failed" . $dbTTMS->error;
    }
}

if (isset($_POST['read'])) {

    $ID = $_POST['ID'];

    $query = $dbTTMS->query("SELECT * FROM trainings WHERE ID = '$ID'");
    $fetchData = $query->fetch_all(MYSQLI_ASSOC);

    echo json_encode($fetchData);
}

if (isset($_POST['update'])) {

    $id = $_POST['id'];
    $course = $_POST['course'];
    $batch = $_POST['batch'];
    $subjects = $_POST['subjects'];
    $startdate = $_POST['startdate'];
    $enddate = $_POST['enddate'];
    $status = $_POST['status'];
    $trainers = $_POST['trainers'];
    $divisions = $_POST['divisions'];
    $remarks = $_POST['remarks'];

    $query = $dbTTMS->query("UPDATE `trainings` SET `CourseID`='$course', `BatchNo`='$batch', `StartDate`='$startdate', `EndDate`='$enddate', 
    `TrainerID`='$trainers', `StatusID`='$status', `DivisionID`='$divisions', `SubjectID`='$subjects', `Remarks`='$remarks' WHERE ID = '$id'");

    if ($query) {
        echo "<span class='feedback-design'>Training Updated</span>";
    } else {
        echo "failed" . $dbTTMS->error;
    }
}

if (isset($_POST['delete'])) {
}
