<?php
	$request = $_REQUEST; //a PHP Super Global variable which used to collect data after submitting it from the form
	$nick = $request['Nickname'];
	$P1 = $request['P1'];
	$P2 = $request['P2'];
	$P3 = $request['P3'];
	
	// Test Input Values
	if (!is_numeric($P1)) {
		echo "Invalid Value for P1 - nothing stored !";
		return;
	}
	if (!is_numeric($P2)) {
		echo "Invalid Value for P2 - nothing stored !";
		return;
	}
	if (!is_numeric($P3)) {
		echo "Invalid Value for P3 - nothing stored !";
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
	//  echo $sql;
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
    //  TODO: check if $P1 is in riders list
    
	//	INSERT or UPDATE MGP_wmtips Table
	$sql = "SELECT * from MGP_wmtips WHERE UID=".$uid;
	$result = $mysqli->query($sql);
	if (mysqli_num_rows($result)==0) { 
		$sql = "INSERT INTO MGP_wmtips (UID, P1, P2, P3)
		VALUES ('".$uid."','".$P1."','".$P2."','".$P3."')";
	}	else	{
		$sql = "UPDATE MGP_wmtips SET P1=".$P1.",P2=".$P2.",P3=".$P3." WHERE UID=".$uid;
	}
	echo $sql;
	if ($mysqli->query($sql)) {
		echo "WM Tip record has been saved successfully - be sure to reload page to see the results!";
	} else {
		echo "Error: " . $sql . "<br>" . $mysqli->error;
		return "Error: " . $sql . "<br>" . $mysqli->error;
	}

	// Close the connection after using it
	$mysqli->close();
?>