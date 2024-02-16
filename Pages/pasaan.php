<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('../requires/config.php');

if ($_SESSION['login'] != true) {
    header("location: login.php");
}

$token = bin2hex(openssl_random_pseudo_bytes(32));
$_SESSION['token'] = $token;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verander Gegevens</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }

        .details-container {
            border: 1px solid #ccc;
            padding: 20px;
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h3 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            display: grid;
            grid-gap: 10px;
        }

        label {
            font-weight: bold;
            color: #555;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="date"],
        input[type="number"] {
            width: calc(100% - 16px);
        }

        select {
            width: calc(100% + 2px);
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>

    <div class="details-container">
        <?php

        $id = $_GET['id'];
        ?>
        <h3>Details van de agenda item met ID:<?= $id ?></h3>
        <?php

        $query = $dbconn->prepare("SELECT * FROM crud_agenda WHERE ID = ?");
        $query->bind_param("i", $id);

        $query->execute();

        $result = $query->get_result();

        if (mysqli_num_rows($result) > 0) {
            $items = $result->fetch_assoc();
        ?>
            <form action="pasaanverwerk.php" method="post">
                <input type="int" name="id" value="<?= $items['ID'] ?>" hidden>
                <input type="hidden" name="csrf_token" value="<?= $token ?>">
                <div>
                    <label for="Onderwerp">Onderwerp</label>
                    <input type="text" name="onderwerp" required value="<?= $items['onderwerp'] ?>" />
                </div>
                <div>
                    <label for="Inhoud">Inhoud</label>
                    <textarea name="inhoud" id="" cols="20" rows="1" required><?= $items['inhoud'] ?></textarea>
                </div>
                <div>
                    <label for="Begindatum">Begindatum</label>
                    <input type="date" name="begindatum" required value="<?= $items['begindatum'] ?>" />
                </div>
                <div>
                    <label for="Einddatum">Einddatum</label>
                    <input type="date" name="einddatum" required value="<?= $items['einddatum'] ?>" />
                </div>
                <div>
                    <label for="Prioriteit">Prioriteit</label>
                    <input type="number" name="priority" max="5" min="1" required value="<?= $items['priority'] ?>" />
                </div>
                <div>
                    <label for="Status">Status</label>
                    <select name="status">
                        <option value="n" <?= ($items['status'] == 'n') ? 'selected' : '' ?>>Niet Begonnen</option>
                        <option value="b" <?= ($items['status'] == 'b') ? 'selected' : '' ?>>Bezig</option>
                        <option value="a" <?= ($items['status'] == 'a') ? 'selected' : '' ?>>Afgerond</option>
                    </select>

                </div>
                <div>
                    <input type="submit" value="aanpassen" name="aanpassen" />
                </div>
            </form>
        <?php
        } else {
        ?>
            <p>Geen items gevonden</p>
        <?php
        }

        $query->close();
        ?>
    </div>

</body>

</html>