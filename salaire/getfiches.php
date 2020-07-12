<?php
include('../config.php');
$postdata = file_get_contents("php://input"); 
    if (isset($postdata)) {
        $request = json_decode($postdata);
		$idsalaire =$_GET['idsalaire'] ; 
		$sql =  "  SELECT  * from employee e ,specialiter s ,salaire sa  WHERE sa.idsalaire= '$idsalaire' 
		And e.specialiteEmployee=s.idspecialiter AND sa.idemploye=e.idEmployee" ;
		
        $result = mysqli_query($conn, $sql);
		if ($result->num_rows > 0) {	
			$row = mysqli_fetch_assoc($result); 
			$tab[] =$row; 
			print(json_encode($tab)); 
		}else { 
			echo json_encode(array( 'RESPONSE'=>'Aucune ficher trouvee' )); 
		}
    }
    else {
		echo json_encode(array( 'RESPONSE'=>'Erreur ficher parametres' ));  
    }
 
?> 
 