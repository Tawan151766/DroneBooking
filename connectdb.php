<?php
$server     = "localhost";
$user       = "root";
$pwd        = "";
$dbname     = "drone-booking";
$connection = mysqli_connect($server, $user, $pwd, $dbname);
$connection->set_charset("utf8");

$server_crm     = "localhost";
$user_crm       = "root";
$pwd_crm        = "";
$dbname_crm     = "drone-booking";
$connection_crm = mysqli_connect($server_crm, $user_crm, $pwd_crm, $dbname_crm);
$connection_crm->set_charset("utf8");
?>