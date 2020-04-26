<?php
include('../../config.php');
$postdata = file_get_contents("php://input"); 
    if (isset($postdata)) {
        $request = json_decode($postdata);
		$id = $_GET['id'] ; 
		
		$sql =  " DELETE from depot where id ='$id'" ;
		
        $result = mysqli_query($conn, $sql);
		if ($result===true) {	
			echo json_encode(array( 'RESPONSE'=>'Depot  supprimee' )); 
		}else {
			echo json_encode(array( 'RESPONSE'=>'Erreur suppression ' )); 
		}
    }
    else {
		echo json_encode(array( 'RESPONSE'=>'Erreur5' ));  
		}
?> 