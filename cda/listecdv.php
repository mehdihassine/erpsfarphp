<?php
include('../config.php');

$postdata = file_get_contents("php://input"); 

    if (isset($postdata)) {
		
        $request = json_decode($postdata);
		$id = $_GET['id'] ; 

		$sql =  "SELECT ncommande, statut, COUNT(codarticle) as codarticle, SUM(montanttotal) as montanttotal, usercreation, datecreation FROM cdv GROUP BY (ncommande)" ;
        $result = mysqli_query($conn, $sql);
		
		if ($result->num_rows > 0) {	
		
			while($row = mysqli_fetch_assoc($result))
			$tab[] =$row; 
		
		echo json_encode($tab); 
			

		}
		
		else { 
			print json_encode( "0 cdv trouvees"); 
		}
	



	
    }

    else {
		echo ('Erreur liste cdv parametres');  
    }
 
?> 