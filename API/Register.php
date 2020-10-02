<?php
   // Register a user.
   $inData = getRequestInfo();

   $email = $inData['email'];
   $password = $inData['password'];
   $datecreated = date("m/d/Y h:i:s a", time());
   $datelaston = $datecreated;

   // hash password
   $password = password_hash($password, PASSWORD_DEFAULT);
   // connect to mysql database
   $conn = new mysqli('localhost', 'root', '8C@UnIoOwUK2k7gZl%N9Mi', 'cookiebook');
   // check for connectivity issues
   if ($conn->connect_error) 
   {
      returnWithError("Connection Failed.");
   }
   else
   {
      // query the database with the user information
      $sql = "INSERT into users(email,password,datecreated,datelaston) VALUES ('" . $email . "','" . $password . "','" . $datecreated . "','" . $datelaston . "')";
      // check if records are inserted
      if($result = $conn->query($sql) != TRUE)
		{
			returnWithError("Register Failed.");
      }
      else
      {
         returnWithInfo("Registered User!");
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

   function returnWithInfo($info)
   {
      $retValue = '{"info":"' . $info . '"}';
		sendResultInfoAsJson($retValue);
   }
?>
