<?php

define("HOSTNAME", "localhost");
define("USERNAME", "root");
define("PASSWORD", "");
define("DATABASE_TTMS", "ttms");

$dbTTMS = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE_TTMS);

if (!$dbTTMS) {
    die("Failed to Connect to TTMS");
}
