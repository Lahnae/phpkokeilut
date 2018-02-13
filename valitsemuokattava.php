<html>
<head><title>Muokkaa tietoja</title></head>
<body>

<?php

# Otetaan yhteys tietokantapalvelimeen
$mysqli = new mysqli('localhost', 'trtknu14a3', 'tr54!1', 'trtknu14a3');

#virhe jos ei onnistu yhteys, ei kannata k?t?oikeasti koska tietosuoja k?ii.
if(mysqli_connect_errno()) {
      echo "Tietokantayhteys ei onnistunut " . mysqli_connect_errno();
      exit();
}

# Muodostetaan SQL-kysely, DESC k?teinen j?estys, korkein pistem??nsin. order by pisteet DESC
# WHERE etunimi like 'Antti' haetaan Antin tiedot
# WHERE pisteet = '6' tulostetaan kaikki jolla pisteet 6
# WHERE pisteet > 2 kaikki joilla pisteet yli 2, (WHERE pisteet > 2 order by pisteet DESC)
$sql ="SELECT * FROM `antti1419_henkilot` order by pisteet DESC ";

#Ajetaan SQL-kysely virheilmoitusta ei kannata tulostaa koska tietosuoja k?ii
if(!$result = $mysqli->query($sql)){
    die('SQL-kysely epäonnistui [' . $mysqli->error . ']');
}

# Tulostetaan tiedot HTML-taulukkoon
echo "<table border=\"1\" class=\"taulukko\">\n";

# Loopataan saatuja tietoja  style=\"background-color: #ccc;\"
while($row = $result->fetch_assoc()){

    echo "<tr>";
	echo "<td>".$row['id'] . "</td>";
    echo "<td>".$row['etunimi'] . "</td>";
    echo "<td>".$row['pisteet'] . "</td>";
	#tehd��n poisto linkki id:n mukaan
	echo "<td><a href=\"tietojenmuokkaus.php?id=". $row['id'] . "\">Muokkaa</a></td>";
    echo "</tr>\n";
} 
echo "<p><a href=\"lisaa.html?id=".$row['id'] . "\">Lisää tietoja</a></td></p>";
echo "<p><a href=\"poista.php?id=".$row['id'] . "\">Poista tietoja</a></td></p>";
echo "</table>\n";

# Tyhjennet��n haussa saadut tiedot muistista vain silloin kun on select
$result->free();

# Suljetaan yhteys tietokantapalvelimeen
$mysqli->close();

 

?>
</body>
</html>