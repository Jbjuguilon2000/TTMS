<?php

$Limit = 10;
$page = 0;
if (isset($_POST["page"])) {
    $page = $_POST["page"];
} else {
    $page = 1;
}
$start_from = ($page - 1) * $Limit;
