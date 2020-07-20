<?php

include('../config.php');
$postdata = file_get_contents("php://input"); 
    if (isset($postdata)) {
        $request = json_decode($postdata);
        $dateprod =$_GET['dateprod'] ; //12/07/2020
  


		$sql="SELECT SUM(qtevente) as qtevente ,SUM(montantvente) as montant ,SUM(benefice) as benefice FROM ligneproduction l ,production1 pr WHERE pr.dateprod='$dateprod' and l.idproduction=pr.idproduction";
        $result = mysqli_query($conn, $sql);
        if ($result->num_rows > 0) {	
			$row = mysqli_fetch_assoc($result);
            $qtevente =$row['qtevente']; //38
            $montant =$row['montant']; //260550
            $benefice =$row['benefice']; //172820
           
         

            upadate ($conn,$qtevente,$montant,$benefice,$dateprod);           
		}
		
		else { 
			echo json_encode(array( 'RESPONSE'=>'Aucune ligne trouvee' )); 
        }
    }
    else {
		echo json_encode(array( 'RESPONSE'=>'Erreur reception parametres' ));  
    }
	
 



function upadate ($conn,$qtevente,$montant,$benefice,$dateprod) {
    $req="SELECT * FROM production1 WHERE dateprod ='$dateprod'";
        $result1 = mysqli_query($conn, $req);	
        if ($result1->num_rows > 0) {	
            $row1= mysqli_fetch_assoc($result1);
            $idproduction =$row1['idproduction']; 

    $req2="UPDATE `vente` SET `qtevente`='$qtevente',`montanttotal`='$montant',`benefice`='$benefice' WHERE `idproduction`='$idproduction'" ;
    $result1 = mysqli_query($conn, $req2);	
    if ($result1===true) {
        echo json_encode(array('resp22s'=>"prod : $dateprod + $montant+ $benefice= validee  " ));
        
        
        }
        else {echo json_encode(array( 'resp'=>'vente non validee' ));}


    }
    else{
        echo json_encode(array( 'RESPONSE'=>'Aucune production trouvee' ));
    }

}





















?>