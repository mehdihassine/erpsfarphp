<?php

include('../../config.php');


$postdata = file_get_contents("php://input"); 
    if (isset($postdata)) {
        $request = json_decode($postdata);
		
		$sql =  " select * from depot" ;
		
        $result = mysqli_query($conn, $sql);
		
		if ($result->num_rows > 0) {	
			while($row = mysqli_fetch_assoc($result))
			$tab[] =$row; 
			print(json_encode($tab)); 
		}else { 
			echo json_encode(array( 'RESPONSE'=>'Aucun depot trouve' )); 
		}
    }
    else {
		echo json_encode(array( 'RESPONSE'=>'Erreur depot parametres' ));  
    }
 
?> 
