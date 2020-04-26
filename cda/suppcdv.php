<?php
include('../config.php');

$postdata = file_get_contents("php://input"); 

    if (isset($postdata)) {
		
        $request = json_decode($postdata);
		
		$ncommande = $_GET['ncommande'] ;

		$sql =  "DELETE FROM cdv WHERE ncommande='$ncommande'";
        $result = mysqli_query($conn, $sql);
		
		
		$nbrow = mysqli_affected_rows($conn);
		
		if ($nbrow>0) { 
		
		echo json_encode(array('resp'=>"cdv $ncommande supprimee" ));
		
		}
		
		else {echo json_encode(array( 'resp'=>'erreur sup cdv'));}
	

	
    }

    else {echo ('Erreur suppart parametres'); }
 
?> 