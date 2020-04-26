<?php
include('../config.php');

$postdata = file_get_contents("php://input"); 

    if (isset($postdata)) {
		
        $request = json_decode($postdata);
		
		
				
		
		$id_produit = $_GET['id_produit'] ; 



		if(!is_numeric($id_produit)){
		$sql =  "SELECT * FROM production ,produit 
        where produit.idProduit=production.id_produit
		 GROUP BY (dateprod)"  ;
		}
		
		else{
		$sql =  "SELECT * FROM production ,produit 
		 where production.id_produit='$id_produit' 
		 AND  produit.idProduit=production.id_produit
		 GROUP BY (dateprod)"   ;
		}


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