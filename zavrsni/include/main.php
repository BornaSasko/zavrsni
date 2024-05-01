<div class="main-container">
    <div class="main-info-card">
        <div class="table-wrapper">
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

                $sql = "SELECT concat(r.Ime,' ',r.Prezime) as 'rIme',COUNT(IDRadnika) as 'Ukupno' FROM RadniNalozi as rn RIGHT OUTER JOIN Radnici as r on rn.IDRadnika = r.OIB GROUP BY rn.IDRadnika ORDER BY Ukupno desc";
                $result = $conn->query($sql);

                //ispis podataka u obliku tablice
                echo "<table id='main-table'><tr><th>Zaposlenik</th><th>Odrađeno</th></tr><tr>";

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<td>" . $row["rIme"] . "</td><td>" . $row["Ukupno"] . "</td></tr>";                                
                    }
                } else {
                    echo "<td colspan='2'>Nema rezultata</td>"; //poruka ako je tablica prazna
                }
                echo "</table>";

                $conn->close(); //zatvaranje veze s serverom i bazom
            ?>
        </div>
    </div>
    <div class="main-info-card">
        <div class="table-wrapper">
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

                $sql = "SELECT UkupnoVrijemePopravka, CijenaDijelova, CijenaRada,r.OIB,r.CijenaSata FROM RadniNalozi as rn INNER JOIN Radnici as r on r.OIB=rn.IDRadnika GROUP BY UkupnoVrijemePopravka, CijenaDijelova, CijenaRada,r.OIB,r.CijenaSata";
                $result = $conn->query($sql);

                //ispis podataka u obliku tablice
                echo "<table id='profit-table'><tr><th colspan='3'>Bilanca</th></tr><tr>";
                echo "<th>Zarada</th><th>Trošak</th><th>Dobit</th></tr><tr>";

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<td>" . $row["CijenaRada"] + $row["CijenaDijelova"] . " €</td><td>" . $row["CijenaSata"] * $row["UkupnoVrijemePopravka"] + $row["CijenaDijelova"] . " €</td><td>" . ($row["CijenaRada"] + $row["CijenaDijelova"]) - ($row["CijenaSata"] * $row["UkupnoVrijemePopravka"] + $row["CijenaDijelova"]) . " €</td></tr>";                                
                    }
                } else {
                    echo "<td colspan='3'>Nema rezultata</td>"; //poruka ako je tablica prazna
                }
                echo "</table>";

                $conn->close(); //zatvaranje veze s serverom i bazom
            ?>
        </div>
    </div>
</div>