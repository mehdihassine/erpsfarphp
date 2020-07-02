<?php

include('../config.php');


$postdata = file_get_contents("php://input",true); 
    if (isset($postdata)) {
		
        $request = json_decode($postdata);
		
		$dateprod =$request->dateprod;
		$nligne1 = $request->nligne1;
		$id_produit =$request->idproduit;
		$qteproduction = $request->qteproduction;
		$datecreation = date("Y-m-d- H:i:s");
$qte=0;
	$req="SELECT * FROM production1 WHERE dateprod ='$dateprod'";
	$result1 = mysqli_query($conn, $req);	
	if ($result1->num_rows > 0) {	
		$row = mysqli_fetch_assoc($result1);
		$idproduction =$row['idproduction'];  
		$sql =  "SELECT idProduit, prixvente FROM produit where idProduit = '$id_produit'" ;
        $result = mysqli_query($conn, $sql);

		if ($result->num_rows > 0) {	
			$row = mysqli_fetch_assoc($result); 
			$codartid =$row['idProduit']; 
			$prixvente =$row['prixvente']; 
			$montanttotal = $qteproduction*$prixvente;

			$req2="INSERT INTO  `ligneproduction` (`idproduction`, `produit`, `qte`, `qterest`, `qterejeter`, `qtevente`,`montantvente`,`benefice`) VALUES ('$idproduction', '$codartid', '$qteproduction','$qte','$qte','$qte','$montanttotal','$qte' )";
			$result2 = mysqli_query($conn, $req2);	
			if ($result2===true) {
				$resp1 = array ("$idproduction","$codartid","$qteproduction");
				echo json_encode ($resp1);		
				}
				else {echo json_encode(array( 'resp'=>'vente non validee' ));}
	        }
		else {
		echo json_encode(array( 'resp'=>"0" ));	    }




	   }
		else { 
			$sql =  "SELECT idProduit, prixvente FROM produit where idProduit = '$id_produit'" ;
        $result = mysqli_query($conn, $sql);

		if ($result->num_rows > 0) {	
			while($row = mysqli_fetch_assoc($result))
			$codartid1[0] =$row; 
		
			$codartid =$codartid1[0]['idProduit']; 
			$prixvente =$codartid1[0]['prixvente'];
			//print ($codartid1[0]['idProduit']); //codartid
			
			$montanttotal = $qteproduction*$prixvente;
			
			
			
			
	$insertdepot =  "INSERT INTO `production1`(`idproduction`, `dateprod`, `datesys`, `qteproduction`) VALUES ('','$dateprod','$datecreation','$qte')";
		
     $resultInsertdp = mysqli_query($conn, $insertdepot);
	 $nbrow = mysqli_affected_rows($conn);
	if ($nbrow>0) { 
	
		$resp1 = array ("$dateprod","$nligne1","$id_produit","$qteproduction");
		echo json_encode ($resp1);		
		
		}
		
	else {
	$resp0 = array ("erreur add production");
	echo json_encode ($resp0);			
	
		}
 
		insert($conn,$dateprod,$codartid,$qteproduction);
		
    }
    else {
	echo json_encode(array( 'resp'=>"0" ));	    }
		}
























}
else {
   echo json_encode(array( 'resp'=>'Erreur2' ));  
   }







   function insert($conn,$dateprod,$codartid,$qteproduction,$montanttotal ){
	$req="SELECT `idproduction` FROM `production1` WHERE `dateprod`='$dateprod'";
	$result = mysqli_query($conn, $req);

		if ($result->num_rows > 0) {	
			while($row = mysqli_fetch_assoc($result))
			$resultat[0] =$row; 
			$idproduction =$resultat[0]['idproduction']; 

			$req2="INSERT INTO `ligneproduction`(`idproduction`, `produit`, `qte`, `qterest`, `qterejeter`, `qtevente`,`montantvente`,`benefice`) VALUES ('$idproduction','$codartid','$qteproduction','$qte','$qte','$qte','$montanttotal','$qte' )";
			$req3="INSERT INTO `vente`(`idvente`, `datprod`, `idproduction`, `qtevente`, `montanttotal`, `benefice`) VALUES ('','$dateprod','$idproduction','$qte','$qte','$qte')";
			$result2 = mysqli_query($conn, $req3);
			$result1 = mysqli_query($conn, $req2);	
			// $nbrow = mysqli_affected_rows($conn);
			if (($result1->num_rows > 0) || ($result2->num_rows > 0)){ 
			
			
				}
				else {echo json_encode(array( 'resp'=>'vente non validee' ));}
					
		}
		else{
			echo json_encode(array( 'resp'=>'idproduction non validee' ));
		}


	}

?> 
