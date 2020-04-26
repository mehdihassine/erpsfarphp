<?php
include('../config.php');
$postdata = file_get_contents("php://input"); 
    if (isset($postdata)) {
        $request = json_decode($postdata);
		$specialiter = $_GET['specialiter'] ; 

		$sql =  "  select * from employee e ,specialiter s  WHERE s.libelle= '$specialiter' And e.specialiteEmployee=s.idspecialiter" ;
		
        $result = mysqli_query($conn, $sql);
		if ($result->num_rows > 0) {	
			while($row = mysqli_fetch_assoc($result))
			$tab[] =$row; 
			print(json_encode($tab)); 
		}else { 
			echo json_encode(array( 'RESPONSE'=>'Aucune Employee trouvee' )); 
		}
    }
    else {
		echo json_encode(array( 'RESPONSE'=>'Erreur Employee parametres' ));  
    }
 
?> 
 