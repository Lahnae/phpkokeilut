<!DOCTYPE  HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"  "http://www.w3.org/TR/html4/loose.dtd"> 
	<html> 
	  <head> 
	    <meta  http-equiv="Content-Type" content="text/html;  charset=iso-8859-1"> 
	    <title>Search  Contacts</title> 
	  </head>
	  <center>
	  <p><body> 
	    <h3>Etsi käyttäjiä</h3> 
	    <p>Hae käyttäjiä kirjoittamalla käyttäjän etu- tai sukunimi</p> 
	    <form  method="post" action="harjEtsi.php?go"  id="searchform"> 
	      <input  type="text" name="name"> 
	      <input  type="submit" name="submit" value="Search"> 
	    </form> 
	<?php 
	$virhe = 0;
	#haetaan kentän tiedot
	  if(isset($_POST['submit'])){ 

		if(isset($_GET['go'])){ 

	  if(preg_match("/[A-Za-z]+/", $_POST['name'])){ 

	   $name=$_POST['name']; 
	  } 
	}
	#tarkistetaan ettei erikoismerkkejä sisälly syötteeseen
	if (preg_match('/[\'^£$%&*()}{@#~?!><>,|=_+¬-]/', $name))
	{
	$virhe ++;
	echo "<br><li><font color=\"red\">Hakukenttä ei saa sisältää erikoismerkkejä!</font></li>";
	}
	  
	  $mysqli = new mysqli('localhost', 'trtknu14a3', 'tr54!1', 'trtknu14a3');

	if(mysqli_connect_errno()) {
      echo "Tietokantayhteys ei onnistunut " . mysqli_connect_errno();
      exit();
	} 
	  
	#jos virheitä
	if($virhe>0)
	{
	echo " <br><li><font color=\"red\"> Kentissä virheellistä tietoa <p> <a href=harjEtusivu.html>Palaa etusivulle</a></font></p></li>";
	}  
	  	  
	  else{ 
	  echo  "<p>Syötä hakusana</p>"; 
	  
	  $sql="SELECT * FROM `antti1419henkilot` WHERE  `sukunimi`  LIKE '%" . $name . "%' OR `etunimi` LIKE '%" . $name  ."%'"; 
	  	  
	  #Ajetaan SQL-kysely 
	  
	if(!$result = $mysqli->query($sql)){
    die('SQL-kysely epäonnistui [' . $mysqli->error . ']');
	}	
	
	 $result = $mysqli->query($sql);
	 	
	   while ($row = mysqli_fetch_array($result))
	   { 
    
	          $etunimi  =$row['etunimi']; 
	          $sukunimi=$row['sukunimi']; 
	          $ID=$row['id']; 
			  
	  //Tulostetaan nimet
	  echo "<table>";
	  echo "<tr><ul>\n"; 
	  echo "<td><li>" . "<a  href=\"harjTietojenmuokkaus.php?id=$ID\">"   .$sukunimi . " " . $etunimi .  "</a></li></td>\n"; 
	  echo "</ul></tr>"; 
	  echo "</table>";
	   }
	  }	  
	  } 
	  
	#Linkit muille sivuille.
echo "<p><a href=\"HarjLisaa.html?id=".$row['id'] . "\">Lisää tietoja</a></td></p>";
echo "<p><a href=\"harjPoista.php?id=".$row['id'] . "\">Poista tietoja</a></td></p>";
echo "<p><a href=\"harjEtusivu.html?id=".$row['id'] . "\">Etusivu</a></td></p>";
	  	  
	?>  
			
	 </body> 
	 </center>
	</html> 
	