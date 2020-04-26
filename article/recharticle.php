<?php
include('../config.php');

$postdata = file_get_contents("php://input"); 

    if (isset($postdata)) {
		
        $request = json_decode($postdata);
		
		
				
		
		$codearticle = $_GET['codearticle'] ; 



	
		
		
		$sql =  "select * from article where codearticle='$codearticle' "   ;
	


        $result = mysqli_query($conn, $sql);
		
		if ($result->num_rows > 0) {	
		
			while($row = mysqli_fetch_assoc($result))
			$tab[] =$row; 
		
		echo json_encode($tab); 
			

		}
		
		else { 
		
		$tab[0]['respo'] = 'erreurarticle';
		echo json_encode($tab);
		
		}
	



	
    }

    else {
		echo ('Erreur liste article parametres');  
    }
 
?> 