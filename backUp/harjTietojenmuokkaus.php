<html>
<head><title>Tietojenmuokkaus</title></head>
<center>
<body>

<?php

# Otetaan yhteys tietokantapalvelimeen
$mysqli = new mysqli('localhost', 'trtknu14a3', 'tr54!1', 'trtknu14a3');

if(mysqli_connect_errno()) {
      echo "Tietokantayhteys ei onnistunut " . mysqli_connect_errno();
      exit();
} 

# Haetaan auto, joka id-saatiin URL:stä
$sql ="SELECT * FROM `antti1419henkilot` where `id`=".$_GET["id"];

#Ajetaan SQL-kysely 
if(!$result = $mysqli->query($sql)){
 die('SQL-kysely epäonnistui [' . $mysqli->error . ']');
}

# Haetaan vain yksi rivi, eli ei turhaan luupata tietoja
$row = mysqli_fetch_assoc($result);

	
?>


<form method="post" action="harjTallennatiedot.php">

<input type="hidden" name="id" value="<?php echo $row['id']; ?>"></p>
<p><label>Sukunimi </label> <input type="text" name="sukunimi" value="<?php echo $row['sukunimi'];?>" ></p>
<p><label>Etunimi </label> <input type="text" name="etunimi" value="<?php echo $row['etunimi']; ?>"></p>
<p><label>Syntymavuosi </label> <input type="text" name="syntymavuosi" value="<?php echo $row['syntymavuosi']; ?>"></p>
<p><input type="submit" value="Tallenna"></p>

</form>
</center> 
</body>
</html>