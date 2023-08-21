<?php
	$request = $_REQUEST; //a PHP Super Global variable which used to collect data after submitting it from the form
	$eid = $request['EID']; //get the date of birth from collected data above
	$p1 = $request['P1'];
	$p2 = $request['P2'];
	$p3 = $request['P3'];
	$DL = $request['Deadline'];
	
	include "../include/connect.php";
	
	$mysqli = new mysqli($db_host, $db_user, $db_pw, $db_name);

	if ($mysqli->connect_errno) {
	  echo "Failed to connect to MySQL: " . $mysqli->connect_error;
	  exit();
	}

	$sql = null;
	if (strlen($p1) > 0)
		$sql = "UPDATE MGP_events SET P1=".$p1." , P2=".$p2.", P3=".$p3." WHERE EID=".$eid;
	if (strlen($DL) > 0)
		$sql = "UPDATE MGP_events SET Deadline='".$DL."' WHERE EID=".$eid;
	if (strlen($sql) > 0)	{
		echo $sql;
		// Process the query so that we will save the date of birth
		if ($mysqli->query($sql)) {
			echo "Event has been updated successfully.";
		} else {
			return "Error: " . $sql . "<br>" . $mysqli->error;
		}
	}

	// Close the connection after using it
	$mysqli->close();
?>