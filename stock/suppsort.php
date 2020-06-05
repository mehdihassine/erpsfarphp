<?php
include('../config.php');

$postdata = file_get_contents("php://input"); 

    if (isset($postdata)) {
		
        $request = json_decode($postdata);
		
		$datesort = $_GET['datesortie'] ;
		

		$sql =  "DELETE FROM stock WHERE `datesortie` ='$datesort' ";
        $result = mysqli_query($conn, $sql);
		
		
		$nbrow = mysqli_affected_rows($conn);
		
		if ($nbrow>0) { 
		
		echo json_encode(array('resp'=>" sort $datesort supp" ));
		
		}
		
		else {echo json_encode(array( 'resp'=>'erreur suup sorti'));}
	

	
    }

    else {echo ('Erreur suppart parametres'); }
 
?> 