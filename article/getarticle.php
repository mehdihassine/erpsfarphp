<?php
include('../config.php');
$postdata = file_get_contents("php://input"); 

    if (isset($postdata)) {

        $request = json_decode($postdata);
		$idarticle = $_GET['id'] ; 

		$sql =  " select * FROM  article WHERE idarticle='$idarticle'" ;
		
        $result = mysqli_query($conn, $sql);
		if ($result->num_rows > 0) {	
			while($row = mysqli_fetch_assoc($result))
			$tab[] =$row; 
			print(json_encode($tab)); 

		}else { 
			echo json_encode(array( 'RESPONSE'=>'Aucune Article trouvee' )); 
		}
    }
    else {
		echo json_encode(array( 'RESPONSE'=>'Erreur reception parametres' ));  
    }
 
?>  