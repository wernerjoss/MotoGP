<?php
	$request = $_REQUEST; //a PHP Super Global variable which used to collect data after submitting it from the form
	$eid = $request['EID']; //get the date of birth from collected data above
	$p1 = $request['P1'];
	$p2 = $request['P2'];
	$p3 = $request['P3'];
	
	include "../include/connect.php";
	
	$mysqli = new mysqli($db_host, $db_user, $db_pw, $db_name);

	if ($mysqli->connect_errno) {
	  echo "Failed to connect to MySQL: " . $mysqli->connect_error;
	  exit();
	}

	// Set the INSERT SQL data
	$sql = "INSERT INTO MGP_users (UID, Name, Nickname, Vorname, Email, Passwort)
	VALUES (NULL,'".$name."', '".$firstname."','".$nickname."', '".$email."', '".$password."')";

	$sql = "UPDATE MGP_events SET P1=".$p1." , P2=".$p2.", P3=".$p3." WHERE EID=".$eid;
	echo $sql;
	// Process the query so that we will save the date of birth
	if ($mysqli->query($sql)) {
	  echo "Event has been updated successfully.";
	} else {
	  return "Error: " . $sql . "<br>" . $mysqli->error;
	}

	// Close the connection after using it
	$mysqli->close();
?>