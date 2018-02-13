<html>
<head><title>Tietojen tallentaminen</title></head>
<center>
<body>

<?php

# Otetaan yhteys tietokantapalvelimeen
$mysqli = new mysqli('localhost', 'trtknu14a3', 'tr54!1', 'trtknu14a3');

if(mysqli_connect_errno()) {
      echo "Tietokantayhteys ei onnistunut " . mysqli_connect_errno();
      exit();
} 



$sukunimi = $_POST["sukunimi"];
$nimi = $_POST["etunimi"];
$syntymavuosi = $_POST["syntymavuosi"];
$virhe = 0; 
#muista tarkistaa aina virheet palvelimen päässä, php.


#Tarkistetaan onko syntymävuosi enemmän kuin nykyinen vuosi.
$now = date("Y");
if ( $syntymavuosi > $now || $syntymavuosi < 1900) {
  echo "<br><li><font color=\"red\">Virheellinen syntymävuosi</font></li>";
  $virhe++;
}


#jos EI ole numero niin virhe
if (!is_numeric($syntymavuosi))
{
$virhe++;
echo "<br><li> <font color=\"red\">Syntymävuosi kenttään tulee syättää vain numeroita</font></li>";
}
#Ei hyväksytä liian pitkiä nimiä
if (strlen($nimi) > 20 || strlen($sukunimi) > 30)
{
$virhe++;
echo "<br><li><font color=\"red\">suku- tai etunimi liian pitkä</font></li>";
}
if (preg_match('/[\'^£$%&*()}{@#~?!><>,|=_+¬]/', $nimi)||preg_match('/[\'^£$%&*()}{@#~?!><>,|=_+¬]/', $sukunimi))
{
$virhe++;
echo "<br><li><font color=\"red\">suku- tai etunimi sisältää kiellettyjä merkkejä</font></li>";
}
#Onko numeroita syötteessä
if (strpbrk($sukunimi, '0123456789')||strpbrk($nimi, '0123456789'))
{
$virhe++;
echo " <br><li><p><font color=\"red\">suku- tai etunimi ei voi sisältää numeroita</font></p></li>";
}
if (is_numeric($nimi)||is_numeric($sukunimi))
{
$virhe++;
echo "<br><li> <font color=\"red\">Nimi ei voi olla numeroita</font></li>";
}



#tarkistetaan virheiden määrä
if($virhe>0)
{
echo " <br><li><font color=\"red\"> Kentissä virheellistä tietoa <p> <a href=harjEtusivu.html>Palaa etusivulle</a></font></p></li>";
  echo "<a href=\"harjTulostatiedot.php\">Katso tiedot</a></p>";
  echo "<br><a href=\"harjLisaa1.html\">Lisää käyttäjä</a></p>";
  echo "<br><a href=\"harjPoista.php\">Poista käyttäjä</a></p>";

}
else {

# Puhdistetaan merkkijono(t) tietoturva juttuja. 
$nimi = $mysqli->real_escape_string($nimi);
$syntymavuosi = $mysqli->real_escape_string($syntymavuosi);
$sukunimi = $mysqli->real_escape_string($sukunimi);

# Muodostetaan SQL-lause. Lopullinen lause olisi seuraavanlainen, jos arvot olisivat Kia ja 11000
# INSERT INTO `antti1419_henkilot` (`nimi`, `pisteet`) VALUES ('Kia', '11000')
$sql ="INSERT INTO `antti1419henkilot` (`sukunimi`, `etunimi`, `syntymavuosi`) VALUES ('" . $sukunimi . "', '" . $nimi . "', '" . $syntymavuosi ."')";
#virheen etsintää ->
echo $sgl;
# Ajetaan SQL-lause

if($mysqli->query($sql) === false) {
  trigger_error('Virhe SQL:ss�: ' . $sql . ' Virhe: ' . $mysqli->error, E_USER_ERROR);
} else {
#näytetään id mihin tieto lisättiin... lopuksi näytetään tiedot.
  echo "<p>Lisätyn tietueen id: " . $mysqli->insert_id . "</p>";
  echo "<a href=\"harjTulostatiedot.php\">katso tiedot</a></p>";
  echo "<br><a href=\"harjEtusivu.html\">Etusivu</a></p>";
  echo "<br><a href=\"harjLisaa1.html\">Lisää käyttäjä</a></p>";
  echo "<br><a href=\"harjPoista.php\">Poista käyttäjä</a></p>";
} 

# Suljetaan yhteys tietokantapalvelimeen
$mysqli->close();

#virhe if, else kaikki ok
}

?>


</center>
</body>
</html>