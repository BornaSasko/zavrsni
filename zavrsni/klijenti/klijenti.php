<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost"; 
    $username = "admin";
    $password = "123";
    $dbname = "web_radionica";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];
    $kontakt = $_POST['kontakt'];

    $sql = "INSERT INTO Klijenti (IDKlijenta, Ime, Prezime, KontaktInfo) VALUES (default, '$ime', '$prezime', '$kontakt')";

    if ($conn->query($sql)) {
        echo "Novi radnik je uspješno dodan.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
die(header("Location: " . $_SERVER["HTTP_REFERER"]));
?>
