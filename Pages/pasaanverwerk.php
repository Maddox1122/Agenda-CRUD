<?php
require('../requires/config.php');

if (isset($_SESSION["token"]) && $_SESSION["token"] == $_POST['csrf_token']) {
    if (
        isset($_POST['aanpassen'])
        && isset($_POST['id'])
        && isset($_POST['onderwerp'])
        && isset($_POST['inhoud'])
        && isset($_POST['begindatum'])
        && isset($_POST['einddatum'])
        && isset($_POST['priority'])
        && isset($_POST['status'])
    ) {
        $id = $_POST['id'];

        if (isset($_SERVER["HTTP_REFERER"]) && $_SERVER["HTTP_REFERER"] == "http://localhost/OOP2/Module%202/CRUD+/Pages/pasaan.php?id=$id") {
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
            $begindatum = date('Y-m-d', strtotime($_POST['begindatum']));
            $einddatum = date('Y-m-d', strtotime($_POST['einddatum']));
            $priority = mysqli_real_escape_string($dbconn, $priority);
            $status = mysqli_real_escape_string($dbconn, $_POST['status']);

            $query = $dbconn->prepare("UPDATE crud_agenda 
    SET onderwerp = ?, inhoud = ?, begindatum = ?, einddatum = ?, priority = ?, status = ? WHERE ID = ?");


            $query->bind_param("ssssisi", $onderwerp, $inhoud, $begindatum, $einddatum, $priority, $status, $id);

            $result = $query->execute();

            if ($result) {
                header("Location: toonagenda.php");
            }
        } else {
            header("Location: toonagenda.php");
        }
    } else {
        return null;
    }
}
