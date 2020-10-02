<?php
    // Delete a user, and all associated contacts.
    $inData = getRequestInfo();

    // must be logged in as correct userid.
    $userid = $inData["userid"];
    // provide correct email and password.
    $email = $inData["email"];
    $password = $inData["password"];

    $conn = new mysqli('localhost', 'root', '8C@UnIoOwUK2k7gZl%N9Mi', 'cookiebook');

    if ($conn->connect_error)
    {
        returnWithError("Connection Failed.");
    }
    else
    {
        // Check if email and password match.
        $sql = "SELECT* FROM users WHERE email=$email AND password=$password AND userid=$userid";
        $result = $conn->query($sql);
        echo $sql;

		if ($result->num_rows > 0)
        {
            // Delete contacts. 
            $sql = "DELETE FROM contacts WHERE userid='" . $userid . "'";
            if ($result = $conn->query($sql) != TRUE)
            {
                returnWithError("Failed to Delete Contacts.");
            }
            else
            {
                $sql = "DELETE FROM users WHERE userid='" . $userid . "'";
                //echo $sql;
                if ($result = $conn->query($sql) != TRUE)
                {
                    returnWithError("Deletion Failed.");
                }
                else
                {
                    returnWithInfo($userid, "Successfully Deleted User.");
                }
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
