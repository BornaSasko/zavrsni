<?php
    $servername = "localhost"; 
    $username = "admin";
    $password = "123";
    $dbname = "web_radionica";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "delete from klijenti where IDKlijenta = {$_GET['IDKlijenta']}";
    $result = $conn->query($sql);

    $conn->close();

    die(header("Location: " . $_SERVER["HTTP_REFERER"]));
?>