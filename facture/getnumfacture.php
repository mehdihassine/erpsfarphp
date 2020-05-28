<?php
include('../config.php');

$postdata = file_get_contents("php://input"); 

    if (isset($postdata)) {

		
		
		$request = json_decode($postdata);
		

		// get : type facture = 3 reslt
		// 3 if 
		// if 1 : type= vente => 

		$sql =  "SELECT MAX(nfacture) As nfacture FROM facturevente" ;
        $result = mysqli_query($conn, $sql);
		
		if ($result->num_rows > 0) {	
		
			while($row = mysqli_fetch_assoc($result))
			$tab[] =$row; 
		
		$tab[0]['nfacture'] = $tab[0]['nfacture']+1;
		
		
			echo(json_encode($tab[0])); 
			

		}
		
		else { 
			echo json_encode(array( 'RESPONSE'=>'erreur php get facture' )); 
		}
	



	
    }

    else {
		echo json_encode(array( 'RESPONSE'=>'Erreur facture parametres' ));  
    }
 
?> 