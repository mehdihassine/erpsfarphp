<?php
include('../config.php');

$postdata = file_get_contents("php://input"); 

    if (isset($postdata)) {
		
        $request = json_decode($postdata);
		
		
				
		
		$ncommande = $_GET['ncommande'] ; 



		if(!is_numeric($ncommande)){
		$sql =  "SELECT ncommande, statut, COUNT(codarticle) as codarticle, SUM(montanttotal) as montanttotal,
		usercreation, datecreation FROM cdv GROUP BY (ncommande)" ;
		}
		
		else{
		$sql =  "SELECT ncommande, statut, COUNT(codarticle) as codarticle, SUM(montanttotal) as montanttotal,
		usercreation, datecreation FROM cdv where ncommande='$ncommande' GROUP BY (ncommande)" ;
		}


        $result = mysqli_query($conn, $sql);
		
		if ($result->num_rows > 0) {	
		
			while($row = mysqli_fetch_assoc($result))
			$tab[] =$row; 
		
		echo json_encode($tab); 
			

		}
		
		else { 
		
		$tab[0]['respo'] = 'erreurcdv';
		echo json_encode($tab);
		
		}
	



	
    }

    else {
		echo ('Erreur liste cdv parametres');  
    }
 
?> 