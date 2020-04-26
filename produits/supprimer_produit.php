<?php
include('../config.php');
$postdata = file_get_contents("php://input"); 
    if (isset($postdata)) {
        $request = json_decode($postdata);
		$id = $_GET['X'] ; 
		$sql =  " DELETE FROM `produit` WHERE idProduit='$id'" ;
		
        $result = mysqli_query($conn, $sql);
		if ($result===true) {	
			echo json_encode(array( 'RESPONSE'=>' produit supprimer ' )); 
		}else {
			echo json_encode(array( 'RESPONSE'=>'Erreur suppression ' )); 
		}
    }
    else {
		echo json_encode(array( 'RESPONSE'=>'Erreur supprimer etudiant' ));  
		}
?> 