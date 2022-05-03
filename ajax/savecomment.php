<?php
	$request = $_REQUEST; //a PHP Super Global variable which used to collect data after submitting it from the form
	$nick = $request['Nickname'];
	$eid = $request['EID'];
	$comment = $request['Kommentar'];
	
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
	if ($rows>0) {
		$row = $result->fetch_all(MYSQLI_ASSOC);
		$res = $row[0];
		//	echo print_r($res);
		$uid = intval($res["UID"]);
	}	else	{
		echo "Nickname not found - nothing stored !";
		return;
	}
	// get last CID
	$sql = "SELECT CID from MGP_comments";
	$result = $mysqli->query($sql);
	$numrows = mysqli_num_rows($result);
	if ($numrows>0) {
		$rows = $result->fetch_all(MYSQLI_ASSOC);
		foreach ($rows as $row)	{
			$res = $row;
			//	echo print_r($res);
		}
		$cid = intval($res["CID"]);	// get last CID
		//	echo "Last CID:".$cid."<br>";
	}
	$cid += 1;	// increment last CID by one
	$sql = "SELECT LOCALTIME";
	$result = $mysqli->query($sql);	// get current Date/Time
	$rows = mysqli_num_rows($result);
	echo $rows;
	if ($rows>0) {
		$row = $result->fetch_all(MYSQLI_ASSOC);
		//	echo print_r($row);
		$arr = $row[0];
		$dt = $arr['LOCALTIME'];
		//	echo print_r($dt);
	}
	//	INSERT SQL data
	$sql = "INSERT INTO MGP_comments (CID, EID, UID, Date, Comment)
	VALUES ('".$cid."','".$eid."', '".$uid."','".$dt."', '".$comment."')";
	//	echo $sql;
	//	return;
	if ($mysqli->query($sql)) {
		echo "Comment record has been saved successfully - be sure to reload page to see the results!";
	} else {
		echo "Error: " . $sql . "<br>" . $mysqli->error;
		return "Error: " . $sql . "<br>" . $mysqli->error;
	}

	// Close the connection after using it
	$mysqli->close();
?>