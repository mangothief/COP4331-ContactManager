<?php
   // fetch JSON request
   $inData = getRequestInfo();
   // new username
   $username = $inData['username'];
   // new password
   $password = $inData['password'];

   // connect to mysql database
   $conn = new mysqli('localhost', 'root', '8C@UnIoOwUK2k7gZl%N9Mi', 'cookiebook');

   // check for connectivity issues
   if ($conn->connect_error) 
   {
      returnWithError($conn->connect_error);
   }
   else
   {
      // query the database with the user information
      $sql = "insert into users (username,password) VALUES ('" . $username . "','" . $password . "')";
      returnWithError($sql);
      // check if records are inserted
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
      $retValue = '{"userid:0, "username":"","password":"","error":"' . $err . '"}';
      sendResultInfoAsJson($retValue);
   }

   function returnWithInfo($username, $password, $userid)
   {
      $retValue = '{"userid":' . $userid . ',"username":"' . $username . '","password":"' . $password . '","error":""}';
		sendResultInfoAsJson($retValue);
   }
?>