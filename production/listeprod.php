<?php
include('../config.php');
$postdata = file_get_contents("php://input"); 
    if (isset($postdata)) {
        $request = json_decode($postdata);
		
		$sql =  "SELECT  dateprod, datesys, COUNT(id_produit) as Nbreproduit , SUM(qteproduction) as quantiteproduction, 
		 SUM(prixTotal) as prixTotal  FROM production  GROUP BY (dateprod)" ;
		
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