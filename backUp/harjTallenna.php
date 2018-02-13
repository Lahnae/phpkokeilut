<html>
<head><title>Tietojen tallentaminen</title></head>
<body>

<?php

# Otetaan yhteys tietokantapalvelimeen
$mysqli = new mysqli('localhost', 'trtknu14a3', 'tr54!1', 'trtknu14a3');

if(mysqli_connect_errno()) {
      echo "Tietokantayhteys ei onnistunut " . mysqli_connect_errno();
      exit();
} 

# T‰ss‰ kohtaa tietoja pit‰isi tarkistaa

$sukunimi = $_POST["sukunimi"];
$nimi = $_POST["etunimi"];
$syntymavuosi = $_POST["syntymavuosi"];
$virhe = 0; 
#muista tarkistaa aina virheet palvelimen p‰‰ss‰, php.
#substr antaa nyt vain tulostaa ensimm‰iset 5 kirj.
#$nimi = substr($nimi,0,5);

#jos EInumero niin virhe, voi list‰t‰ vaikka mit‰ tarkistuksia.
if (!is_numeric($syntymavuosi))
{
$virhe++;
echo "<br> Syntym√§vuosi kentt√§√§n tulee sy√§tt√§√§ vain numeroita";
}

if (is_numeric($nimi)||is_numeric($sukunimi))
{
$virhe++;
echo "<br> Nimi ei voi olla numeroita";
}

#tarkistetaan virheiden m‰‰r‰
if($virhe>0)
{
echo " <br> Kentiss√§ virheellist√§ tietoa <p> <a href=harjEtusivu.html>palaa etusivulle</a></p>";
}
else {

# Puhdistetaan merkkijono(t) tietoturva juttuja. 
$nimi = $mysqli->real_escape_string($nimi);
$syntymavuosi = $mysqli->real_escape_string($syntymavuosi);
$sukunimi = $mysqli->real_escape_string($sukunimi);

# Muodostetaan SQL-lause. Lopullinen lause olisi seuraavanlainen, jos arvot olisivat Kia ja 11000
# INSERT INTO `antti1419_henkilot` (`nimi`, `pisteet`) VALUES ('Kia', '11000')
$sql ="INSERT INTO `antti1419henkilot` (`sukunimi`, `etunimi`, `syntymavuosi`) VALUES ('" . $sukunimi . "', '" . $nimi . "', '" . $syntymavuosi ."')";
#virheen etsint‰‰ ->
echo $sgl;
# Ajetaan SQL-lause

if($mysqli->query($sql) === false) {
  trigger_error('Virhe SQL:ss‰: ' . $sql . ' Virhe: ' . $mysqli->error, E_USER_ERROR);
} else {
#n‰ytet‰‰n id mihin tieto lis‰ttiin... lopuksi n‰ytet‰‰n tiedot.
  echo "<p>Lis√§tyn tietueen id: " . $mysqli->insert_id . "</p>";
  echo "<a href=\"harjTulostatiedot.php\">katso tiedot</a></p>";
} 

# Suljetaan yhteys tietokantapalvelimeen
$mysqli->close();

#virhe if, else kaikki ok
}

?>



</body>
</html>