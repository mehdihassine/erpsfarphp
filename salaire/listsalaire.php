<?php
include('../config.php');
$postdata = file_get_contents("php://input"); 
    if (isset($postdata)) {
		$request = json_decode($postdata);
		$etat='valider';
		
		$sql =  "  SELECT * FROM salaire sa, employee e, specialiter s 
		WHERE e.specialiteEmployee = s.idspecialiter
		AND sa.idemploye=e.idEmployee AND sa.etat='$etat'
		" ;
		
        $result = mysqli_query($conn, $sql);
		if ($result->num_rows > 0) {	
			while($row = mysqli_fetch_assoc($result))
			$tab[] =$row; 
			print(json_encode($tab)); 
		}else { 
			echo json_encode(array( 'RESPONSE'=>'Aucune employee trouvee' )); 
		}
    }
    else {
		echo json_encode(array( 'RESPONSE'=>'Erreur reception parametres' ));  
    }
 
?> 
 