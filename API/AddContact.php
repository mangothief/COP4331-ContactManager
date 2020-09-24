<?php
	// Add to contacts table.
	$inData = getRequestInfo();
	
	$userid = $inData["userid"];
	$firstname = $inData["firstname"];
	$lastname = $inData["lastname"];
	$phonenumber = $inData["phonenumber"];
	$email = $inData["email"];
	$contactid = 0;

	$conn = new mysqli('localhost', 'root', '8C@UnIoOwUK2k7gZl%N9Mi', 'cookiebook');
   
   	if ($conn->connect_error) 
	{
		returnWithError($conn->connect_error);
	} 
	else
	{
		// Use first available contactid.
		$sql = "SELECT* from contacts WHERE userid="' . $userid . '"AND contactid="' . $contactid . '"";
		echo $sql;
		$result = $conn->query($sql);
		while ($result->num_rows > 0)
		{
			$contactid++;
			$sql = "SELECT* from contacts WHERE userid=" . $userid . "AND contactid=" . $contactid;
			$result = $conn->query($sql);
			echo $contactid;
		}	
		// Get current date. 
		$datecreated = date("Y/m/d");
		// Formatted sql query.
		$sql = "INSERT into contacts (userid,contactid,firstname,lastname,phonenumber,email,datecreated) VALUES ('" . $userid . "','" . $contactid . "','" .  $firstname . "','" . $lastname . "','" . $phonenumber . "','" . $email . "','" . $datecreated . "')";
		// Result of insert query.
		if($result = $conn->query($sql) != TRUE)
		{
			returnWithError($conn->error);
		}
		else
		{
			returnWithInfo($userid, $contactid, "added contact!");
		}
	}
	$conn->close();
	
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