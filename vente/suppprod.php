<?php
include('../config.php');

$postdata = file_get_contents("php://input"); 

    if (isset($postdata)) {
		
        $request = json_decode($postdata);
		
		$idvente = $_GET['idvente'] ;
		

		$sql =  "DELETE FROM vente WHERE idvente='$idvente' ";
        $result = mysqli_query($conn, $sql);
		
		
		$nbrow = mysqli_affected_rows($conn);
		
		if ($nbrow>0) { 
		
		echo json_encode(array('resp'=>" prod $idvente supp" ));
		
		}
		
		else {echo json_encode(array( 'resp'=>'erreur suup prod'));}
	

	
    }

    else {echo ('Erreur suppart parametres'); }
 
?> 