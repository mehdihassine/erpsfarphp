<?php
include('../config.php');
$postdata = file_get_contents("php://input"); 
    if (isset($postdata)) {
        $request = json_decode($postdata);
		$etat = $_GET['etat'] ; 
		$idemploye = $_GET['idemploye'] ;
		$sql = " SELECT  * from employee e ,specialiter s ,salaire sa  WHERE sa.etat= '$etat' 
		And e.specialiteEmployee=s.idspecialiter AND sa.idemploye=e.idEmployee AND sa.idemploye= '$idemploye'" ;
		 
		
        $result = mysqli_query($conn, $sql);
		if ($result->num_rows > 0) {	
			while($row = mysqli_fetch_assoc($result))
			$tab[] =$row; 
			print(json_encode($tab)); 
		}else { 
			echo json_encode(array( 'RESPONSE'=>'Aucune FICHE trouvee' )); 
		}
    }
    else {
		echo json_encode(array( 'RESPONSE'=>'Erreur FICHE parametres' ));  
    }
 
?> 
 