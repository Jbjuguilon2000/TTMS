<?php

define("HOSTNAME", "localhost");
define("USERNAME", "root");
define("PASSWORD", "");
define("DATABASE_TTMS", "ttms");

$DBTTMS = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE_TTMS);

if (!$DBTTMS) {
    die("Failed to Connect to TTMS");
}
