<?php
include('../config.php');
$postdata = file_get_contents("php://input"); 
    if (isset($postdata)) {
        $request = json_decode($postdata);
		$id = $_GET['X'] ; 
		$etat='archiver';
		$sql =  " UPDATE `salaire` SET  `etat`='$etat' WHERE idsalaire='$id'" ;
		
        $result = mysqli_query($conn, $sql);
		if ($result===true) {	
			echo json_encode(array( 'RESPONSE'=>' salaire supprimer ' )); 
		}else {
			echo json_encode(array( 'RESPONSE'=>'Erreur suppression ' )); 
		}
    }
    else {
		echo json_encode(array( 'RESPONSE'=>'Erreur supprimer salaire' ));  
		}
?> 