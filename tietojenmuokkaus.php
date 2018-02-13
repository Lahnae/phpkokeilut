<html>
<head><title></title></head>
<body>
<?

# Otetaan yhteys tietokantapalvelimeen
$mysqli = new mysqli('localhost', 'trtknu14a3', 'tr54!1', 'trtknu14a3');

#virhe jos ei onnistu yhteys, ei kannata k?t?oikeasti koska tietosuoja k?ii.
if(mysqli_connect_errno()) {
      echo "Tietokantayhteys ei onnistunut " . mysqli_connect_errno();
      exit();
}

# Muodostetaan SQL-kysely
$sql ="SELECT * FROM `antti1419_henkilot` where `id`=".$_GET["id"];

#Ajetaan SQL-kysely 
if(!$result = $mysqli->query($sql)){
 die('SQL-kysely epäonnistui [' . $mysqli->error . ']');
}

# Haetaan vain yksi rivi, eli ei turhaan luupata tietoja, ei luupata whilellä koska haetaan vain yksi tieto
$row = mysqli_fetch_assoc($result);

?>

<form method="post" action="tallenna.php">

<label>Nimi</label>
<p><input type="text" name="nimi" value="<?php echo $row['etunimi']; ?>"></P>

<br>

<label>Pisteet</label>
<P><input type="text" name="pisteet" value="<?php echo $row['pisteet']; ?>"></P>

<br>

<p><input type="submit" value="Tallenna"></p>
<a href=poista.php>Poista</a></td>
<br>
<a href=lisaa.html>Lisää tietoja</a></td>

</form>
</body>
</html>