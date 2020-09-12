<?php 

    $inData = getRequestInfo();

    $userid = $inData["userid"];
    $username = $inData["username"]
    $password = $inData["password"];


    $conn = new mysqli('localhost', 'root', '8C@UnIoOwUK2k7gZl%N9Mi', 'cookiebook');

    if ($conn->connect_error)
    {
        returnWithError($conn->connect_error);
    }
    else
    {
        $sql = "DELETE FROM users (userid,username,password) VALUES (" . $userid . ",'" . $username . "','" . $password . "')";
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