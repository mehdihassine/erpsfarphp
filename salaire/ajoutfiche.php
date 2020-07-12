<?php
include('../config.php');

$postdata = file_get_contents("php://input"); 

    if (isset($postdata)) {

		$request = json_decode($postdata);

       

		$matricule=$request->matricule;
		$nbjour=$request->nbjour;
		$nbferier=$request->nbferier;
		$primepresence=$request->primepresence;
		$primepanier=$request->primepanier;
		$Conge=$request->Conge;
		$salairebrute=$request->salairebrute;
		$cnss=$request->cnss;
		$irp=$request->irp;
		$payee=$request->payee;
		$datefiche=date("Y-m-d");
$etat='valider';

	$sql1 =  " select idEmployee FROM  employee WHERE idEmployee='$matricule'" ;
	$result1 = mysqli_query($conn, $sql1);
	if ($result1->num_rows > 0) {	

		
			
		$sql2 =  "INSERT INTO `salaire`(`idsalaire`, `idemploye`, `nbrjour`, `jourferier`, `primePr`, `primeP`, `conger`, `salairebrute`, `cnss`, `irpp_css`, `salairenet`,`datefiche`,`etat`) VALUES
         ('','$matricule','$nbjour','$nbferier','$primepresence','$primepanier','$Conge','$salairebrute','$cnss','$irp','$payee','$datefiche','$etat') " ; 
		$result2 = mysqli_query($conn, $sql2);
		
		if ($result2===true) {	

			echo json_encode(array( 'RESPONSE'=>' fiche ajoutee ' )); 


		}else {
			echo json_encode(array( 'RESPONSE'=>'0 ')); 
		}

	}
	
	else { 
	

		echo json_encode(array( 'RESPONSE'=>'employer introvable ')); 
		}
		
	
















	











		
	
    }
    else {
		echo json_encode(array( 'RESPONSE'=>'Erreur parametres article' ));  
    }
 
?> 