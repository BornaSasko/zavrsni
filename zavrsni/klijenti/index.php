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
        <div class="add-radnik-overlay">
            <form method="post" action="klijenti.php">
                <div class="input-group">
                    <span>Ime: </span>
                    <input type="text" name="ime">
                </div>
                <div class="input-group">
                    <span>Prezime:</span>
                    <input type="text" name="prezime">
                </div>
                <div class="input-group">
                    <span>Kontakt:</span>
                    <input type="text" name="kontakt">
                </div>
                <input type="submit" name="button" id="submit-btn" value="Dodaj"> 
            </form>
        </div>
        <div class="radnici-table-wrapper">
        <?php
            $servername = "localhost"; 
            $username = "admin";
            $password = "123";
            $dbname = "web_radionica";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM Klijenti";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<table>";
                echo "<tr><th>ID klijenta</th><th>Ime</th><th>Prezime</th><th>Kontakt</th><th></th><th></th></tr>";
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["IDKlijenta"] . "</td>";
                    echo "<td>" . $row["Ime"] . "</td>";
                    echo "<td>" . $row["Prezime"] . "</td>";
                    echo "<td>" . $row["KontaktInfo"] . "</td>";
                    echo "<td><a href='brisi_klijenta.php?IDKlijenta={$row["IDKlijenta"]}'>Briši</a></td>";
                    echo "<td><a href=''>Uredi</a></td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "Nema rezultata.";
            }

            $conn->close();
        ?>
        </div>
    </main>
</body>
</html>