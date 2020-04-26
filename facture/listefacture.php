<?php
include('../config.php');
$postdata = file_get_contents("php://input"); 
    if (isset($postdata)) {
        $request = json_decode($postdata);
		
		$sql =  "SELECT nfacture, type, COUNT(nligne) as nligne, datesys, SUM(montanttotal) as montanttotal, etat FROM facture GROUP BY nfacture,type" ;
		
        $result = mysqli_query($conn, $sql);
		if ($result->num_rows > 0) {	
			while($row = mysqli_fetch_assoc($result))
			$tab[] =$row; 
			print(json_encode($tab)); 
		}
		
		else { 
			echo json_encode(array( 'RESPONSE'=>'Aucune facture trouvee' )); 
		}
    }
    else {
		echo json_encode(array( 'RESPONSE'=>'Erreur facture parametres' ));  
    }
	
	// 			
?> 