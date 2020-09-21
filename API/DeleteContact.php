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
        $sql = "DELETE FROM contacts where userid=" . $userid . "AND contactid='" . $contactid . "'";
        returnWithError($sql);
        if($result = $conn->query($sql) != TRUE)
		{
			returnWithError($conn->error);
        }
        else
        {
            returnWithInfo($userid, $contactid, "deleted contact!");
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
        $retValue = '{"userid":' . $userid . ',"contactid":"' . $contactid . '","info":"' . $info . '"}';
        sendResultInfoAsJson($retValue);
    }
?>