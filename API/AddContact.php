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
		$users = "SELECT username, password FROM users";
		$result = $conn->query($users);
		if ($userid > $result->num_rows)
		{
			echo "Key not present in user db";
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