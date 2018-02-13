<html>
<head><title>Tietojenmuokkaus</title></head>
<center>
<body style="margin-top:10%;">

<?php

# Otetaan yhteys tietokantapalvelimeen
$mysqli = new mysqli('localhost', 'trtknu14a3', 'tr54!1', 'trtknu14a3');

if(mysqli_connect_errno()) {
      echo "Tietokantayhteys ei onnistunut " . mysqli_connect_errno();
      exit();
} 

# Haetaan tiedot, joka id-saatiin URL:stä
$sql ="SELECT * FROM `antti1419henkilot` where `id`=".$_GET["id"];

#Ajetaan SQL-kysely 
if(!$result = $mysqli->query($sql)){
 die('SQL-kysely epäonnistui [' . $mysqli->error . ']');
}

# Haetaan vain yksi rivi, eli ei turhaan luupata tietoja
$row = mysqli_fetch_assoc($result);


	
?>
<h1>Tietojen muokkaus</h1>
<!-- kuinka saada kaksi columnia sukunimi etunimi samaan tulostukseen?-->
<p>Muokkaa käyttäjän <?php echo $row['sukunimi']; echo " "; echo $row['etunimi'] ;?> tietoja</p>
<form method="post" action="harjTallennatiedot.php">
<input type="hidden" name="id" value="<?php echo $row['id']; ?>"></p>
<table>
<tr>
	<td><p><label>Sukunimi </label></td>
	<td><input type="text" name="sukunimi" value="<?php echo $row['sukunimi'];?>" ></p></td>
</tr>
<tr>
	<td><p><label>Etunimi </label></td>
	<td><input type="text" name="etunimi" value="<?php echo $row['etunimi']; ?>"></p></td>
</tr>
<tr>
	<td><p><label>Syntymavuosi </label></td>
	<td><input type="text" name="syntymavuosi" value="<?php echo $row['syntymavuosi']; ?>"></p></td>
</tr>

</table>
<tr><p><input type="submit" value="Tallenna"></p></tr>
</form>
<?php
echo "<a href=\"harjTulostatiedot.php\">katso tiedot</a></p>";
  echo "<br><a href=\"harjEtusivu.html\">Etusivu</a></p>";
  echo "<br><a href=\"harjLisaa1.html\">Lisää käyttäjä</a></p>";
  echo "<br><a href=\"harjPoista.php\">Poista käyttäjä</a></p>";
?>
</center> 
</body>
</html>