<?php

include('../config.php');
$postdata = file_get_contents("php://input"); 
    if (isset($postdata)) {
        $request = json_decode($postdata); 
		$date = date("Y-m-d");

		$sql="SELECT   montanttotal , DAY(date_ajout) as day from vente  where  MONTH(date_ajout) =  MONTH('$date')   order by  date_ajout ASC";
        $result = mysqli_query($conn, $sql);
        if ($result->num_rows > 0) {	
			while($row = mysqli_fetch_assoc($result))
            $tab [] = $row ; 
            echo json_encode($tab);          
		}
		
		else { 
			echo json_encode(array( 'RESPONSE'=>'Erreur' )); 
        }
    }
    else {
		echo json_encode(array( 'RESPONSE'=>'Erreur reception parametres' ));  
    }
	
?>