<?php
include('../config.php');

$postdata = file_get_contents("php://input"); 

    if (isset($postdata)) {
		
        $request = json_decode($postdata);
		$nfacture = $_GET['nfacture'] ; 

		$sql =  "DELETE FROM `facturedivers` WHERE `nfacture`='$nfacture' ";
        $result = mysqli_query($conn, $sql);
				
		
		if ($result===true) { 
			echo json_encode(array( 'resp'=>'supprimee' ));
						
		}
		
		else {
			echo json_encode(array( 'resp'=>'erreur sppression' )); 
		}
	



	
    }

    else {
		echo ('Erreur commande parametres');  
    }
 
?> 