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

# Tässä kohtaa tietoja pitäisi tarkistaa

$nimi = $_POST["nimi"];
$pisteet = $_POST["pisteet"];
$virhe = 0; 
#muista tarkistaa aina virheet palvelimen päässä, php.
#substr antaa nyt vain tulostaa ensimmäiset 5 kirj.
$nimi = substr($nimi,0,5);

#jos EInumero niin virhe, voi listätä vaikka mitä tarkistuksia.
if (!is_numeric($pisteet))
{
$virhe++;
echo "pisteet kenttään tulee syöttää vain numeroita";
}
#tarkistetaan virheiden määrä
if($virhe>0)
{
echo "kentissä virheellistä tietoa palaa takaisin";
}
else {

# Puhdistetaan merkkijono(t) tietoturva juttuja. 
$nimi = $mysqli->real_escape_string($nimi);
$pisteet = $mysqli->real_escape_string($pisteet);

# Muodostetaan SQL-lause. Lopullinen lause olisi seuraavanlainen, jos arvot olisivat Kia ja 11000
# INSERT INTO `antti1419_henkilot` (`nimi`, `pisteet`) VALUES ('Kia', '11000')
$sql ="INSERT INTO `antti1419_henkilot` (`etunimi`, `pisteet`) VALUES ('" . $nimi . "', '" . $pisteet ."')";
#virheen etsintää ->
echo $sgl;
# Ajetaan SQL-lause

if($mysqli->query($sql) === false) {
  trigger_error('Virhe SQL:ssä: ' . $sql . ' Virhe: ' . $mysqli->error, E_USER_ERROR);
} else {
#näytetään id mihin tieto lisättiin... lopuksi näytetään tiedot.
  echo "<p>Lisätyn tietueen id: " . $mysqli->insert_id . "</p>";
  echo "<a href=\"tulostatiedot.php\">katso tiedot</a></p>";
} 

# Suljetaan yhteys tietokantapalvelimeen
$mysqli->close();

#virhe if, else kaikki ok
}

?>



</body>
</html>