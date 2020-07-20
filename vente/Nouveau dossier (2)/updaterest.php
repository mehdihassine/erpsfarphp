<?php
include('../config.php');
$postdata = file_get_contents("php://input"); 
    if (isset($postdata)) {
        $request = json_decode($postdata);
		$dateprod= $_GET['dateprod'];
		
		$sql =  "SELECT * FROM production p ,produit pr WHERE dateprod='$dateprod' AND p.id_produit=pr.idProduit" ;
		
        $result = mysqli_query($conn, $sql);
		if ($result->num_rows > 0) {	
			while($row = mysqli_fetch_assoc($result))
			$tab[] =$row; 
			print(json_encode($tab)); 
		}
		
		else { 
			echo json_encode(array( 'RESPONSE'=>'Aucune production trouvee' )); 
		}
    }
    else {
		echo json_encode(array( 'RESPONSE'=>'Erreur reception parametres' ));  
    }
	
	// 			
?> 