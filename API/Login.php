<?php
   // Login as a user.
   $inData = getRequestInfo();

   $userid = 0;
   // username attempt
   $username = "";
   // password attempt
   $password = "";
   $datelaston = date("Y/m/d");
   
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
      $sql = "SELECT userid,username,password FROM users where username='" . $inData["username"] . "' AND password='" . $inData["password"] . "'";
      echo $sql;
      $result = $conn->query($sql);
      // check if user and password match records
      if ($result->num_rows > 0)
      {
         $row = $result->fetch_assoc();
         //$username = $row["username"];
         //$password = $row["password"];
         $userid = $row["userid"];

         //update datelaston

         returnWithInfo($userid, "Successful Login!");
      }
      else
      {
         returnWithError("No Records Found");
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
      $retValue = '{"userid":"","username":"","password":"","error":"' . $err . '"}';
      sendResultInfoAsJson($retValue);
   }

   function returnWithInfo($userid, $info)
   {
      $retValue = '{"userid":' . $userid . ',"info":"' . $info . '"}';
		sendResultInfoAsJson($retValue);
   }
?>
