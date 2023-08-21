<?php
	$request = $_REQUEST; //a PHP Super Global variable which used to collect data after submitting it from the form
	$email = $request['Email']; //get the date of birth from collected data above
	$firstname = $request['Vorname']; //get the date of birth from collected data above
	$name = $request['Name'];
	$nickname = $request['Nickname'];
	$password = $request['Passwort'];

	$verbose = false;

	include "../include/connect.php";
	
	$mysqli = new mysqli($db_host, $db_user, $db_pw, $db_name);

	if ($mysqli->connect_errno) {
	  echo "Failed to connect to MySQL: " . $mysqli->connect_error;
	  exit();
	}

	$sql = "SELECT UID from MGP_users WHERE 1";
	$results = $mysqli->query($sql);
	$uids = $results->fetch_all(MYSQLI_ASSOC);
	foreach ($uids as $uid)	{
		if ($verbose)	echo $uid["UID"]."\n";
	}
	$lastuid = $uid["UID"] + 1;
	if ($verbose)	echo "LastUid ".$lastuid;
	
	// Set the INSERT SQL data - UID must be AUTO_INCREMENT !	02.04.23: calculate new UID 
	$sql = "INSERT INTO MGP_users (UID, Name, Vorname, Nickname, Email, Passwort)
	VALUES ('".$lastuid."','".$name."', '".$firstname."','".$nickname."', '".$email."', '".$password."')";
	
	if ($verbose)	echo ("sql:".$sql."\n");
	
	// Process the query so that we will save the date of birth
	if ($mysqli->query($sql)) {
	  echo "Participant has been created successfully.";
	} else {
	  return "Error: " . $sql . "<br>" . $mysqli->error;
	}

	// Close the connection after using it
	$mysqli->close();
?>