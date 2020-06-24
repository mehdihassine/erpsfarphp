<?php
include('../config.php');
$postdata = file_get_contents("php://input"); 
    if (isset($postdata)) {
        $request = json_decode($postdata);
		$datprod = $_GET['datprod'] ; 
		
			$sql =  " SELECT  datprod,  COUNT(idproduit) as Nbreproduit , SUM(qtevente) as qtevente, 
			SUM(montanttotal) as montantvente , SUM(benefice) as benficeProd FROM vente where datprod='$datprod' GROUP by (datprod) " ;
		
        $result = mysqli_query($conn, $sql);
		
		if ($result->num_rows > 0) {	
		
			while($row = mysqli_fetch_assoc($result))
			$tab[] =$row; 
		
		echo json_encode($tab); 
			

		}
		
		else { 
		
		$tab[0]['respo'] = 'erreurprod';
		echo json_encode($tab);
		
		}
	



	
    }
    else {
		echo json_encode(array( 'RESPONSE'=>'Erreur prodution parametres' ));  
    }
 
?> 
 