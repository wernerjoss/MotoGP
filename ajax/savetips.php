<?php
	$request = $_REQUEST; //a PHP Super Global variable which used to collect data after submitting it from the form
	$nick = $request['Nickname'];
	$eid = $request['EID'];
	$p1 = $request['P1'];
	$p2 = $request['P2'];
	$p3 = $request['P3'];
	
	// Test Input Values
	if (!is_numeric($p1)) {
		echo "Invalid Value for P1 - nothing stored !";
		return;
	}
	if (!is_numeric($p2)) {
		echo "Invalid Value for P2 - nothing stored !";
		return;
	}
	if (!is_numeric($p2)) {
		echo "Invalid Value for P3 - nothing stored !";
		return;
	}

	if (!is_numeric($eid)) {
		echo "Invalid Value for Event ID - nothing stored !";
		return;
	}

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
	}	else	{
		echo "Nickname not found - nothing stored !";
		return;
	}
	// get last TID
	$sql = "SELECT * from MGP_tips";
	$result = $mysqli->query($sql);
	$numrows = mysqli_num_rows($result);
	if ($numrows>0) {
		$rows = $result->fetch_all(MYSQLI_ASSOC);
		foreach ($rows as $row)	{
			$res = $row;
			//	echo print_r($res);
		}
		$tid = intval($res["TID"]);	// get last TID
		//	echo "Last TID:".$tid."<br>";
	}
	$tid += 1;	// increment last TID by one
	//	INSERT or UPDATE SQL data
	$sql = "SELECT * from MGP_tips WHERE EID=".$eid." AND UID=".$uid;
	$result = $mysqli->query($sql);
	if (mysqli_num_rows($result)==0) { 
		$sql = "INSERT INTO MGP_tips (TID, EID, UID, P1, P2, P3)
		VALUES ('".$tid."','".$eid."', '".$uid."','".$p1."', '".$p2."', '".$p3."')";
	}	else	{
		$sql = "UPDATE MGP_tips SET P1=".$p1.", P2=".$p2." , P3=".$p3." WHERE EID=".$eid." AND UID=".$uid;
	}
	echo $sql;
	if ($mysqli->query($sql)) {
		echo "Tips record has been saved successfully - be sure to reload page to see the results!";
	} else {
		echo "Error: " . $sql . "<br>" . $mysqli->error;
		return "Error: " . $sql . "<br>" . $mysqli->error;
	}

	// Close the connection after using it
	$mysqli->close();
?>