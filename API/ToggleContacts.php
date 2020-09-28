<?php
    // Return array of contacts, sorted by either: 
    // datecreated, or by [last, first].
	$inData = getRequestInfo();

    // We are given an array in json format.
    $contactsJson = $inData["results"];
    
    $firstname = "";
    $lastname = "";

    $unsortedContacts = "";
	$sortedContacts = "";

    $conn = new mysqli('localhost', 'root', '8C@UnIoOwUK2k7gZl%N9Mi', 'cookiebook');
      
	if ($conn->connect_error) 
	{
		returnWithError("Connection Failed.");
	} 
	else
	{
        // Decode json
        $unsortedContacts = json_decode($contactsJson, true);
        $sortBy = "lastname";
        // Find proper key for sorting
        foreach ($unsortedContacts as $key => $jsons)
        { 
            foreach($jsons as $key => $value) 
            {
                if ($key == $sortBy)
                    echo $value;
            }
       }
        // Bubble sort 
        // $len = count($unsortedContacts);
        // for($i=0; $i < $len; $i++)
        // {
        //     for($j=0; $j < $len; $j++)
        //     {
        //         if (strcmp($unsortedContacts[$j], $unsortedContacts[$j+1]) > 0)
        //             echo "swap";
        //     }
        // }

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
	
	function returnWithInfo($sortedContacts)   
	{
		$retValue = '{"contacts":' . $sortedContacts . '}';
		sendResultInfoAsJson($retValue);
	}
?>