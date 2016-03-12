<?php

/**
 * Registering a user device
 * Store reg id in users table
 */
if (isset($_GET["name"]) && isset($_GET["email"]) && isset($_GET["regId"])) {
    $name = $_GET["name"];
    $email = $_GET["email"];
    $gcm_regid = $_GET["regId"]; // GCM Registration ID
    // Store user details in db
    include_once './db_functions.php';
    include_once './GCM.php';
    
    $db = new DB_Functions();
    $gcm = new GCM();
    
    $res = $db->checkAndStoreUser($name, $email, $gcm_regid);
   
		$registatoin_ids = array($gcm_regid);
		$message = "Welcome ".$name;
		
		$result = $gcm->send_notification($registatoin_ids, $message);
		
		echo $result;
} else {
    // user details missing
}
?>