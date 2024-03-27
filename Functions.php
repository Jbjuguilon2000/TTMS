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
function utilDivisionID($id)
{
    global $dbMasterlist;

    if ($id !== 0) {
        $whereID = 'WHERE ID = ' . $id;
    }

    $utilDivisionQuery = $dbMasterlist->query("SELECT * FROM util_division $whereID");
    $divisions = $utilDivisionQuery->fetch_all(MYSQLI_ASSOC);

    $divisionName = '';

    foreach ($divisions as $r) {
        if (isset($r)) {
            $divisionName = $r['Division'];
        }
    }

    return $divisionName;
}

// Get a util value from Designation
function utilDesignationID($id)
{
    global $dbMasterlist;

    if ($id !== 0) {
        $whereID = 'WHERE ID = ' . $id;
    }

    $utilDesignationsQuery = $dbMasterlist->query("SELECT * FROM util_designation $whereID");
    $designations = $utilDesignationsQuery->fetch_all(MYSQLI_ASSOC);

    $designationName = '';

    foreach ($designations as $r) {
        if (isset($r)) {
            $designationName = $r['Designation'];
        }
    }

    return $designationName;
}
