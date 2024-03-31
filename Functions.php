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


// Get a util value from Division
function utilDivisionID($utilID)
{
    global $dbMasterlist;
    $whereID = '';
    if($utilID != null){
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
    if($utilID != null){
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
    if($utilID != null){
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
    if($utilID != null){
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
    if($utilID != null){
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
    if($utilID != null){
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
    if($utilID != null){
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
