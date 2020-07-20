<?php
include('../config.php');

$postdata = file_get_contents("php://input"); 

    if (isset($postdata)) {
		
        $request = json_decode($postdata);
		$qte=$_GET['qte'];
		//$nligne = $_GET['nligne'] ; 
		$dateprod = $_GET['dateprod'] ; 
        $qterejeter=$_GET['qterejeter'];
		$qterest=$_GET['qterest'];
		$idproduit=$_GET['idproduit'];
		
	
		$sql="SELECT `coutrevien`  ,`prixvente`FROM `produit` WHERE `idProduit`='$idproduit'";
		
		$result = mysqli_query($conn, $sql);

		if ($result->num_rows > 0) {	
			while($row = mysqli_fetch_assoc($result))// retour le resultat sur forme de tableau 
			$resultat[0] =$row; 
		
			$coutrevien =$resultat[0]['coutrevien']; 
			$prixvente =$resultat[0]['prixvente'];
			//print ($codartid1[0]['idProduit']); 
			
			$qtevente=$qte-$qterest-$qterejeter ; 
			$montantvente=$qtevente*$prixvente; 
			$benefice=$montantvente-($qtevente*$coutrevien);
			
		
		$req="SELECT `idproduction` FROM `production1` WHERE `dateprod`='$dateprod'";
	$result = mysqli_query($conn, $req);

		if ($result->num_rows > 0) {	
			while($row = mysqli_fetch_assoc($result))
			$resultat[0] =$row; 
			$idproduction =$resultat[0]['idproduction']; 
		
			$req2="UPDATE `ligneproduction` SET
		`qterest`='$qterest',`qterejeter`='$qterejeter',`qtevente`='$qtevente',`montantvente`='$montantvente',`benefice`='$benefice' WHERE produit='$idproduit' AND idproduction='$idproduction'" ;
			$result1 = mysqli_query($conn, $req2);	
			$nbrow = mysqli_affected_rows($conn);
			if ($nbrow>0) { 
				echo json_encode(array('resp'=>"prod : $dateprod + $idproduit = validee  " ));
				
				
				}
				else {echo json_encode(array( 'resp'=>'vente non validee' ));}
					
		}
		else{
			echo json_encode(array( 'resp'=>'idproduction non validee' ));
		}
     
	
		
		
		}
		
		else {
		echo json_encode(array( 'resp'=>'prod non validee' ));
		}
	


	
}

    else {
		echo ('Erreur prod parametres');  
    }
 

	
?> 