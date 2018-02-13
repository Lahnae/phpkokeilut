<!DOCTYPE  HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"  "http://www.w3.org/TR/html4/loose.dtd"> 
	<html> 
	  <head> 
	    <meta  http-equiv="Content-Type" content="text/html;  charset=iso-8859-1"> 
	    <title>Search  Contacts</title> 
	  </head> 
	  <p><body> 
	    <h3>Search  Contacts Details</h3> 
	    <p>You  may search either by first or last name</p> 
	    <form  method="post" action="harjEtsi.php?go"  id="searchform"> 
	      <input  type="text" name="name"> 
	      <input  type="submit" name="submit" value="Search"> 
	    </form> 
	<?php 

	  if(isset($_POST['submit'])){ 

		if(isset($_GET['go'])){ 

	  if(preg_match("/[A-Za-z]+/", $_POST['name'])){ 

	   $name=$_POST['name']; 
	  } 
	}
	  
	  
	  $mysqli = new mysqli('localhost', 'trtknu14a3', 'tr54!1', 'trtknu14a3');

	if(mysqli_connect_errno()) {
      echo "Tietokantayhteys ei onnistunut " . mysqli_connect_errno();
      exit();
	} 
	  
	  
	  $sql="SELECT * FROM `antti1419henkilot` WHERE  `sukunimi`  LIKE '%" . $name . "%' OR `etunimi` LIKE '%" . $name  ."%'"; 
	  
	  
	  #Ajetaan SQL-kysely 
	  
	if(!$result = $mysqli->query($sql)){
    die('SQL-kysely epäonnistui [' . $mysqli->error . ']');
	}
	
	
	 $result = $mysqli->query($sql);
	 
	
	   while ($row = mysqli_fetch_array($result))
	   { 
    
	          $FirstName  =$row['sukunimi']; 
	          $LastName=$row['etunimi']; 
	          $ID=$row['id']; 
			  
	  //-display the result of the array 
	  echo "<ul>\n"; 
	  echo "<li>" . "<a  href=\"search.php?id=$ID\">"   .$FirstName . " " . $LastName .  "</a></li>\n"; 
	  echo "</ul>"; 
	   }
	  }
	  
	  
	  else{ 
	  echo  "<p>Please enter a search query</p>"; 
	  } 
	  
	  
	  
	  
	  
	?>  
	
		
	 </body> 
	</html> 
	