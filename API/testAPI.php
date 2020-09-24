<?php
    $inData = getRequestInfo();
    
    $conn = new mysqli('localhost', 'root', '8C@UnIoOwUK2k7gZl%N9Mi', 'cookiebook');

    // check for connectivity issues
    if ($conn->connect_error) 
    {
        echo "error";
    }
    else
    {
        $addContactSQL = "SELECT* from contacts WHERE userid="' . $userid . '"AND contactid="' . $contactid . '"";
        echo $addContactSQL;
        $searchContactsSQL = "SELECT contactid FROM contacts where firstname LIKE '%" . $inData["search"] . "%' OR lastname LIKE '%" . $inData["search"] . "%' OR email LIKE '%" . $inData["search"] . "%' AND userid=" . $inData["userid"];
        echo $searchContactsSQL;
        $editContactSQL = "UPDATE contacts SET firstname='" . $firstname . "', lastname='" . $lastname . "', email='" . $email . "', phonenumber='" . $phonenumber . "' WHERE userid='" . $userid . "' AND contactid='" . $contactid . "'";
        echo $editContactSQL;
        $registerSQL = "INSERT into users(username,password) VALUES ('" . $username . "','" . $password . "')";
        echo $registerSQL;
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
	
	function returnWithInfo($searchResults)
	{
		$retValue = '{"results":[' . $searchResults . ']"}';
		sendResultInfoAsJson($retValue);
	}
?>

?>