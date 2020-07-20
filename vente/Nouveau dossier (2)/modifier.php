<?php
include('../config.php');
$postdata = file_get_contents("php://input"); 
    if (isset($postdata)) {
        $request = json_decode($postdata);
		$idd=$request->num ; 
		$qtp=$request->name;
		$dt=$request->prixP;
		$qtr=$request->rest;
		$qtj=$request->jeter;
		$pt=$request->prixT;
		$bep=$request->benifice;
		
		$sql =  "UPDATE `production` SET `idproduction`=$idd,`datesys`=$dt,`qtetproduction`=$qtp,`qteRestProduction`=$qtr,`qtejeter`=$qtj,`prixTotal`=$pt
		,`benficeProd`=$bep
		WHERE production.idproduction='$idd'"; 
        $result = mysqli_query($conn, $sql);
		if ($result===true) {	
			echo json_encode(array( 'RESPONSE'=>' production modifer ' )); 
		}else {
			echo json_encode(array( 'RESPONSE'=>'Erreur modification ' )); 
		}
    }
    else {
		echo json_encode(array( 'RESPONSE'=>'Erreur modifier production' ));  
    }
 
?> 