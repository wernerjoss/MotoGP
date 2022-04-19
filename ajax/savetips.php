<?php
	$request = $_REQUEST; //a PHP Super Global variable which used to collect data after submitting it from the form
	$eid = $request['EID']; //get the date of birth from collected data above
	$nick = $request['Nick']; //get the date of birth from collected data above
	$p1 = $request['P1'];
	$p2 = $request['P2'];
	$p3 = $request['P3'];
	
	include "../include/connect.php";
	
	$mysqli = new mysqli($db_host, $db_user, $db_pw, $db_name);

	if ($mysqli->connect_errno) {
	  echo "Failed to connect to MySQL: " . $mysqli->connect_error;
	  exit();
	}

	/*
	determine UID from Nickname
	*/
	$uid = null;
	$sql = "SELECT UID from MGP_users WHERE Nickname=".'"'.$nick.'"';
	//	echo $sql;
	$result = $mysqli->query($sql);
	$rows = mysqli_num_rows($result);
	/*
	echo $rows;
	return;
	*/
	if ($rows>0) {
		$row = $result->fetch_all(MYSQLI_ASSOC);
		$res = $row[0];
		//	echo print_r($res);
		$uid = intval($res["UID"]);
	}
	/*
	echo $uid;
	return;
	*/
	$sql = "SELECT * from MGP_tips WHERE EID=".$eid." AND UID=".$uid;
	$result = $mysqli->query($sql);
	if (mysqli_num_rows($result)==0) { 
		$sql = "INSERT INTO MGP_tips (EID, UID, P1, P2, P3)
		VALUES ('".$eid."', '".$uid."','".$p1."', '".$p2."', '".$p3."')";
	}	else	{
		$sql = "UPDATE MGP_tips SET P1=".$p1.", P2=".$p2." , P3=".$p3." WHERE EID=".$eid." AND UID=".$uid;
	}
	//	echo $sql;
	
	//	INSERT or UPDATE SQL data
	//	$sql = "INSERT INTO MGP_tips (EID, UID, P1, P2, P3)	VALUES ('".$eid."', '".$uid."','".$p1."', '".$p2."', '".$p3."')";
	//	echo $sql;
	// Process the query so that we will save the date of birth
	if ($mysqli->query($sql)) {
	  echo "Tips record has been saved successfully - be sure to reload page to see the results!";
	} else {
	  return "Error: " . $sql . "<br>" . $mysqli->error;
	}

	// Close the connection after using it
	$mysqli->close();
?>