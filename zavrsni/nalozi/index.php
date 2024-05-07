<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "../include/head.php"?>
</head>
<body>
    <nav>
        <?php include "../include/navigation.php" ?>
    </nav>
    <main id="radnici">
        <div class="overlay-hidden" id="add-order-overlay">
            <form method="post" action="nalozi.php">
                <div class="input-group">
                    <span>Zaposlenik:</span>
                    <select class="input-polje" name="IDRadnika">
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

                            //ispis podataka

                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo "<option value='{$row["OIB"]}'>{$row["Ime"]} {$row["Prezime"]}</option>";                                }
                            } else {
                                echo "Nema rezultata."; //poruka ako je tablica prazna
                            }

                            $conn->close(); //zatvaranje veze s serverom i bazom     
                        ?>   
                    </select>
                </div>
                <div class="input-group">
                    <span>Klijent:</span>
                    <select class="input-polje" name="IDKlijenta">
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

                            $sql = "SELECT * FROM Klijenti";
                            $result = $conn->query($sql);

                            //ispis podataka

                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo "<option value='{$row["IDKlijenta"]}'>{$row["Ime"]} {$row["Prezime"]}</option>";                                }
                            } else {
                                echo "Nema rezultata."; //poruka ako je tablica prazna
                            }

                            $conn->close(); //zatvaranje veze s serverom i bazom     
                        ?>   
                    </select>
                </div>
                <div class="input-group">
                    <span>Datum otvaranja</span>
                    <input class="input-polje" type="date" name="DatumOtvaranja">
                </div>
                <div class="input-group">
                    <span>Opis popravka</span>
                    <input class="input-polje" type="text" name="OpisPopravka">
                </div>
                <div class="input-group">
                    <span>Kvar:</span>
                    <input class="input-polje" type="text" name="UtvrdeniKvar">
                </div>
                <div class="input-group">
                    <span>Datum zatvaranja:</span>
                    <input class="input-polje" type="date" name="DatumZatvaranja">
                </div>
                <div class="input-group">
                    <span>Vrijeme popravka:</span>
                    <input class="input-polje" type="text" name="UkupnoVrijemePopravka">
                </div>
                <div class="input-group">
                    <span>Cijena dijelova:</span>
                    <input class="input-polje" type="text" name="CijenaDijelova">
                </div>
                <div class="input-group">
                    <span>Cijena rada:</span>
                    <input class="input-polje" type="text" name="CijenaRada">
                </div>
                <input type="submit" class="overlay-input-gumb" name="button" id="submit-btn" value="Dodaj"> 
                <input type="button" value="&times;" class="btn-toggle-overlay" onclick="toggleOverlay('add-order-overlay');">
            </form>
        </div>
        <div class="pregled-table-wrapper">
        <input type="button" class="gumb" value="DODAJ" onclick="toggleOverlay('add-order-overlay');">

        <?php
            //veza s serverom i bazom
            $servername = "localhost"; 
            $username = "admin";
            $password = "123";
            $dbname = "web_radionica";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT *, concat(k.Ime, ' ', k.Prezime) as kIme, concat(r.Ime, ' ', r.Prezime) as rIme FROM RadniNalozi as rn INNER JOIN Radnici as r on rn.IDRadnika = r.OIB
            INNER JOIN Klijenti as k on rn.IDKlijenta = k.IDKlijenta";
            $result = $conn->query($sql);

            //ispis podataka u obliku tablice
            if ($result->num_rows > 0) {
                echo "<table>";
                echo "<tr><th>ID</th><th>Zaposlenik</th><th>Klijent</th><th>Datum Otvaranja</th><th>Opis</th><th>Kvar</th><th>Datum zatvaranja</th><th>Vrijeme popravka</th><th>Cijena dijelova</th><th>Cijena Rada</th><th>Ukupno</th><th></th></tr>";

                //while petlja ispisuje sve podatke tablice RadniNalozi
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["IDRadnogNaloga"] . "</td>";
                    echo "<td>" . $row["rIme"] . "</td>";
                    echo "<td>" . $row["kIme"] . "</td>";
                    echo "<td>" . $row["DatumOtvaranja"] . "</td>";
                    echo "<td>" . $row["OpisPopravka"] . "</td>";
                    echo "<td>" . $row["UtvrdeniKvar"] . "</td>";
                    echo "<td>" . $row["DatumZatvaranja"] . "</td>";
                    echo "<td>" . $row["UkupnoVrijemePopravka"] . "h</td>";
                    echo "<td>" . $row["CijenaDijelova"] . " €</td>";
                    echo "<td>" . $row["CijenaRada"] . " €</td>";
                    echo "<td>" . $row["CijenaRada"] + $row["CijenaDijelova"] . " €</td>";
                    echo "<td><a href='brisi_nalog.php?IDRadnogNaloga={$row["IDRadnogNaloga"]}'>Briši</a></td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "Nema rezultata."; //poruka ako je tablica prazna
            }

            $conn->close(); //kraj veze s bazom
        ?>
        </div>
    </main>
</body>
</html>