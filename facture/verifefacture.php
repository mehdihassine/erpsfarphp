<?php
include('../config.php');

$postdata = file_get_contents("php://input"); 

    if (isset($postdata)) {
		
        $request = json_decode($postdata);
		
		$nfacture = $_GET['nfacture'] ; 

		$sql =  "SELECT nligne FROM facture where nfacture='$nfacture' AND `type`='vente'" ;
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