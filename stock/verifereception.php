<?php
include('../config.php');

$postdata = file_get_contents("php://input"); 

    if (isset($postdata)) {
		
        $request = json_decode($postdata);
		
		$nreception = $_GET['nreception'] ; 

		$sql =  "SELECT nligne FROM stock where nreception='$nreception'" ;
        $result = mysqli_query($conn, $sql);
		
		if ($result->num_rows > 0) {	                       
		
			
			echo json_encode(array( 'resp'=>"1" ));
			
			}
			
			else {
			echo json_encode(array( 'resp'=>"0" ));		}
	
	
    }

    else {
		echo ('Erreur commande parametres');  
    }
 
?> 