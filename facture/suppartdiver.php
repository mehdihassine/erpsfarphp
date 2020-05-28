<?php
include('../config.php');

$postdata = file_get_contents("php://input"); 

    if (isset($postdata)) {
		
        $request = json_decode($postdata);
		
		$nfacture = $_GET['nfacture'] ;
		$nligne = $_GET['nligne'] ;

		$sql =  "DELETE FROM facturedivers WHERE nfacture='$nfacture' AND nligne='$nligne' ";
        $result = mysqli_query($conn, $sql);
		
		
		$nbrow = mysqli_affected_rows($conn);
		
		if ($nbrow>0) { 
		
		echo json_encode(array('resp'=>"ln $nligne : facture $nfacture supp" ));
		
		}
		
		else {echo json_encode(array( 'resp'=>'erreur suup ln'));}
	

	
    }

    else {echo ('Erreur suppart parametres'); }
 
?> 