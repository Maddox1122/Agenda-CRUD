<?php
require('../requires/config.php');

if ($_SESSION['login'] != true) {
    header("location: login.php");
}

$sqlselect = $dbconn->prepare('SELECT * FROM crud_agenda');

$sqlselect->execute();

$result = $sqlselect->get_result();
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($id != "") {
        $query = $dbconn->prepare("DELETE FROM crud_agenda WHERE ID = ?");

        $query->bind_param("i", $id);

        $result = $query->execute();

        if ($result) {
            header("Location: toonagenda.php");
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <a href="toevoegform.php">Toevoegen</a>
    <a href="logout.php">Logout</a>
    <?php
    if (mysqli_num_rows($result) > 0) {
    ?>
        <table>
            <tr>
                <th>Onderwerp</th>
                <th>Inhoud</th>
                <th>Details-Page</th>
                <th>Verwijder</th>
                <th>Pas aan</th>
            </tr>
            <?php
            while ($agenda_item = $result->fetch_assoc()) {
                $id = $agenda_item['ID'];
            ?>
                <tr>
                    <td><?= $agenda_item['onderwerp'] ?></td>
                    <td><?= $agenda_item['inhoud'] ?></td>
                    <td><a href='details.php?id=<?= $id ?>'>Details</a></td>
                    <td><a href='toonagenda.php?id=<?= $id ?>'>Verwijder</a></td>
                    <td><a href='pasaan.php?id=<?= $id ?>'>Pas aan</a></td>
                </tr>
            <?php
            }
            ?>
        </table>
    <?php
    } else {
    ?>
        <p>Geen items gevonden</p>
    <?php
    }
    ?>
</body>

</html>