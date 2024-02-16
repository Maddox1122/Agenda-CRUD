<?php
session_start();

$hostname = "localhost";
$user = 'root';
$pass = '';
$dbname = 'agenda';

$dbconn = new mysqli($hostname, $user, $pass, $dbname);

if ($dbconn->connect_errno) {
    echo "Kan niet connecteren met MySQL: " . $dbconn->connect_error;
    exit();
}
