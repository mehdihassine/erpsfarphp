<?php
include('../config.php');

$postdata = file_get_contents("php://input"); 

    if (isset($postdata)) {
		
        $request = json_decode($postdata);

		$sql =  "SELECT MAX(nfacture) As nfacture FROM facture" ;
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