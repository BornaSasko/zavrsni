<?php
    $servername = "localhost"; 
    $username = "admin";
    $password = "123";
    $dbname = "web_radionica";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "delete from Radnici where OIB = {$_GET['OIB']}";
    $result = $conn->query($sql);

    $conn->close();

    die(header("Location: " . $_SERVER["HTTP_REFERER"]));
?>