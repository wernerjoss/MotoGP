<?php
// Start the session
session_start();
?>
<!doctype html>
<html lang="de">
<head>
	<meta charset="UTF-8">
	<title>MotoGP Tipspiel</title>

  	<!-- Bootstrap CSS local -->
	<link rel="stylesheet" href="assets/bootstrap-4.4.1/css/bootstrap.min.css">
	<!-- Page CSS -->
  	<link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
		<div id = "top" class="container">
		<ul class="nav">
		<li class="nav-item">
			<a class="nav-link active" href="./">Home</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="comments.php">Kommentare</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="riders.html">Fahrerliste</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="howto.html">Anleitung</a>
		</li>
		</ul>
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
				//if (md5("$Nickname") == "0209fffded52973ca4ff82f5333b3de1")		{	// md5 Hash des Superuser-Nicks :-)

				// Determine UID from Nickname:
				$UID = -1;
				include "./include/connect.php";
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
					echo '			
					<ul class="nav">
					<li class="nav-item">
						<a class="nav-link active" href="./admin/editevent.php?nick=';echo $Nickname;
						echo '">Edit Event</a>
					</li>
					<li class="nav-item">
						<a class="nav-link active" href="./admin/adduser.php?nick=';echo $Nickname;
						echo '">Add User</a>
					</li>
					</ul>					';
				}
				echo '<br><br>
				<h2>Hoernerfranzracing MotoGP Tipspiel</h2>
				<br><br>
				<div id="TipForm">
					<div class="row">
						<div class="col-md-6">
							<span id="Nickname" style="display:none">';echo $Nickname;echo '</span>
							<h3>Hallo <span id="Vorname"></span></h3>
							<h3>Dein Tip für MotoGP Race</h3><h3><span id="Event"></span></h3><h3><span id="Deadline"></span></h3>
							<form action="ajax/savetips.php" id="form">
								<span id="EidUid" style="display:none"></span>
								<div id="TipForm" class="row">
								<div class="col-sm-4">
									<label for="P1">P1</label>
									<input class="form-control" type="text" name="P1">
								</div>
								<div class="col-sm-4">
									<label for="P2">P2</label>
									<input class="form-control" type="text" name="P2">
								</div>
								<div class="col-sm-4">
									<label for="P3">P3</label>
									<input class="form-control" type="text" name="P3">
								</div>
									<div class="col-sm-4" style="margin-top: 1em;">
									<button type="button" class="btn btn-primary" id="btnSubmit">Absenden</button>
									</div>
								</div>
							</form>
							<h3 style="margin-top:1em;">Achtung: in die Eingabefelder dürfen NUR Startnummern eingetragen werden, KEINE Namen !</h3>
						</div>
					</div>
					<p></p>
				</div>';
				echo'
				<div id="tooLate">
					<div class="row">
						<div class="col-md-6">
						<h3>Sorry, du bist zu spät dran, Tips können nur bis zur Deadline abgegeben werden !</h3>
						</div>
					</div>
				</div>';
			}	else	{
				echo '<div class="row">
				<div class="col-md-8">
				<h3>Hallo Gast, du bist nicht angemeldet und kannst daher nicht am Tipspiel teilnehmen, nur Ergebnisse ansehen.</h3><br>
				</div>
				</div>';
			}
		?>
		<ul class="nav">
		<li class="nav-item">
			<a class="nav-link" href="#results-list">-> Rennergebnisse</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="#tips-list">-> Tips Liste</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="#scores-list">-> Punkte Liste</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="#ranking-list">-> Punktestand</a>
		</li>
		</ul>
		<div class="row">
			<div class="col-md-8">
				<h3>Rennergebnisse:</h3>
				<div id="results-list"></div>
			</div>
		</div>
		<a class="nav-link" href="#top">-> Seitenanfang</a>
		<div class="row">
			<div class="col-md-8">
				<h3>Tips Liste:</h3>
				<div id="tips-list"></div>
			</div>
		</div>
		<a class="nav-link" href="#top">-> Seitenanfang</a>
		<div class="row">
			<div class="col-md-8">
				<h3>Punkte Liste:</h3>
				<div id="scores-list"></div>
			</div>
		</div>
		<a class="nav-link" href="#top">-> Seitenanfang</a>
		<div class="row">
			<div class="col-md-8">
				<h3>Gesamt Punktestand:</h3>
				<div id="ranking-list"></div>
			</div>
		</div>
		<a class="nav-link" href="#top">-> Seitenanfang</a>
	</div>
	<!-- Must put our javascript files here to fast the page loading -->
	<!-- jQuery library local -->
	<script src="assets/js/jquery-3.6.0.min.js"></script>
	<!-- Bootstrap JS local -->
	<script src="assets/bootstrap-4.4.1/js/bootstrap.min.js"></script>
	<!-- Moment JS local -->
	<script src="assets/js/moment.js"></script>
	<!-- Page Scripts -->
	<script src="assets/js/getresults.js"></script>
	<script src="assets/js/gettips.js"></script>
	<script src="assets/js/getscores.js"></script>
	<script src="assets/js/gettotals.js"></script>
	<script src="assets/js/savetips.js"></script>
</body>
</html>