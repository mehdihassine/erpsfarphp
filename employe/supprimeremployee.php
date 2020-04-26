<?php
include('../config.php');
$postdata = file_get_contents("php://input"); 
    if (isset($postdata)) {
        $request = json_decode($postdata);
		$idemploye = $_GET['idemploye'] ; 
		$sql =  " DELETE FROM `employee` WHERE idEmployee='$idemploye'" ;
		
        $result = mysqli_query($conn, $sql);
		if ($result===true) {	

			echo json_encode(array( 'RESPONSE'=>' employee supprimer ' )); 
		}else {
			
			echo json_encode(array( 'RESPONSE'=>'Erreur suppression ' )); 
		}
    }
    else {
		echo json_encode(array( 'RESPONSE'=>'Erreur supprimer employee' ));  
		}
?> 