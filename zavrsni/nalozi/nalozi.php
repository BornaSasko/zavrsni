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

    $idradnognaloga = $_POST['IDRadnogNaloga'];
    $idradnika = $_POST['IDRadnika'];
    $idklijenta = $_POST['IDKlijenta'];
    $datumotvaranja = $_POST['DatumOtvaranja'];
    $opispopravka = $_POST['OpisPopravka'];
    $utvrdenikvar = $_POST['UtvrdeniKvar'];
    $datumzatvaranja = $_POST['DatumZatvaranja'];
    $ukupnovrijemepopravka = $_POST['UkupnoVrijemePopravka'];
    $cijenadijelova = $_POST['CijenaDijelova'];
    $cijenarada = $_POST['CijenaRada'];

    $sql = "INSERT INTO RadniNalozi (IDRadnogNaloga, IDRadnika, IDKlijenta, DatumOtvaranja, OpisPopravka, UtvrdeniKvar, DatumZatvaranja, UkupnoVrijemePopravka, CijenaDijelova, CijenaRada) VALUES ('$idradnognaloga', '$idradnika', '$idklijenta', '$datumotvaranja', '$opispopravka','$utvrdenikvar','$datumzatvaranja','$ukupnovrijemepopravka','$cijenadijelova','$cijenarada')";

    if ($conn->query($sql)) {
        echo "Novi nalog je uspješno dodan.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
die(header("Location: " . $_SERVER["HTTP_REFERER"]));
?>
