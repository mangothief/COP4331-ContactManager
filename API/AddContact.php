<?php

	$inData = getRequestInfo();
	
	$userid = $inData["userid"];
	$firstname = $inData["firstname"];
	$lastname = $inData["lastname"];
	$phonenumber = $inData["phonenumber"];
	$email = $inData["email"];
	//$datecreated = "";

	$conn = new mysqli('localhost', 'root', '8C@UnIoOwUK2k7gZl%N9Mi', 'cookiebook');
   
   if ($conn->connect_error) 
	{
		returnWithError($conn->connect_error);
	} 
	else
	{
		// Queries.
		$sql = "INSERT into contacts (userid,firstname,lastname,phonenumber,email) VALUES (" . $userid . ",'" . $firstname . "','" . $lastname . "','" . $phonenumber . "','" . $email . "')";
		/*
		$primary_key = "SELECT * from users WHERE userid ='" . $userid . "'";
		$foreign_key = "SELECT * from contacts WHERE userid ='" . $userid . "'";
		// Results.
		$userscheck = $conn->query($primary_key);
		$contactscheck = $conn->query($foreign_key);
		*/
		/*
		echo("users: " . $userscheck);
		echo("contacts: " . $contactscheck);
		*/
		/*
		// Check if userid is present in users table.
		if (empty($userscheck))
		{
			echo "Key not present in users table.";
			returnWithError("userid: " . $userid);
		}
		// Reject new contact if userid already present in contacts table. 
		else if (!empty($contactscheck))
		{
			echo "Key already present in contacts table.";
			returnWithError("userid: " . $userid);
		}
		*/
		if($result = $conn->query($sql) != TRUE)
		{
			returnWithError($conn->error);
		}
		else
		{
			echo "Successfully added contact.";
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