<?php
include('../config.php');

$postdata = file_get_contents("php://input"); 

    if (isset($postdata)) {
		
        $request = json_decode($postdata);
		
		
				
		
		$idproduit = $_GET['idproduit'] ; 

		
		$sql =  "SELECT * FROM vente ,produit 
		 where vente.idproduit='$idproduit' 
		 AND  produit.idProduit=vente.idproduit ORDER BY (vente.idproduit) ASC
		    ";
		


        $result = mysqli_query($conn, $sql);
		
		if ($result->num_rows > 0) {	
		
			while($row = mysqli_fetch_assoc($result))
			$tab[] =$row; 
		
		echo json_encode($tab); 
			

		}
		
		else { 
		
		$tab[0]['respo'] = 'erreurprod';
		echo json_encode($tab);
		
		}
	



	
    }

    else {
		echo ('Erreur liste prod parametres');  
    }
 
?> 