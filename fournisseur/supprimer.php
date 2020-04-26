<?php
include('../config.php');
$postdata = file_get_contents("php://input"); 
    if (isset($postdata)) {
        $request = json_decode($postdata);
		$idfr = $_GET['idfr']; 
		
		$sql =  "  DELETE FROM fournisseur where idfr = '$idfr'   " ; 
        $result = mysqli_query($conn, $sql);
		if ($result===true) {	
			echo json_encode(array( 'RESPONSE'=>' suppression avec succes' )); 
		}else { 
			echo json_encode(array( 'RESPONSE'=>'Erreur suppression' )); 
		}
    }
    else {
		echo json_encode(array( 'RESPONSE'=>'Erreur reception parametres' ));  
    }
 
?> 
 