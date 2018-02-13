<html>
<head><title>poista tiedot</title></head>
<body>
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
#id tulisi tutkia, tietosuoja.
$id = $_GET["id"]; 

# Muodostetaan SQL-kysely
$sql ="DELETE FROM `antti1419_henkilot` WHERE id=".$id;


# Ajetaan SQL-kysely. Huomaa samankaltaisuus tietojen lisäämisen kanssa
if($mysqli->query($sql) === false) {

  trigger_error('Virhe SQL:ssä: ' . $sql . ' Virhe: ' . $mysqli->error, E_USER_ERROR);
} else {
  echo "Monta tietuetta poistettiin: " . $mysqli->affected_rows;
  #linkki takaisin poisto sivulle.
  echo "<p><a href=\"poista.php\">katso tiedot</a></p>";
}

# Suljetaan yhteys tietokantapalvelimeen
$mysqli->close();

?>
</body>
</html>