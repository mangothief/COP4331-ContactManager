<?php 
    // Delete from contacts table.
    $inData = getRequestInfo();

    $userid = $inData["userid"];
    $contactid = $inData["contactid"];

    $conn = new mysqli('localhost', 'root', '8C@UnIoOwUK2k7gZl%N9Mi', 'cookiebook');

    if ($conn->connect_error)
    {
        returnWithError($conn->connect_error);
    }
    else
    {
        // Check if contact exists.
        $sql = "SELECT FROM contacts WHERE userid='" . $userid . "' AND contactid=$contactid";
        echo $sql;
        
        $result = $conn->query($sql);
        if ($result->num_rows > 0)
        {
            $sql = "DELETE FROM contacts WHERE userid='" . $userid . "' AND contactid=$contactid";
        
            if ($result = $conn->query($sql) != TRUE)
            {
                returnWithError("Couldn't delete contact.");
            }
            else
            {
                returnWithInfo($userid, $contactid, "Successfully deleted contact!");
            }
        }
        else 
        {
            returnWithError("Contact not found.")
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