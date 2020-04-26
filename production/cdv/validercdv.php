<?php
include('../config.php');

$postdata = file_get_contents("php://input"); 

    if (isset($postdata)) {
		
        $request = json_decode($postdata);
		$id = $_GET['id'] ; 

		$sql =  "UPDATE `cdv` SET `statut`='valide' WHERE `ncommande` = '$id'";
        $result = mysqli_query($conn, $sql);
		
				
		$nbrow = mysqli_affected_rows($conn);

		
		if ($nbrow>0) { 
		
		echo json_encode(array('resp'=>"cdv $id = validee" ));
		
		}
		
		else {echo json_encode(array( 'resp'=>'cdv non cree' ));}
	



	
    }

    else {
		echo ('Erreur commande parametres');  
    }
 
?> 