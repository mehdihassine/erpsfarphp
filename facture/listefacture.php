<?php
include('../config.php');
$postdata = file_get_contents("php://input"); 
    if (isset($postdata)) {
        $request = json_decode($postdata);
		
		$sql =  "SELECT nfacture, types, datesys,montantttcTOT as montanttotal FROM facturevente GROUP BY nfacture " ;
		$sql2 =  "SELECT nfacture, types, COUNT(nligne) as nligne, datesys, SUM(montantttc) as montanttotal FROM factureachat GROUP BY nfacture " ;
		$sql3 =  "SELECT nfacture, types, COUNT(nligne) as nligne, datesys, SUM(montantttc) as montanttotal FROM facturedivers GROUP BY nfacture " ;
		
		//requete 1 vente
		$result = mysqli_query($conn, $sql);
		$result2 = mysqli_query($conn, $sql2);
		$result3 = mysqli_query($conn, $sql3);

		if (($result->num_rows > 0) || ($result2->num_rows > 0) || ($result3->num_rows > 0) )  {	
			while($row = mysqli_fetch_assoc($result))
			$tab[] =$row; 

			//requete 2 achat
			while($row2 = mysqli_fetch_assoc($result2))
			$tab2[] =$row2; 
			while($row3 = mysqli_fetch_assoc($result3))
			$tab3[] =$row3; 

				$tabfinal = array_merge($tab,$tab2,$tab3);


			print(json_encode($tabfinal)); 
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