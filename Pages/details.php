<?php
require('../requires/config.php');

if ($_SESSION['login'] != true) {
    header("location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda Item Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .details-container {
            border: 1px solid #ccc;
            padding: 20px;
            max-width: 400px;
            margin: 0 auto;
        }

        h2 {
            color: #333;
        }

        .details-item {
            margin-bottom: 10px;
        }

        .details-label {
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="details-container">
        <?php

        $id = $_GET['id'];
        ?>

        <h3>Details van de agenda item met ID: <?= $id ?></h3>
        <?php

        $query = $dbconn->prepare("SELECT * FROM crud_agenda WHERE ID = ?");
        $query->bind_param("i", $id);

        $query->execute();

        $result = $query->get_result();

        if (mysqli_num_rows($result) > 0) {
            $items = $result->fetch_assoc();
        ?>
            <div class='details-item'>
                <span class='details-label'>Onderwerp:</span> <?= $items['onderwerp'] ?><br>
            </div>

            <div class='details-item'>
                <span class='details-label'>Inhoud:</span> <?= $items['inhoud'] ?><br>
            </div>

            <div class='details-item'>
                <span class='details-label'>Begindatum:</span> <?= $items['begindatum'] ?><br>
            </div>

            <div class='details-item'>
                <span class='details-label'>Einddatum:</span> <?= $items['einddatum'] ?><br>
            </div>

            <div class='details-item'>
                <span class='details-label'>Priority:</span> <?= $items['priority'] ?><br>
            </div>

            <div class='details-item'>
                <span class='details-label'>Status:</span>
                <?= ($items['status'] == 'n') ? 'Niet begonnen' : '' ?>
                <?= ($items['status'] == 'b') ? 'Bezig' : '' ?>
                <?= ($items['status'] == 'a') ? 'Afgerond' : '' ?>
            </div>
        <?php
        } else { ?>
            <p>Geen items gevonden</p>
        <?php
        }
        $query->close();
        ?>
        <a href='toonagenda.php'>Overzicht</a>
    </div>

</body>

</html>