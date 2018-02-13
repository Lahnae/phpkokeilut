<html>
<head><title>poista tiedot</title></head>
<center>
<body style="margin-top:10%;">
<?php
# Otetaan yhteys tietokantapalvelimeen
$mysqli = new mysqli('localhost', 'trtknu14a3', 'tr54!1', 'trtknu14a3');

if(mysqli_connect_errno()) {
 echo "Tietokantayhteys ei onnistunut " . mysqli_connect_errno();
 exit();
}

# Alla tutkitaan, että saadaanko ID
if (!$_POST["id"] or !is_numeric($_POST["id"])) {
 echo "ID Virhe!";
 exit();
}

$id = $_POST["id"];
// Tarkistetaan käyttäjän syötteet
$nimi= $mysqli->real_escape_string($_POST["etunimi"]);
$syntymavuosi = filter_var($_POST["syntymavuosi"],FILTER_SANITIZE_NUMBER_INT);

 
// kirjaimia ja maksimissaan tietyn pituinen 
# Muodostetaan SQL-kysely
$sql ="UPDATE `antti1419henkilot` SET 
`sukunimi`=\"".$_POST["sukunimi"]."\", 
`etunimi`=\"".$_POST["etunimi"]."\",
`syntymavuosi`=\"".$_POST["syntymavuosi"]."\"
 WHERE id=".$id;
 #echo $sql;
$virhe = 0; 
#muista tarkistaa aina virheet palvelimen päässä-php.
#substr antaa nyt vain tulostaa ensimmäiset 5 kirj.
#$nimi = substr($nimi,0,5);

#Tarkistetaan onko syntymävuosi enemmän kuin nykyinen vuosi.
$now = date("Y");
if ( $syntymavuosi > $now || $syntymavuosi < 1900) {
  echo "<br><li><font color=\"red\">Virheellinen syntymävuosi</font></li>";
  
  $virhe++;
}

#jos EInumero niin virhe
if (!is_numeric($syntymavuosi))
{
$virhe++;
echo "<br> <li><font color=\"red\"> Syntymävuosikenttään tulee syättää vain numeroita</font></li>";

}
#Ei hyväksytä liian pitkiä nimiä
if (strlen($nimi) > 15 || strlen($sukunimi) > 20)
{
$virhe++;
echo "<br><li><font color=\"red\">suku- tai etunimi liian pitkä</font></li>";
}
#Onko numeroita syötteessä nimikentissä
if (strpbrk($sukunimi, '0123456789')||strpbrk($nimi, '0123456789'))
{
$virhe++;
echo "<br><li><font color=\"red\">suku- tai etunimi ei voi sisältää numeroita</font></li>";

}

#Onko nimissä erikoismerkkejä
if (preg_match('/[\'^£$%&*()}{@#~?!><>,|=_+¬]/', $nimi)||preg_match('/[\'^£$%&*()}{@#~?!><>,|=_+¬]/', $sukunimi))
{
$virhe++;
echo "<br><li><font color=\"red\">suku- tai etunimi sisältää kiellettyjä merkkejä</font></li>";
}

if (is_numeric($nimi)||is_numeric($sukunimi))
{
$virhe++;
echo "<br><li><font color=\"red\"> Nimi ei voi olla numeroita</font></li>";

}

#tarkistetaan virheiden määrä
if($virhe>0)
{
echo "<br><li><font color=\"red\">Kentissä virheellistä tietoa <p> <a href=harjEtusivu.html>palaa etusivulle</font></li>";
exit();
}
else {
# Ajetaan SQL-kysely. 
if($mysqli->query($sql) === false) {
 trigger_error('Virhe SQL:ssä: ' . $sql . ' Virhe: ' . $mysqli->error, E_USER_ERROR);
} else {
 echo "Muutokset tehty! <br>";
 echo "<p><a href=\"harjLisaa1.html\">Lisää käyttäjä</a></p>";
echo "<p><a href=\"harjPoista.php\">Poista tietoja</a></td></p>";
echo "<p><a href=\"harjEtusivu.html\">Etusivu</a></td></p>";
 echo "<a href=\"harjTulostatiedot.php\">katso tiedot</a></p>";
}
# Suljetaan yhteys tietokantapalvelimeen
$mysqli->close();
}
?>
</center>
</body>
</html>