<?php
require("../requires/config.php");
$token = bin2hex(openssl_random_pseudo_bytes(32));
$_SESSION['token'] = $token;
if ($_SESSION['login'] != true) {
  header("location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Toevoegen</title>

  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
      height: 100vh;
    }

    h1 {
      text-align: center;
    }

    form {
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      width: 90vw;
    }

    label {
      display: block;
      margin-bottom: 8px;
    }

    input,
    textarea,
    select {
      width: 100%;
      padding: 8px;
      margin-bottom: 16px;
      box-sizing: border-box;
    }

    input[type="number"] {
      width: calc(100% - 18px);
    }

    input[type="date"] {
      width: calc(100% - 12px);
    }

    select {
      width: calc(100% - 4px);
    }

    div {
      margin-bottom: 20px;
    }

    input[type="submit"] {
      background-color: #1e168f;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #45a049;
    }
  </style>
</head>

<body>
  <h1>Vul de gegevens van het agenda-item in:</h1>
  <form action="toevoegverwerk.php" method="post">
    <input type="hidden" name="csrf_token" value="<?= $token ?>">
    <div>
      <label for="Onderwerp">Onderwerp</label>
      <input type="text" name="onderwerp" required />
    </div>
    <div>
      <label for="Inhoud">Inhoud</label>
      <textarea name="inhoud" id="" cols="20" rows="1" required></textarea>
    </div>
    <div>
      <label for="Begindatum">Begindatum</label>
      <input type="date" name="begindatum" required />
    </div>
    <div>
      <label for="Einddatum">Einddatum</label>
      <input type="date" name="einddatum" required />
    </div>
    <div>
      <label for="Prioriteit">Prioriteit</label>
      <input type="number" name="priority" max="5" min="1" value="3" required />
    </div>
    <div>
      <label for="Status">Status</label>
      <select name="status">
        <option value="n">Niet Begonnen</option>
        <option value="b">Bezig</option>
        <option value="a">Afgerond</option>
      </select>
    </div>
    <div>
      <input type="submit" value="toevoegen" name="toevoegen" />
    </div>
  </form>
</body>

</html>