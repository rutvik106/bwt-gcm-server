<?php
if (isset($_GET["message"])) {
	
    $message = $_GET["message"];
     
    include_once './GCM.php';
	
	include_once './db_functions.php';
	
	$gcm = new GCM();
 
    $registatoin_ids = array();
	
	$db = new DB_Functions();
	
    $users = $db->getAllUsers();
	
    if ($users != false)
	{
    	$no_of_users = mysqli_num_rows($users);
		
		if ($no_of_users > 0)
		{
                    while ($row = mysqli_fetch_array($users))
					{
						array_push($registatoin_ids,$row["gcm_regid"]);
					}
		}
	}
     
   
	//echo print_r($registatoin_ids);
	
	
    //$message = array("price" => $message);
 
    $result = $gcm->send_notification($registatoin_ids, $message);
 
    echo $result;
}
?>