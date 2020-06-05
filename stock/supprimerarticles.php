<?php
include('../config.php');
$postdata = file_get_contents("php://input"); 
    if (isset($postdata)) {
        $request = json_decode($postdata);
		$codearticle = $_GET['codearticle'] ; 
		$datesortie = $_GET['datesortie'] ; 
		$sql2="SELECT `idarticle` from `article` where `codearticle`='$codearticle'";
$result2=mysqli_query($conn,$sql2);
if($result2->num_rows>0){
	while($row=mysqli_fetch_assoc($result2))
    $table[0]=$row;
	$idarticle=$table[0]['idarticle'];



		$sql =  " DELETE FROM `stock` WHERE datesortie='$datesortie' and article_id='$idarticle'" ;
		
        $result = mysqli_query($conn, $sql);
		if ($result===true) {	
			echo json_encode(array( 'RESPONSE'=>' reception supprimer ' )); 
		}else {
			echo json_encode(array( 'RESPONSE'=>'Erreur suppression ' )); 
		}
	}else{
		echo json_encode(array("aucun article trouver"));
		echo json_encode(array("table"=>"$table",
									"idfr"=>"$rows"));
	}
    }
    else {
		echo json_encode(array( 'RESPONSE'=>'Erreur supprimer reception' ));  
		}
?> 