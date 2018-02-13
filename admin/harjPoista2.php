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
if (!$_GET["id"])  {
  echo "Anna URL:ssä poistettavan tietueen id";
  exit();
}
#id tutkitaan että numero

if (!is_numeric ($id = $_GET["id"])) {
	echo "<br><li><font color=\"red\"> VIRHELLINEN ID! <p> <a href=harjEtusivu.html>Palaa etusivulle</a></font></p></li>";
	echo "<p><a href=\"harjPoista.php\">katso tiedot</a></p>";
    echo "<br><a href=\"harjEtusivu.html\">Etusivu</a></p>";
	echo "<br><a href=\"harjLisaa1.html\">Lisää käyttäjä</a></p>";
	echo "<br><a href=\"harjPoista.php\">Poista käyttäjä</a></p>";
	exit();
} 
else
{

# Muodostetaan SQL-kysely
$sql ="DELETE FROM `antti1419henkilot` WHERE id=".$id;


# Ajetaan SQL-kysely. Huomaa samankaltaisuus tietojen lis��misen kanssa
if($mysqli->query($sql) === false) {

  trigger_error('Virhe SQL:ssä: ' . $sql . ' Virhe: ' . $mysqli->error, E_USER_ERROR);
} else {
  echo "Monta tietuetta poistettiin: " . $mysqli->affected_rows;
  #linkki takaisin poisto sivulle.
  echo "<p><a href=\"harjPoista.php\">katso tiedot</a></p>";
    echo "<br><a href=\"harjEtusivu.html\">Etusivu</a></p>";
  echo "<br><a href=\"harjLisaa1.html\">Lisää käyttäjä</a></p>";
  echo "<br><a href=\"harjPoista.php\">Poista käyttäjä</a></p>";
}
}
# Suljetaan yhteys tietokantapalvelimeen
$mysqli->close();

?>
</center>
</body>
</html>