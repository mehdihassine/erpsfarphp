<?php
include('../config.php');

$postdata = file_get_contents("php://input"); 

    if (isset($postdata)) {
		
        $request = json_decode($postdata);

		$id = $_GET['id'] ; 


		$sql =  "SELECT MAX(nligne) as nl FROM `cdv` WHERE `ncommande`='$id'" ;
        $result = mysqli_query($conn, $sql);
		
		if ($result->num_rows > 0) {	
		
			while($row = mysqli_fetch_assoc($result))
			$tab[] =$row; 
		
		$ligne = intval( $tab[0]['nligne']);
		
		$tab[0]['nl'] = $tab[0]['nl']+1;
		$tab[0]['nl2']=$tab[0]['nl']-1;
		
			echo(json_encode($tab[0])); 
		
	
			

		}
		
		else { 
			echo json_encode(array( 'RESPONSE'=>'erreur php get ligne' )); 
		}
	



	
    }

    else {
		echo json_encode(array( 'RESPONSE'=>'Erreur commande parametres' ));  
    }
 
?> 