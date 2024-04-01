<?php

// Get Middle Initials
function middleInitials($initialArr)
{
    $initials = '';
    foreach ($initialArr as $name) {
        $initials .= substr($name, 0, 1);
    }
    return $initials;
}

function getAllEmployee()
{
    global $dbMasterlist;
    $selectQuery = $dbMasterlist->query("SELECT * FROM employee");
    $fetchData = $selectQuery->fetch_all(MYSQLI_ASSOC);

    return $fetchData;
}

function getAllDivision()
{
    global $dbMasterlist;
    $selectQuery = $dbMasterlist->query("SELECT * FROM util_division");
    $fetchData = $selectQuery->fetch_all(MYSQLI_ASSOC);

    return $fetchData;
}

function getAllDesignation()
{
    global $dbMasterlist;
    $selectQuery = $dbMasterlist->query("SELECT * FROM util_designation");
    $fetchData = $selectQuery->fetch_all(MYSQLI_ASSOC);

    return $fetchData;
}

function getAllCourse()
{
    global $dbTTMS;
    $selectQuery = $dbTTMS->query("SELECT * FROM util_course");
    $fetchData = $selectQuery->fetch_all(MYSQLI_ASSOC);

    return $fetchData;
}

function getAllSubject()
{
    global $dbTTMS;
    $selectQuery = $dbTTMS->query("SELECT * FROM util_subject");
    $fetchData = $selectQuery->fetch_all(MYSQLI_ASSOC);

    return $fetchData;
}

function getAllTrainers()
{
    global $dbTTMS;
    $selectQuery = $dbTTMS->query("SELECT * FROM util_trainers");
    $fetchData = $selectQuery->fetch_all(MYSQLI_ASSOC);

    return $fetchData;
}
function getAllTrainingResults()
{
    global $dbTTMS;
    $selectQuery = $dbTTMS->query("SELECT * FROM util_results");
    $fetchData = $selectQuery->fetch_all(MYSQLI_ASSOC);

    return $fetchData;
}

function getAllTrainingStatus()
{
    global $dbTTMS;
    $selectQuery = $dbTTMS->query("SELECT * FROM util_status");
    $fetchData = $selectQuery->fetch_all(MYSQLI_ASSOC);

    return $fetchData;
}

function spanBadge($data)
{
    switch ($data) {
        case "Completed":
        case "Currently Employed":
        case "Passed":
            return "<span class='badge rounded-pill text-bg-success'>$data</span>";
        case "Failed":
        case "Cancelled":
            return "<span class='badge rounded-pill text-bg-danger'>$data</span>";
        case "Scheduled":
            return "<span class='badge rounded-pill text-bg-warning'>$data</span>";
        case "Ongoing":
            return "<span class='badge rounded-pill text-bg-primary'>$data</span>";
    }

    return "<span class='badge text-bg-secondary'>$data</span>";
}



// Date Formater
function trainingDateFormat($startDate, $endDate)
{
    if ($startDate == "0000-00-00") {
        return "";
    }

    $startDateTime = date_create($startDate);
    $endDateTime = date_create($endDate);

    if (date_format($startDateTime, 'Y-m-d') == date_format($endDateTime, 'Y-m-d')) {
        return date_format($startDateTime, 'F d, Y');
    }

    if (date_format($startDateTime, 'Y-m') == date_format($endDateTime, 'Y-m')) {
        return date_format($startDateTime, 'F d') . ' - ' . date_format($endDateTime, 'd, Y');
    }

    return date_format($startDateTime, 'F d, Y') . ' to ' . date_format($endDateTime, 'F d, Y');
}

// Get a util value from Division
function utilDivisionID($utilID)
{
    global $dbMasterlist;
    $whereID = '';
    if ($utilID != null) {
        if ($utilID !== 0) {
            $whereID = 'WHERE ID = ' . $utilID;
        }
    }

    $selectQuery = $dbMasterlist->query("SELECT * FROM util_division $whereID");
    $fetchData = $selectQuery->fetch_all(MYSQLI_ASSOC);

    $data = '';

    foreach ($fetchData as $r) {
        if (isset($r)) {
            $data = $r['Division'];
        }
    }

    return $data;
}

// Get a util value from Designation
function utilDesignationID($utilID)
{
    global $dbMasterlist;
    $whereID = '';
    if ($utilID != null) {
        if ($utilID !== 0) {
            $whereID = 'WHERE ID = ' . $utilID;
        }
    }

    $selectQuery = $dbMasterlist->query("SELECT * FROM util_designation $whereID");
    $fetchData = $selectQuery->fetch_all(MYSQLI_ASSOC);

    $data = '';

    foreach ($fetchData as $r) {
        if (isset($r)) {
            $data = $r['Designation'];
        }
    }

    return $data;
}

// Get a util value from Employee Status
function utilEmployment($utilID)
{
    global $dbMasterlist;
    $whereID = '';
    if ($utilID != null) {
        if ($utilID !== 0) {
            $whereID = 'WHERE ID = ' . $utilID;
        }
    }

    $selectQuery = $dbMasterlist->query("SELECT * FROM util_employmentstatus $whereID");
    $fetchData = $selectQuery->fetch_all(MYSQLI_ASSOC);

    $data = '';

    foreach ($fetchData as $r) {
        if (isset($r)) {
            $data = $r['Status'];
        }
    }

    return $data;
}

// Get a util value from Appointment Status
function utilAppointment($utilID)
{
    global $dbMasterlist;
    $whereID = '';
    if ($utilID != null) {
        if ($utilID !== 0) {
            $whereID = 'WHERE ID = ' . $utilID;
        }
    }

    $selectQuery = $dbMasterlist->query("SELECT * FROM util_appointmentstatus $whereID");
    $fetchData = $selectQuery->fetch_all(MYSQLI_ASSOC);

    $data = '';

    foreach ($fetchData as $r) {
        if (isset($r)) {
            $data = $r['Appointment'];
        }
    }

    return $data;
}

// Get a util value from Section/Division
function utilSection($utilID)
{
    global $dbMasterlist;
    $whereID = '';
    if ($utilID != null) {
        if ($utilID !== 0) {
            $whereID = 'WHERE ID = ' . $utilID;
        }
    }

    $selectQuery = $dbMasterlist->query("SELECT * FROM util_section $whereID");
    $fetchData = $selectQuery->fetch_all(MYSQLI_ASSOC);

    $data = '';

    foreach ($fetchData as $r) {
        if (isset($r)) {
            $data = $r['Section'];
        }
    }

    return $data;
}

// Get a util value from Results
function utilResults($utilID)
{
    global $dbTTMS;
    $whereID = '';
    if ($utilID != null) {
        if ($utilID !== 0) {
            $whereID = 'WHERE ID = ' . $utilID;
        }
    }

    $selectQuery = $dbTTMS->query("SELECT * FROM util_results $whereID");
    $fetchData = $selectQuery->fetch_all(MYSQLI_ASSOC);

    $data = '';

    foreach ($fetchData as $r) {
        if (isset($r)) {
            $data = $r['Results'];
        }
    }

    return $data;
}

// Get a util value from Results
function utilTrainingStatus($utilID)
{
    global $dbTTMS;
    $whereID = '';
    if ($utilID != null) {
        if ($utilID !== 0) {
            $whereID = 'WHERE ID = ' . $utilID;
        }
    }

    $selectQuery = $dbTTMS->query("SELECT * FROM `util_status` $whereID");
    $fetchData = $selectQuery->fetch_all(MYSQLI_ASSOC);

    $data = '';

    foreach ($fetchData as $r) {
        if (isset($r)) {
            $data = $r['Status'];
        }
    }

    return $data;
}

// Get a util value from Results
function utilCourse($utilID)
{
    global $dbTTMS;
    $whereID = '';
    if ($utilID != null) {
        if ($utilID !== 0) {
            $whereID = 'WHERE ID = ' . $utilID;
        }
    }

    $selectQuery = $dbTTMS->query("SELECT * FROM `util_course` $whereID");
    $fetchData = $selectQuery->fetch_all(MYSQLI_ASSOC);

    $data = '';

    foreach ($fetchData as $r) {
        if (isset($r)) {
            $data = $r['Course'];
        }
    }

    return $data;
}

function utilTrainers($utilID)
{
    global $dbTTMS;

    if ($utilID !== null) {
        $trainers = explode(',', $utilID);

        $selectQuery = $dbTTMS->query("SELECT * FROM `util_trainers`");
        $fetchData = $selectQuery->fetch_all(MYSQLI_ASSOC);

        $trainerMap = array_column($fetchData, 'Trainer', 'ID');

        $trainerResult = array_map(function ($value) use ($trainerMap) {
            return $trainerMap[$value] ?? $value;
        }, $trainers);

        return implode("<br>", $trainerResult);
    }
}

function utilSubjects($utilID)
{
    global $dbTTMS;

    if ($utilID !== null) {
        $explodeData = explode(',', $utilID);

        $selectQuery = $dbTTMS->query("SELECT * FROM `util_subject`");
        $fetchData = $selectQuery->fetch_all(MYSQLI_ASSOC);

        $dataMap = array_column($fetchData, 'Subject', 'ID');

        $result = array_map(function ($value) use ($dataMap) {
            return $dataMap[$value] ?? $value;
        }, $explodeData);

        return "• ".implode("<br>• ", $result);
    }
}
