<?php
include('../config.php');

$postdata = file_get_contents("php://input"); 

    if (isset($postdata)) {
		
        $request = json_decode($postdata);
		
		
				
		
		$dateprod = $_GET['dateprod'] ; 



		if(!is_numeric($dateprod)){
		$sql =  "SELECT  dateprod, datesys, COUNT(id_produit) as Nbreproduit , SUM(qteproduction) as quantiteproduction, 
		 SUM(prixTotal) as prixTotal   FROM production  GROUP BY (dateprod)"  ;
		}
		
		else{
		$sql =  "SELECT  dateprod, datesys, COUNT(id_produit) as Nbreproduit , SUM(qteproduction) as quantiteproduction, 
		 SUM(prixTotal) as prixTotal FROM production  where dateprod='$dateprod' GROUP BY (dateprod)"   ;
		}


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
		echo ('Erreur liste prod parametres');  
    }
 
?> 