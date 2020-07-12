<?php
include('../config.php');
$postdata = file_get_contents("php://input"); 
    if (isset($postdata)) {
        $request = json_decode($postdata);
		$datprod= $_GET['datprod'];
		//$sql =  "SELECT * FROM `ligneproduction` l ,`production1` pr,`produit` p ,`vente` v  where
		//v.datprod='$datprod' AND pr.idproduction=v.idproduction AND l.idproduction=pr.idproduction AND l.produit=p.idProduit  ";
		$sql= "SELECT * FROM `ligneproduction` l ,`production1` pr,`produit` p  WHERE pr.dateprod='$datprod' AND l.idproduction=pr.idproduction 
		AND l.produit=p.idProduit "; 
		
        $result = mysqli_query($conn, $sql);
		if ($result->num_rows > 0) {	
			while($row = mysqli_fetch_assoc($result))
			$tab[] =$row; 
			print(json_encode($tab)); 
		}
		
		else { 
			echo json_encode(array( 'RESPONSE'=>'Aucune reception trouvee' )); 
		}
    }
    else {
		echo json_encode(array( 'RESPONSE'=>'Erreur reception parametres' ));  
    }
	
	// 			
?>  