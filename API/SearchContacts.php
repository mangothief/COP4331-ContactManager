<?php
    // Search by contact attributes. 
	$inData = getRequestInfo();
    
    $firstname = "";
    $lastname = "";
    $email = "";
    $userid = $inData["userid"];
    $search = $inData["search"];
    $field = $inData["field"];
    $order = $inData["order"];
    $contactid = 0;

	$searchResults = "";
    $searchCount = 0;
    $rowLimit = 10;

    // Search by a given field in table.
    if (!strcmp($order, "fullname") || !strcmp($order, "name"))
    {
        $order = "contacts.lastname, contacts.firstname";
    }
    else if (!strcmp($order, "datecreated") || !strcmp($order, "date"))
    {
        $order = "contacts.datecreated";
    }
    else if (!strcmp($order, "favoritecookie") || !strcmp($order, "cookie"))
    {
        $order = "contacts.favoritecookie";
    }

    $conn = new mysqli('localhost', 'root', '8C@UnIoOwUK2k7gZl%N9Mi', 'cookiebook');
      
	if ($conn->connect_error) 
	{
		returnWithError("Connection Failed.");
	} 
	else
	{
        // Show all results if search is empty.
        if (!strcmp($search, ""))
        {
            $sql = "SELECT* FROM contacts where userid=" . $userid . ' ORDER BY ' . $order . ' ASC LIMIT ' . $rowLimit;
        }
        else if (!strcmp($field, "name")) // search by name
        {
            $sql = "SELECT* FROM contacts where firstname LIKE '%" . $search . "%' OR lastname LIKE '%" . $search . "%' AND userid=" . $userid . ' ORDER BY ' . $order .  ' ASC LIMIT ' . $rowLimit;  
        }
        else if (!strcmp($field, "favoritecookie")) // search by cookie
        {
            $sql = "SELECT* FROM contacts where favoritecookie LIKE '%" . $search . "%' AND userid=" . $userid . ' ORDER BY ' . $order .  ' ASC LIMIT ' . $rowLimit;
        }
        else // search by date
        {
            $sql = "SELECT* FROM contacts where datecreated LIKE '%" . $search . "%' AND userid=" . $userid . ' ORDER BY ' . $order .  ' ASC LIMIT ' . $rowLimit;
        }

        $result = $conn->query($sql);
        // Number of contacts we must search.
        $searchCount = $result->num_rows;
        // Contacts left to search.
        if ($searchCount > 0)
        {
            $searchResults .= "[";
            while ($searchCount > 0)
            {
                $row = $result->fetch_assoc();
                $thisJsonObject = '{"contactid":' . $row["contactid"] . ',"firstname":"' . $row["firstname"] . '","lastname":"' . $row["lastname"] . '","email":"' . $row["email"] . '","phonenumber":"' . $row["phonenumber"] . '","favoritecookie":"' . $row["favoritecookie"] . '","datecreated":"' . $inData["datecreated"] . '"}';
                
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
		$retValue = '{"results":' . $searchResults . '}';
		sendResultInfoAsJson($retValue);
	}
?>