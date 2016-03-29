<?php

/**
 * Registering a user device
 * Store reg id in users table
 */
if (isset($_POST["regId"])) {
    
    $gcm_regid = $_POST["regId"]; // GCM Registration ID
    // Store user details in db
    include_once './db_functions.php';
    include_once './GCM.php';
    
    $db = new DB_Functions();
    $gcm = new GCM();
    
    if($res = $db->subscribe($gcm_regid))
	{
   		echo 1;
	}
	else
	{
		echo 0;	
	}
} else {
    echo -1;
}
?>