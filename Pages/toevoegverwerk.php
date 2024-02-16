<?php
require('../requires/config.php');

if (isset($_SERVER["HTTP_REFERER"]) && $_SERVER["HTTP_REFERER"] == "http://localhost/OOP2/Module%202/CRUD+/Pages/toevoegform.html") {
    if (
        isset($_POST['toevoegen'])
        && isset($_POST['onderwerp'])
        && isset($_POST['inhoud'])
        && isset($_POST['begindatum'])
        && isset($_POST['einddatum'])
        && isset($_POST['priority'])
        && isset($_POST['status'])
    ) {
        if (!strtotime($_POST['begindatum'])) {
            die("Ongeldige begindatum");
        }

        if (!strtotime($_POST['einddatum'])) {
            die("Ongeldige einddatum");
        }

        $priority = intval($_POST['priority']);
        if ($priority < 1 || $priority > 5) {
            die("Priority moet een getal tussen 1 en 5 zijn");
        }

        $onderwerp = mysqli_real_escape_string($dbconn, $_POST['onderwerp']);
        $inhoud = mysqli_real_escape_string($dbconn, $_POST['inhoud']);
        $begindatum = date('Y-m-d', strtotime($_POST['begindatum'])); // Zet de datum om naar het juiste formaat
        $einddatum = date('Y-m-d', strtotime($_POST['einddatum'])); // Zet de datum om naar het juiste formaat
        $priority = mysqli_real_escape_string($dbconn, $priority);
        $status = mysqli_real_escape_string($dbconn, $_POST['status']);

        $query = $dbconn->prepare("INSERT INTO crud_agenda 
        (onderwerp, inhoud, begindatum, einddatum, priority, status)
        VALUES (?, ?, ?, ?, ?, ?)");

        $query->bind_param("ssssis", $onderwerp, $inhoud, $begindatum, $einddatum, $priority, $status);

        $result = $query->execute();

        if ($result) {
            header("Location: toonagenda.php");
        }
    } else {
        return null;
    }
} else {
    header("Location: toonagenda.php");
}
