<?php
    // Select an existing contact and alter their info. 
    $inData = getRequestInfo();

    $userid = $inData["userid"];
    $contactid = $inData["contactid"];
    $firstname = $inData["firstname"];
    $lastname = $inData["lastname"];
    $email = $inData["email"];
    $phonenumber = $inData["phonenumber"];

    $conn = new mysqli('localhost', 'root', '8C@UnIoOwUK2k7gZl%N9Mi', 'cookiebook');

    if ($conn->connect_error)
    {
        returnWithError($conn->connect_error);
    }
    else
    {
        $sql = "UPDATE contacts SET firstname='" . $firstname . "', lastname='" . $lastname . "', email='" . $email . "', phonenumber='" . $phonenumber . "' WHERE userid='" . $userid . "' AND contactid='" . $contactid . "'";
        echo $sql;
        
        if($result = $conn->query($sql) != TRUE)
		{
			returnWithError("contact edit failed.");
        }
        else
        {
            returnWithInfo($userid, $contactid, "edited contact!");
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


