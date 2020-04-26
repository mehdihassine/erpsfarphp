<?php
include('../config.php');
$postdata = file_get_contents("php://input"); 
    if (isset($postdata)) {
        $request = json_decode($postdata);
		$idtype = $_GET['idtype']; 
		$sql =  "  DELETE FROM `categorie` WHERE idtype ='$idtype'" ; 
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