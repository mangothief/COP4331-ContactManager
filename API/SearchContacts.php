<?php
    // Search by all contact attributes. 
	$inData = getRequestInfo();
    
    $firstname = "";
    $lastname = "";
    $email = "";
    $userid = $inData["userid"];
    $contactid = 0;

	$searchResults = "";
    $searchCount = 0;

    $conn = new mysqli('localhost', 'root', '8C@UnIoOwUK2k7gZl%N9Mi', 'cookiebook');
      
	if ($conn->connect_error) 
	{
		returnWithError($conn->connect_error);
	} 
	else
	{
        $search = $inData["search"];
        // Cross-reference searched name with firstnames and lastnames in contacts.
        $sql = "SELECT contactid,firstname,lastname,email FROM contacts where firstname LIKE '%" . $search . "%' OR lastname LIKE '%" . $search . "%' OR email LIKE '%" . $search . "%' AND userid=" . $userid;
        echo $sql;
        
        $result = $conn->query($sql);
        
        // Number of contacts we must search.
        $searchCount = $result->num_rows;
        echo "\nnum rows:" . $searchCount . "\n";
        //echo $searchCount;
        // Contacts left to search.
        if ($searchcount > 0)
        {
            echo "here\n";
            $searchResults .= "[";
            while ($searchCount > 0)
            {
                echo "here\n";
                $row = $result->fetch_assoc();
                $thisJsonObject = '{"contactid":' . $row["contactid"] . '"}';
                
                // Push json object onto array for matching contact
                $searchResults .= $thisJsonObject;
    
                if ($searchCount > 1)
                {
                    $searchResults .= ",";
                }

                $searchCount--; // decrement search
            }
            $searchResults .= "]";
            returnWithInfo($searchResults);
        }
        else
        {
            returnWithError("No Records Found.");
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
	
	function returnWithInfo($searchResults)
	{
		$retValue = '{"results:["' . $searchResults . '"]"}';
		sendResultInfoAsJson($retValue);
	}
?>