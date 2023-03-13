<?php
require_once "includes/dbdelete.php";
require_once "includes/dbadd.php";
?>

    <!DOCTYPE html>
    <html lang="sv">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/style.css" type="text/css">

        <title>Comment section</title>

    </head>
    <body>
    <h1>Joujo's Gästbok</h1>

    <form method="POST">
        Namn: <br> <input type="text" name="namn" id="namn" placeholder="Namn" required>
        <br>
        Meddelande: <br> <textarea id="meddelande" name="meddelande" rows="5" cols="50" placeholder="Skriv en kommentar:" required></textarea>
        <br>
        <input type="submit" name="submit" id="submit" value="Skapa inlägg">
    </form>
    </body>
    </html>

<?php

echo "<br>";
echo "<h2>Gästboksinlägg</h2>";

try {
    $servername = "studentmysql.miun.se"; $username = "jojo2109"; $password = "svjyg9gn"; $dbname = "jojo2109";
    $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
    // Set PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get all database records
    $stmt = $conn->query('SELECT * FROM Comments ORDER BY id DESC');

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '<tr><td>'
,            '</td><td>'.$row['name']. "<br>".
            '</td><td>'.$row['message']. "<br>".
            '</td><td>'.$row['date']. "<br>".
            '</td><td><form method="post"><input type="hidden" name="radera" value="' . $row['id']
             .'"><input type="submit" name="del" id="del" value="Radera inlägg"></form></a></td></tr> <br><br>';
    }

    // Close connection
    $conn = NULL;
}
catch(PDOException $e){
    echo $e->getMessage();
}
?>