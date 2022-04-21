<?php
	$request = $_REQUEST; //a PHP Super Global variable which used to collect data after submitting it from the form
	$email = $request['Email']; //get the date of birth from collected data above
	$firstname = $request['Vorname']; //get the date of birth from collected data above
	$name = $request['Name'];
	$nickname = $request['Nickname'];
	$password = $request['Passwort'];

	include "../include/connect.php";
	
	$mysqli = new mysqli($db_host, $db_user, $db_pw, $db_name);

	if ($mysqli->connect_errno) {
	  echo "Failed to connect to MySQL: " . $mysqli->connect_error;
	  exit();
	}

	// Set the INSERT SQL data
	$sql = "INSERT INTO MGP_users (UID, Name, Nickname, Vorname, Email, Passwort)
	VALUES (NULL,'".$name."', '".$firstname."','".$nickname."', '".$email."', '".$password."')";

	// Process the query so that we will save the date of birth
	if ($mysqli->query($sql)) {
	  echo "Participant has been created successfully.";
	} else {
	  return "Error: " . $sql . "<br>" . $mysqli->error;
	}

	// Close the connection after using it
	$mysqli->close();
?>