<?php 
	
	// const error message
	const ERROR = "JSON object does not exist";

	// Default databse
	$server = "***************";
	$username = "************";
	$password = "**************";
	$databse = "***********";

	/*
	 * Accepts server, username password and database
	 * sets validation values to that so the databse
	 * can be retreived with get_database.
	 */
	function set_database($_server, $_username, $_password, $_database){
		global $server, $username, $password, $databse;

		$server = $_server;
		$username = $_username;
		$password = $_password;
		$databse = $_database;
	}

	/*
	 * Retreives link to datbase
	 * If set_datbase is not called, it will retreive
	 * card databse
	 */
	function get_database(){
		global $server, $username, $password, $databse;
		$link = mysqli_connect( $server, $username , $password, $databse);

		if (mysqli_connect_errno()){
		  echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}else{
			return $link;
		}
	}

	/*
	 * Recieves json object.
	 * Checks to see if exists before return it
	 * If it doesn't exists 
	 * Returns null string if boolean parameter is true
	 * Kills script if boolean parameter is false
	 */
	function set_val($obj_from_json, $return_null){
		if($obj_from_json){ 
			return $obj_from_json;
		}else {
			if ($return_null)
				return ' ';
			else
				throw new Exception(ERROR);
		}
	}

	/*
	 * Recieves json array.
	 * Checks to see if exists before return it
	 * If it doesn't exists 
	 * Returns null string if boolean parameter is true
	 * Kills script if boolean parameter is false
	 */
	function set_array($array_from_json, $return_null){
		$temp = array();
		if($array_from_json){
			for ($i = 0; $i < count($array_from_json); $i++){
				array_push($temp, $array_from_json[$i]);
			}
			return $temp;
		} else {
			if($return_null){	
				// $temp should be blank
				array_push($temp, ' ');	
				return $temp;
			}else
				throw new Exception(ERROR);
		}

	}

 ?>