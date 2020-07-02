<?php
include('../config.php');

$postdata = file_get_contents("php://input"); 

    if (isset($postdata)) {
		
        $request = json_decode($postdata);
		$dateprod =$_GET['dateprod'] ; 

		$sql =  "SELECT * FROM `ligneproduction` l ,`production1` pr,`produit` p WHERE
		pr.dateprod='$dateprod' AND l.idproduction=pr.idproduction 
		AND l.produit=p.idProduit ";
		

        $result = mysqli_query($conn, $sql);
		
		if ($result->num_rows > 0) {	
			while($row = mysqli_fetch_assoc($result))
			$tab[] =$row; 

			print json_encode($tab); 
		
		}
		else { 
	
		$tab[] = json_encode(array("newprod" => "0ligne"));
		echo $tab[0]; 
		}
	
		mise($conn,$dateprod);


	
    }

    else {
		echo ('Erreur commande parametres');  
    }
function mise($conn,$dateprod){
	$req="SELECT SUM(qte) as quantite  FROM ligneproduction l ,production1 pr WHERE pr.dateprod='$dateprod' and l.idproduction=pr.idproduction";
	$result = mysqli_query($conn, $req);

		if ($result->num_rows > 0) {	
			while($row = mysqli_fetch_assoc($result))
 			$resultat[0] =$row; 
			$quantite =$resultat[0]['quantite']; 
			$montant =$resultat[0]['montant']; 
			$req2="UPDATE `production1` SET`qteproduction`='$quantite' WHERE dateprod='$dateprod' ";
			$result1 = mysqli_query($conn, $req2);	
 			if ($result1===true) {
		
		   }
		   else {echo json_encode(array( 'resp'=>'mise non validee' ));}
	}
 		else{
			echo json_encode(array( 'resp'=>'idproduction non validee' ));
		}
 }






?> 