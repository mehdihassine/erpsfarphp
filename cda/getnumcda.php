<?php
include('../config.php');

$postdata = file_get_contents("php://input"); 

    if (isset($postdata)) {
		
        $request = json_decode($postdata);

		$sql =  "SELECT MAX(nreception) As id FROM cda" ;
        $result = mysqli_query($conn, $sql);
		
		if ($result->num_rows > 0) {	
		
			while($row = mysqli_fetch_assoc($result))
			$tab[] =$row; 
		
		$tab[0]['id'] = $tab[0]['id']+1;
		$tab[0]['id2']=$tab[0]['id']-1;
		
			echo(json_encode($tab[0])); 
			

		}
		
		else { 
			echo json_encode(array( 'RESPONSE'=>'erreur php get reception' )); 
		}
	



	
    }

    else {
		echo json_encode(array( 'RESPONSE'=>'Erreur reception parametres' ));  
    }
 
?> 