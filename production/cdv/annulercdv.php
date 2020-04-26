<?php
include('../config.php');

$postdata = file_get_contents("php://input"); 

    if (isset($postdata)) {
		
        $request = json_decode($postdata);
		$id = $_GET['id'] ; 

		$sql =  "DELETE FROM `cdv` WHERE `ncommande`='$id'";
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