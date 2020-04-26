<?php
include('../config.php');

$postdata = file_get_contents("php://input"); 

    if (isset($postdata)) {
		
        $request = json_decode($postdata);
		$iduser=$_GET['iduser'];



		$sql =  "SELECT * FROM `user` WHERE `iduser`=$iduser" ;
        $result = mysqli_query($conn, $sql);
		
		if ($result->num_rows > 0) {	
		
			while($row = mysqli_fetch_assoc($result))
			$tab[] =$row; 
		
		
			echo(json_encode($tab[0])); 
			

		}
		
		else { 
			echo json_encode(array( 'RESPONSE'=>'erreur php get user' )); 
		}
	



	
    }

    else {
		echo json_encode(array( 'RESPONSE'=>'Erreur utilisateur parametres' ));  
    }
 
?> 