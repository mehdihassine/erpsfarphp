<?php
include('../config.php');
$postdata = file_get_contents("php://input"); 
    if (isset($postdata)) {
        $request = json_decode($postdata);
		$id = $_GET['X'] ; 
		
		$sql =  "  select * from fournisseur where idfr='$id '" ;
		
        $result = mysqli_query($conn, $sql);
		if ($result->num_rows > 0) {	
			while($row = mysqli_fetch_assoc($result))
			$tab[] =$row; 
			print(json_encode($tab)); 
		}else { 
			echo json_encode(array( 'RESPONSE'=>'Aucune fournisseur trouvee' )); 
		}
    }
    else {
		echo json_encode(array( 'RESPONSE'=>'Erreur reception parametres' ));  
    }
 
?> 
 