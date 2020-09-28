<?php
    // Delete a user.
    $inData = getRequestInfo();

    // must be logged in as correct userid.
    $userid = $inData["userid"];
    // provide correct username and password.
    $username = $inData["username"];
    $password = $inData["password"];

    $conn = new mysqli('localhost', 'root', '8C@UnIoOwUK2k7gZl%N9Mi', 'cookiebook');

    if ($conn->connect_error)
    {
        returnWithError("Connection Failed.");
    }
    else
    {
        // Check if username and password match.
        $sql = "SELECT* FROM users WHERE username=$username AND password=$password AND userid=$userid";
        $result = $conn->query($sql);
        echo $sql;
        
		if ($result->num_rows > 0)
        {
            $sql = "DELETE FROM users WHERE userid='" . $userid . "'";
            echo $sql;
            if ($result = $conn->query($sql) != TRUE)
            {
                returnWithError("Deletion Failed.");
            }
            else
            {
                returnWithInfo($userid, $contactid, "Successfully Deleted User.");
            }
        }
        else
        {
            returnWithError("Incorrect Credentials.");
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
    
    function returnWithInfo($userid, $info)
    {
        $retValue = '{"userid":' . $userid . ',"info":"' . $info . '"}';
        sendResultInfoAsJson($retValue);
    }
?>
