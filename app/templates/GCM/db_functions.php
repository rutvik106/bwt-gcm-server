<?php


  
  class DB_Functions {
  
	private $PDO;
	
	private $ObjectPDO;

	function __construct() {
		
		/*include_once './db_connect.php';
		$this->db = new DB_Connect();
		$this->db->connect();*/
		
		require_once 'config.php';
		include_once 'PDOConnection.inc.php';
		$this->ObjectPDO = new PDOConnection(DB_HOST,DB_DATABASE, DB_USER, DB_PASSWORD);
		$this->PDO=$this->ObjectPDO->connect();
		
	}
  
	// destructor
	function __destruct() {
  
	}
  
	/**
	 * Storing new user
	 * returns user details
	 */
	private function storeUser($name, $email, $gcm_regid) {
  
  
  
		// insert user into database
		$result = $this->PDO->query("INSERT INTO gcm_users(name, email, gcm_regid, created_at) VALUES('$name', '$email', '$gcm_regid', NOW())");
		// check for successful store
		if ($result) {
			// get user details
			$id = $this->PDO->lastInsertId(); // last inserted id
			$result = $this->PDO->query("SELECT * FROM gcm_users WHERE id = $id");
			// return user details
			if ($result->rowCount()) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
  
public function checkAndStoreUser($name, $email, $gcm_regid)
{

	//$result = $this->PDO->query("SELECT * FROM gcm_users WHERE gcm_regid LIKE '$gcm_regid' AND email LIKE '$email'");
	if($this->PDO->query("SELECT * FROM gcm_users WHERE gcm_regid LIKE '$gcm_regid' AND email LIKE '$email'")->rowCount()>0){
		//echo "user already added";
		return true;
	}
	else if ($this->PDO->query("SELECT * FROM gcm_users WHERE gcm_regid LIKE '$gcm_regid'")->rowCount() > 0)
	{
		//duplicate device found
		//check if gmail id is same
		//$result = mysqli_query($this->db->connect(),"SELECT * FROM gcm_users WHERE gcm_regid LIKE '$gcm_regid' AND email LIKE '$email'");
	
		if (!$this->PDO->query("SELECT * FROM gcm_users WHERE gcm_regid LIKE '$gcm_regid' AND email LIKE '$email'")->rowCount() > 0)
		{
			//echo "duplicate device found but gmail is different update gmail id for it";
			$result = $this->PDO->query("UPDATE gcm_users SET email='$email' WHERE gcm_regid LIKE '$gcm_regid'");
	
			if ($result)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}	
	else if ($this->PDO->query("SELECT * FROM gcm_users WHERE email LIKE '$email'")->rowCount() > 0)
	{
		//duplicate email found
		//check if device is same
		//echo "duplicate email found check if device is same";
		//$result = mysqli_query($this->db->connect(),"SELECT * FROM gcm_users WHERE gcm_regid LIKE '$gcm_regid' AND email LIKE '$email'");
		if (!$this->PDO->query("SELECT * FROM gcm_users WHERE gcm_regid LIKE '$gcm_regid' AND email LIKE '$email'")->rowCount() > 0)
		{
			//echo "duplicate email found but device is different add this device as new";
			$result = $this->PDO->query("INSERT INTO gcm_users(name, email, gcm_regid, created_at) VALUES('$name', '$email', '$gcm_regid', NOW())");
			if ($result)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}
	else
	{
		//echo "INSERTING NEW USER";
		return $this->storeUser($name,$email,$gcm_regid);
	}
		
}



	public function addOffer($title,$description,$imageUrl,$offerType,$validity){
		$result = $this->PDO->query("INSERT INTO `offers`(`id`, `title`, `description`, `image_url`, `offer_type`, `validity`,`posted_on`) VALUES (NULL,'$title','$description','$imageUrl','$offerType','$validity',NOW())");
			if ($result)
			{
				return true;
			}
			else
			{
				return false;
			}
		
	}
  
	/**
	 * Getting all users
	 */
	public function getAllUsers() {
		$result = $this->PDO->query("select * FROM gcm_users");
		return $result;
	}



	public function getAllOffers(){
		$result = $this->PDO->query("select * FROM offers ORDER BY posted_on DESC");
		return $result;
	}


	public function deleteOffer($id){
		$result = $this->PDO->query("DELETE FROM offers WHERE id LIKE '$id'");
		return $result;
	}

  
	/**
	 * Get GCMRegId
	 * 
	 */
	public function getGCMRegID($emailID){
	 $result = $this->PDO->query("SELECT gcmregid FROM gcm_users WHERE emailid = "."'$emailID'");
	 return $result;
  }
  
  }
  
  ?>