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
			
			/*
			echo("qtprd : $qteprod<br>");
			echo("qterjt : $qterejeter<br>");
			echo("qterst : $qterestant<br>");
			echo("qtevte : $qtevente<br><br>");
			echo("ctrvt : $coutrevien<br><br>");
			echo("prvnt : $prixvente<br><br>");	
			echo("mtvt : $montantvente<br>");
			echo("bf : $benefice<br>");
			*/
			$sql2="UPDATE `production` SET `qteRestProduction`='$qterestant',
			`qtejeter`='$qterejeter ',`montantvente`='$montantvente',`benficeProd`='$benefice',
			`qtevente`='$qtevente' WHERE `id_produit`='$idproduit' AND `nligne`='$nligne'";
			
        $result = mysqli_query($conn, $sql2);	
		$nbrow = mysqli_affected_rows($conn);	
		if ($nbrow>0) { 
		echo json_encode(array('resp'=>"prod : $dateprod + $nligne = validee  " ));
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
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
 
?> 