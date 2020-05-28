<?php
include('../config.php');

$postdata = file_get_contents("php://input"); 

    if (isset($postdata)) {
		
        $request = json_decode($postdata);
		
		$nfacture = $_GET['nfacture'] ; 

		$sql =  "SELECT SUM(montanthtc) as montantTHT, SUM(montanttva) as montanttva, SUM(montantttc) as montanttotale  FROM facturevente where nfacture='$nfacture'" ;
        $result = mysqli_query($conn, $sql);
		
		if ($result->num_rows > 0) {	
		
			while($row = mysqli_fetch_assoc($result))
			$tab[0] =$row; 
			
			if($tab[0]['montanttotal']===null){
				
		    $tab[0]['montanttotal']=0;
			print json_encode($tab[0]); 
			// ssf
			// ssf
			}
			
			else {
			print json_encode($tab[0]); 
		
				
			}
		}
		
			
			

		
		
		else { 
			print json_encode( "montant = 0"); 
		}
	



	
    }

    else {
		echo ('Erreur commande parametres');  
    }
 
?> 