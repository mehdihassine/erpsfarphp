<?php
include('../config.php');

$postdata = file_get_contents("php://input"); 

    if (isset($postdata)) {
		
        $request = json_decode($postdata);
		$id = $_GET['id'] ; 

		$sql =  "SELECT * FROM cdv, article where cdv.ncommande ='$id' and cdv.codartid = article.id order by nligne" ;
        $result = mysqli_query($conn, $sql);
		
		if ($result->num_rows > 0) {	
		
			while($row = mysqli_fetch_assoc($result))
			$tab[] =$row; 
		
			print json_encode($tab); 
			

		}
		
		else { 
			print json_encode("getartcdv : $id"); 
		}
	



	
    }

    else {
		echo ('Erreur commande parametres');  
    }
 
?> 