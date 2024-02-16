<?php
require("../requires/config.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (trim($_POST['name']) == NULL) {
        Header("Location: login.php?error=1");
    }
    if (trim($_POST['pass']) == NULL) {
        Header("Location: login.php?error=2");
    }
    $query = $dbconn->query("SELECT * FROM site_users WHERE name = '" . $dbconn->real_escape_string($_POST['name']) . "'");

    if ($query->num_rows == 1) {
        $row = $query->fetch_assoc();
        if ($_POST['pass'] == $row['pass']) {
            $_SESSION['login'] = true;

            if ($_SERVER['HTTP_REFFER'] != "") {
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            } else {
                Header("Location: toonagenda.php");
                header('Cache-Control: no cache');
                session_cache_limiter('private_no_expire');
                session_start();
            }
        } else {
            Header("Location: login.php?error=3");
        }
    } else {
        Header("Location: login.php?error=4");
    }
}
