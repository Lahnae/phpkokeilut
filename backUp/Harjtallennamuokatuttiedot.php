<html>
<head><title></title></head>
<body>
<?

# Otetaan yhteys tietokantapalvelimeen
$mysqli = new mysqli('localhost', 'trtknu14a3', 'tr54!1', 'trtknu14a3');
if(mysqli_connect_errno()) {
 echo "Tietokantayhteys ei onnistunut " . mysqli_connect_errno();
 exit();
}

# Alla tutkitaan, että saadaanko ID tai ei ole numero
if (!$_POST["id"] or !is_numeric($_POST["id"])) {
 echo "Virhe! ID ei numero";
 exit();
}

$id = $_POST["id"];

// Tarkistetaan k?t?n sy??et
$nimi = $mysqli->real_escape_string($_POST["nimi"]);
$pisteet = filter_var($_POST["pisteet"],FILTER_SANITIZE_NUMBER_INT);

// T??ohtaa voitaisiin tarkistaa, ett?isteet on numeroita, nimi on 
// kirjaimia ja maksimissaan tietyn pituinen 

# Muodostetaan SQL-kysely
$sql ="UPDATE `antti1419henkilot` SET 
`sukunimi`=\"".$_POST["sukunimi"]."\",
`etunimi`=\"".$_POST["etunimi"]."\", 
`syntymavuosi`=\"".$_POST["syntymavuosi"]."\" 
WHERE id=".$id;

echo $sql;


# Ajetaan SQL-kysely. 
if($mysqli->query($sql) === false) {
 trigger_error('Virhe SQL:ssä: ' . $sql . ' Virhe: ' . $mysqli->error, E_USER_ERROR);
} else {
 echo "Muutokset tehty!";
}

# Suljetaan yhteys tietokantapalvelimeen
$mysqli->close();

?>
</body>
</html>