<html>
<head><title>Poista k채ytt채j채</title></head>
<body>
<center>
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

#J채rjesetet채채n nimet syntym채vuoden mukaan
$sql ="SELECT * FROM `antti1419henkilot` order by syntymavuosi DESC ";

#Ajetaan SQL-kysely virheilmoitusta ei kannata tulostaa koska tietosuoja k채rsii
if(!$result = $mysqli->query($sql)){
    die('SQL-kysely ep채onnistui [' . $mysqli->error . ']');
}

# Tulostetaan tiedot HTML-taulukkoon
echo "<table border=\"1\" class=\"taulukko\">\n";

# Loopataan saatuja tietoja  style=\"background-color: #ccc;\"

#Taulukkoa
    echo "<tr>";
	echo "<td>K채ytt채j채 ID</td>";
	echo "<td>Sukunimi</td>";
	echo "<td>Etunimi</td>";
	echo "<td>Syntym채vuosi</td>";
	echo "<td> </td>";
	echo "</tr>";
	
while($row = $result->fetch_assoc()){

	echo "<tr>";
	echo "<td>".$row['id'] . "</td>";
	echo "<td>".$row['sukunimi'] . "</td>";
    echo "<td>".$row['etunimi'] . "</td>";
    echo "<td>".$row['syntymavuosi'] . "</td>";
	#tehd狎n poisto linkki id:n mukaan
	echo "<td><a href=\"harjPoista2.php?id=".$row['id'] . "\">Poista</a></td>";
    echo "</tr>\n";
}
#tulostetaan linkkej채 
echo "<p><a href=\"harjLisaa1.html?id=".$row['id'] . "\">Lis채채 tietoja</a></td></p>";
echo "</table>\n";
echo "<p><a href=\"harjEtusivu.html?id=".$row['id'] . "\">Etusivu</a></td></p>";

# Tyhjennet狎n haussa saadut tiedot muistista vain silloin kun on select
$result->free();

# Suljetaan yhteys tietokantapalvelimeen
$mysqli->close();

 

?>
</center>
</body>
</html>