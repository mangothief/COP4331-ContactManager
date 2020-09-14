<?php
    // Select an existing contact and alter their info. 
    $inData = getRequestInfo();

    $userid = $inData["userid"];
    $firstname = $inData["firstname"]
    $password = $inData["password"];
    $email = $inData["email"];
    $phonenumber = $inData["phonenumber"];

    $conn = new mysqli('localhost', 'root', '8C@UnIoOwUK2k7gZl%N9Mi', 'cookiebook');

    if ($conn->connect_error)
    {
        returnWithError($conn->connect_error);
    }
    else
    {
        $sql = "UPDATE contacts SET (firstname,lastname,email,phonenumber) VALUES (" . $firstname . ",'" . $lastname . "','" . $email . "','" . $phonenumber . "') WHERE userid = $userid";
        returnWithError($sql);
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


