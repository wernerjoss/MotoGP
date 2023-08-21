<!doctype html>
<html lang="de">
<head>
	<meta charset="UTF-8">
	<title>MotoGP Tipspiel - Event bearbeiten</title>

  	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="../assets/bootstrap-4.4.1/css/bootstrap.min.css">
  	
  	<!-- Page CSS -->
  	<link rel="stylesheet" href="../assets/css/styles.css">
</head>
  
<body>
   
	<div class="container">

		<br><br>

	    <h1>Hoernerfranzracing MotoGP Tipspiel - Events</h1>

	    <br><br>
	    
	    <?php
			$Nickname = $_GET["nick"];
			// remember Nickname as Session var for Convenience (keep 'logged in' Status during Session)
			if (isset($Nickname))	{ 
				$_SESSION["nick"] = $Nickname; 
			}
			if (isset($_SESSION["nick"])) {
				$Nickname = $_SESSION["nick"];
			}
			//	Achtung: $Nickname muss in den span id="Nickname" !!! (wird von getresults.js als hidden input ins Formular eingefügt und somit an savetips.php weitergegeben)
			if (isset($Nickname)) {
				// Determine UID from Nickname:
				$UID = -1;
				include "../include/connect.php";
				$mysqli = new mysqli($db_host, $db_user, $db_pw, $db_name);
				if ($mysqli->connect_errno) {
					echo "Failed to connect to MySQL: " . $mysqli->connect_error;
					exit();
				}
				$sql = 'SELECT UID FROM MGP_users WHERE Nickname = '."\"$Nickname\"";
				//	echo $sql;
				$results = $mysqli->query($sql);
				$row = $results->fetch_all(MYSQLI_ASSOC);
				if (is_array($row))	{
					$UID = $row[0]["UID"];
				}
				//	echo "<br>UID:".$UID;
				$results->free_result();
				$mysqli->close();

				//	DONE: check for UID=1, NOT md5 Hash from Nickname !
				if ($UID == 1) {	// 1 = UID des Superusers !
					echo '<span id="Nickname" style="display:none">';echo $Nickname;echo '</span>';
					echo '<div class="row">
					<div class="col-md-4">
						<h3>Ergebnis hinzufügen oder Deadline ändern (nur eins !)</h3>
						<form action="saveevent.php" id="form">
							<div class="form-group">
								<label for="EID">EID</label>
								<input class="form-control" type="text" name="EID">
							</div>
							<div class="form-group">
								<label for="P1">P1</label>
								<input class="form-control" type="text" name="P1">
							</div>
							<div class="form-group">
								<label for="P2">P2</label>
								<input class="form-control" type="text" name="P2">
							</div>
							<div class="form-group">
								<label for="P3">P3</label>
								<input class="form-control" type="text" name="P3">
							</div>
							<div class="form-group">
								<label for="Deadline">Deadline YYYY-MM-DD hh:mm:ss</label>
								<input class="form-control" type="text" name="Deadline">
							</div>
							<button type="button" class="btn btn-primary" id="btnSubmit">Submit</button>
						</form>
					</div>
					</div>
					<p></p>
					<div class="row">
						<div class="col-md-8">
							<h3>Ergebnis-Liste</h3>
							<div id="results-list"></div>
						</div>
					</div>';
				}	else	{
					echo '<div class="row">
						<div class="col-md-8">
						Sorry, kein Zugang hier :-)
						</div>
					</div>';	
				}
			}	else	{
				echo '<div class="row">
					<div class="col-md-8">
					Sorry, kein Zugang hier :-)
					</div>
				</div>';	
			}
		?>
	</div>

	<!-- Must put our javascript files here to fast the page loading -->
	
	<!-- jQuery library local -->
	<script src="../assets/js/jquery-3.6.0.min.js"></script>
	<!-- Bootstrap JS local -->
	<script src="../assets/bootstrap-4.4.1/js/bootstrap.min.js"></script>
	<!-- Page Script -->
	<!--
	-->
	<script src="../assets/js/editevent.js"></script>
	
</body>
  
</html>