<?php
   // fetch JSON request
   $inData = getRequestInfo();

   // userid
   $userid =$inData['userid'];
   // new username
   $username = $inData['username'];
   // new password
   $password1 = $inData['password'];
   // new phonenumber
   $phonenumber = $inData['phonenumber'];
   // new email
   $email = $inData['email'];

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
      $sql = "insert into user (userid,username,password,phonenumber,email)
      VALUES (" . $userid . ",'" . $username . ",'" . $password . ",'" 
                                 . $phonenumber . ",'" . $email . "')";
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
      $retValue = '{"userid":' . $userid . ',"username":"' . $password . '","password":"' . $password . '","error":""}';
		sendResultInfoAsJson($retValue);
   }
?>