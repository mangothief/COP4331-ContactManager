<?php
   
   $inData = getRequestInfo();

   $userid = 0;
   $username = "";
   $password = "";
   
   $conn = new mysqli('localhost', 'root', '8C@UnIoOwUK2k7gZl%N9Mi', 'contactlistdb');

   if ($conn->connect_error) 
   {
      returnWithError($conn->connect_error);
   }
   else
   {
      $sql = "SELECT userid,username,password FROM users where username='" . $inData["username"] . "' and password='" . $inData["password"] . "'";
      // TEST: SELECT userid, username,password FROM users where username='<username>' and  password='<password>'
      $result = $conn->query($sql);
      if ($result->num_rows > 0)
      {
         $row = $result->fetch_assoc();
         $username = $row["username"];
         $password = $row["password"];
         $userid = $row["userid"];

         returnWithInfo($username, $password, $id);
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
      $retValue = '{"userid:0, "username":"","password":"","error":"' . $err . '"}';
      sendResultInfoAsJson($retValue);
   }

   function returnWithInfo($username, $password, $userid)
   {
      $retValue = '{"userid":' . $userid . ',"username":"' . $password . '","password":"' . $password . '","error":""}';
		sendResultInfoAsJson($retValue);
   }
?>