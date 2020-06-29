<?php
include('../config.php');

$postdata = file_get_contents("php://input"); 

    if (isset($postdata)) {
		
        $request = json_decode($postdata);
		
		$dateprod = $_GET['dateprod'] ;
		

		$sql =  "DELETE FROM vente WHERE dateprod='$dateprod' ";
        $result = mysqli_query($conn, $sql);
		
		
		$nbrow = mysqli_affected_rows($conn);
		
		if ($nbrow>0) { 
		
		echo json_encode(array('resp'=>" prod $dateprod supp" ));
		
		}
		
		else {echo json_encode(array( 'resp'=>'erreur suup prod'));}
	

	
    }

    else {echo ('Erreur suppart parametres'); }
 
?> 