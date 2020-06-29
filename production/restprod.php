<?php
include('../config.php');

$postdata = file_get_contents("php://input"); 

    if (isset($postdata)) {
		
        $request = json_decode($postdata);
		$qteprod=$_GET['qteprod'];
		$nligne = $_GET['nligne'] ; 
		$dateprod = $_GET['dateprod'] ; 
        $qterejeter=$_GET['qterejeter'];
		$qterestant=$_GET['qterestant'];
		$idproduit=$_GET['idproduit'];
		
	
		$sql="SELECT `coutrevien`  ,`prixvente`FROM `produit` WHERE `idProduit`='$idproduit'";
		
		$result = mysqli_query($conn, $sql);

		if ($result->num_rows > 0) {	
			while($row = mysqli_fetch_assoc($result))
			$resultat[0] =$row; 
		
			$coutrevien =$resultat[0]['coutrevien']; 
			$prixvente =$resultat[0]['prixvente'];
			//print ($codartid1[0]['idProduit']); 
			
			$qtevente=$qteprod-$qterestant-$qterejeter ; 
			$montantvente=$qtevente*$prixvente; 
			$benefice=$montantvente-($qtevente*$coutrevien);
			
		
			insertvente($conn,$dateprod,$idproduit,$qtevente,$montantvente,$benefice);

			$sql2="UPDATE `production` SET `qteRestProduction`='$qterestant',
			`qtejeter`='$qterejeter ',
			`qtevente`='$qtevente' WHERE `id_produit`='$idproduit' AND `nligne`='$nligne'";
			
        $result = mysqli_query($conn, $sql2);	
		$nbrow = mysqli_affected_rows($conn);	
		if ($nbrow>0) { 
		echo json_encode(array('resp'=>"prod : $dateprod + $nligne = validee  " ));
		
		// insert into vente 
		
	
		
		
		}
		
		else {
		echo json_encode(array( 'resp'=>'prod non validee' ));
		}
	


		}
		else {
		echo ("mehdi ma yefhem chay");
		}
		
}

    else {
		echo ('Erreur prod parametres');  
    }
 
function insert($conn,$dateprod,$idproduit,$qtevente){
	$req="SELECT `idproduction` FROM `production` WHERE `dateprod`='$dateprod' and`id_produit`='$idproduit'";
	$result = mysqli_query($conn, $req);

		if ($result->num_rows > 0) {	
			while($row = mysqli_fetch_assoc($result))
			$resultat[0] =$row; 
			$idproduction =$resultat[0]['idproduction']; 
			$req2="INSERT INTO `lignevente`(`idproduction`, `produit`, `qte`) VALUES ('$idproduction','$idproduit','$qtevente')";
			$result1 = mysqli_query($conn, $req2);	
			if ($result1===true) {
		
		       }
		        else {echo json_encode(array( 'resp'=>'vente non validee' ));}
		}
		else{
			echo json_encode(array( 'resp'=>'idproduction non validee' ));
		}
}


	function insertvente($conn,$dateprod,$idproduit,$qtevente,$montantvente,$benefice){
		$req="INSERT INTO `vente`(`idvente`, `datprod`, `idproduit`, `qtevente`, `montanttotal`, `benefice`) 
		VALUES ('NULL','$dateprod','$idproduit','$qtevente',$montantvente,'$benefice')";
		$result1 = mysqli_query($conn, $req);	
		$nbrow = mysqli_affected_rows($conn);
		if ($nbrow>0) { 
			insert($conn,$dateprod,$idproduit,$qtevente);
		}
		 else {echo json_encode(array( 'resp'=>'vente non validee' ));}
	
	}
?> 