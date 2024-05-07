<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "../include/head.php"?> <!--ubacivanje zaglavlja stranice-->
</head>
<body>
    <nav>
        <?php include "../include/navigation.php" ?> <!--ubacivanje navigacije stranice-->
    </nav>
    <main id="radnici">
        <div class="add-entity-overlay">
            <form method="post" action="radnici.php"><!--forma za unos podataka-->
                <div class="input-group">
                    <span>Ime:</span>
                    <input type="text" name="ime">
                </div>
                <div class="input-group">
                    <span>Prezime:</span>
                    <input type="text" name="prezime">
                </div>
                <div class="input-group">
                    <span>OIB:</span>
                    <input type="text" name="oib">
                </div>
                <div class="input-group">
                    <span>Cijena sata:</span>
                    <input type="text" name="cijenasata">
                </div>
                <div class="input-group">
                    <span>Kontakt:</span>
                    <input type="text" name="kontakt">
                </div>
                <input type="submit" name="button" id="submit-btn" value="Dodaj"> 
            </form>
        </div>
        <div class="pregled-table-wrapper">
        <input type="button" class="gumb" value="DODAJ"> 
        <?php
            //veza sa serverom i bazom
            $servername = "localhost"; 
            $username = "admin";
            $password = "123";
            $dbname = "web_radionica";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            //sql upit koji vraća sve iz tablice klijenti

            $sql = "SELECT * FROM Radnici";
            $result = $conn->query($sql);

            //ispis podataka u obliku tablice

            if ($result->num_rows > 0) {
                echo "<table>";
                echo "<tr><th>OIB</th><th>Ime</th><th>Prezime</th><th>Cijena sata</th><th>Kontakt</th><th></th></tr>";
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["OIB"] . "</td>";
                    echo "<td>" . $row["Ime"] . "</td>";
                    echo "<td>" . $row["Prezime"] . "</td>";
                    echo "<td>" . $row["CijenaSata"] . "</td>";
                    echo "<td>" . $row["KontaktInfo"] . "</td>";
                    echo "<td><a href='brisi_radnika.php?OIB={$row["OIB"]}'>Briši</a></td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "Nema rezultata."; //poruka ako je tablica prazna
            }

            $conn->close(); //zatvaranje veze s serverom i bazom
        ?>
        </div>
    </main>
</body>
</html>