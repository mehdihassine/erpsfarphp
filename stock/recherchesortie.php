<?php
include('../config.php');

$postdata = file_get_contents("php://input"); 

    if (isset($postdata)) {
		
        $request = json_decode($postdata);
		
		
				
		
		$datesortie = $_GET['datesortie'] ; 

		$etat='sortie';

		
		
	
		
		$sql =  "SELECT  datesortie, COUNT(article_id) as nbrarticle ,
		 SUM(qtesortie) as quantiterecep
		 FROM stock   WHERE etat='$etat' and datesortie=$datesortie   GROUP BY datesortie " ;
	


        $result = mysqli_query($conn, $sql);
		
		if ($result->num_rows > 0) {	
		
			while($row = mysqli_fetch_assoc($result))
			$tab[] =$row; 
		
		echo json_encode($tab); 
			

		}
		
		else { 
		
		$tab[0]['respo'] = 'erreursortie';
		echo json_encode($tab);
		
		}
	



	
    }

    else {
		echo ('Erreur liste prod parametres');  
    }
 
?> 