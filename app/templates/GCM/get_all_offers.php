<?php


include_once './db_functions.php';

$offers = array();

$db = new DB_Functions();

$result = $db->getAllOffers();
	
    if ($result != false)
	{
    	$no_of_offers = $result->rowCount();
		
		if ($no_of_offers > 0)
		{
                    while ($row = $result->fetch(PDO::FETCH_ASSOC))
					{
						array_push($offers,array("id"=>$row["id"],
												"title"=>$row["title"],
												"description"=>$row["description"],
												"image_url"=>$row["image_url"],
												"offer_type"=>$row["offer_type"],
												"validity"=>$row["validity"]));
					}
		}
	}

	echo json_encode($offers);


?>