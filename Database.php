<?php

define("HOSTNAME", "localhost");
// define("USERNAME", "jbpjuguilon");
// define("PASSWORD", "wAn^$3cr+QgB&4()%9Ut");
define("USERNAME", "root");
define("PASSWORD", "");
define("DATABASE_TTMS", "TTMS");

$dbTTMS = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE_TTMS);

if (!$dbTTMS) {
    die("Failed to Connect to TTMS");
}

define("DATABASE_Masterlist", "masterlist");

$dbMasterlist = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE_Masterlist);

if (!$dbMasterlist) {
    die("Failed to Connect to Masterlist");
}
