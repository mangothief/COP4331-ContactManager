<?php
	// Add to contacts table.
	$inData = getRequestInfo();
	
	$userid = $inData["userid"];
	$firstname = $inData["firstname"];
	$lastname = $inData["lastname"];
	$phonenumber = $inData["phonenumber"];
	$email = $inData["email"];

	$conn = new mysqli('localhost', 'root', '8C@UnIoOwUK2k7gZl%N9Mi', 'cookiebook');
   
   if ($conn->connect_error) 
	{
		returnWithError($conn->connect_error);
	} 
	else
	{
		// Get current date. 
		$datecreated = date("Y/m/d");
		// Formatted sql query.
		$sql = "INSERT into contacts (userid,firstname,lastname,phonenumber,email,datecreated) VALUES ('" . $userid . "','" .  $firstname . "','" . $lastname . "','" . $phonenumber . "','" . $email . "','" . $datecreated . "')";
		// Result of insert query.
		if($result = $conn->query($sql) != TRUE)
		{
			returnWithError($conn->error);
		}
		else
		{
			returnWithInfo($userid, $conn->insert_id, "added contact!");
		}
		$conn->close();
	}
	
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

	function returnWithInfo($userid, $contactid, $info)
    {
        $retValue = '{"userid":' . $userid . ',"contactid":' . $contactid . ',"info":"' . $info . '"}';
        sendResultInfoAsJson($retValue);
    }
?>