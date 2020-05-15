<?php
include('../config.php');

$postdata = file_get_contents("php://input"); 

    if (isset($postdata)) {
		
        $request = json_decode($postdata);
		
		$nreception = $_GET['nreception'] ;
		$nligne1 = $_GET['nligne'] ;

		$sql =  "DELETE FROM stock WHERE nreception='$nreception' AND nligne='$nligne1'";
        $result = mysqli_query($conn, $sql);
		
		
		$nbrow = mysqli_affected_rows($conn);
		
		if ($nbrow>0) { 
		
		echo json_encode(array('resp'=>"ln $nligne : reception $nreception supp" ));
		
		}
		
		else {echo json_encode(array( 'resp'=>'erreur suup ln'));}
	

	
    }

    else {echo ('Erreur suppart parametres'); }
 
?> 