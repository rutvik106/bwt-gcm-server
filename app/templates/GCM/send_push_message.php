<?php
if (isset($_GET["title"]) && isset($_GET["message"]) && isset($_GET["title"])) {
	
	$title=$_GET["title"];	

	$type="";

	if(isset($_GET["airticket"])){
		$type .=" Airticket ";
	}
	if(isset($_GET["visa"])){
		$type .=" Visa ";
	}
	if(isset($_GET["holiday"])){
		$type .=" Holiday ";
	}
	
    $message = $_GET["message"];

    $imageUrl=$_GET["image_url"];

    $validity=$_GET["validity"];
	
     
    include_once './GCM.php';
	
	include_once './db_functions.php';
	
	$gcm = new GCM();
 
    $registatoin_ids = array();
	
	$db = new DB_Functions();
	
    $users = $db->getAllUsers();
	
    if ($users != false)
	{
    	$no_of_users = $users->rowCount();
		
		if ($no_of_users > 0)
		{
                    while ($row = $users->fetch(PDO::FETCH_ASSOC))
					{
						array_push($registatoin_ids,$row["gcm_regid"]);
					}
		}
	}

	echo $db->addOffer($title,$message,$imageUrl,$type,$validity);
     
   
	//echo print_r($registatoin_ids);
	
	$push_message=array("title"=>$title,"description"=>$message,"offer_type"=>$type,"image_url"=>$imageUrl,"validity"=>$validity);
	
    $data = array("push_message" => $push_message);
 
    $result = $gcm->send_notification($registatoin_ids, $data);
 
    echo $result;
}
?>