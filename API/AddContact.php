<?php

	$inData = getRequestInfo();
	
	$userid = $inData["userid"];
	$firstname = $inData["firstname"];
	$lastname = $inData["lastname"];
	$phonenumber = $inData["phonenumber"];
	$email = $inData["email"];
	//$datecreated = "";
	//$datelaston = ""; -> cross ref for userid in users,
	//                     match datelaston if user exists.

	$conn = new mysqli('localhost', 'root', '8C@UnIoOwUK2k7gZl%N9Mi', 'cookiebook');
   
   	if ($conn->connect_error) 
	{
		returnWithError($conn->connect_error);
	} 
	else
	{
		// Check if userid is present in users table.
		$primary_key = "SELECT * from users WHERE userid ='" . $userid . "'";
		$result = $conn->query($primary_key);
		if (empty($result))
		{
			echo "Key not present in users table.";
			returnWithError("userid: " . $userid);
		}
		
		// Reject new contact if userid already present in contacts table. 
		$foreign_key = "SELECT * from contacts WHERE userid ='" . $userid . "'";
		$result = $conn->query($foreign_key);
		if (!empty($result))
		{
			echo "Key already present in contacts table.";
			returnWithError("userid: " . $userid);
		}

		$sql = "INSERT into contacts (userid,firstname,lastname,phonenumber,email) VALUES (" . $userid . ",'" . $firstname . "','" . $lastname . "','" . $phonenumber . "','" . $email . "')";
		//returnWithError($sql);
		if($result = $conn->query($sql) != TRUE)
		{
			returnWithError($conn->error);
		}
		$conn->close();
	}
	
	returnWithError("");
	
	function getRequestInfo()
	{
		return json_decode(file_get_contents('php://input'), true);
	}

	function sendResultInfoAsJson($obj)
	{
		header('Content-type: application/json');
		echo $obj;
	}
	
	function returnWithError($err)
	{
		$retValue = '{"error":"' . $err . '"}';
		sendResultInfoAsJson($retValue);
	}
	
?>