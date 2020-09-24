<?php
    $addContactSQL = "SELECT* from contacts WHERE userid="' . $userid . '"AND contactid="' . $contactid . '"";
    echo $addContactSQL;
    $searchContactsSQL = "SELECT contactid FROM contacts where firstname LIKE '%" . $inData["search"] . "%' OR lastname LIKE '%" . $inData["search"] . "%' OR email LIKE '%" . $inData["search"] . "%' AND userid=" . $inData["userid"];
    echo $searchContactsSQL;
    $editContactSQL = "UPDATE contacts SET firstname='" . $firstname . "', lastname='" . $lastname . "', email='" . $email . "', phonenumber='" . $phonenumber . "' WHERE userid='" . $userid . "' AND contactid='" . $contactid . "'";
    echo $editContactSQL;
    $registerSQL = "INSERT into users(username,password) VALUES ('" . $username . "','" . $password . "')";
    echo $registerSQL;
?>