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
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">
</head>
<body>
	<?php 
	function random_pic($dir)
	{
	$files = glob($dir . '/*.*');
	// echo "Files: ".$files."<br>";
	$rand_keys = array_rand($files, 3);
	// echo "Keys: ".$rand_keys."<br>";
	return $files[$rand_keys[0]];
	}
	// echo random_pic("./assets/img")."<br>";	
	echo '<div style="background: url(';echo random_pic("./assets/img");echo')" class="page-holder bg-cover">';	// random background pic from folder assets/img 15.12.24
	?>
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
			<li class="nav-item">
				<a class="nav-link" href="https://www.motorsport-magazin.com/motogp/live-ticker.html" target="_blank">Live-Ticker</a>
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
				// get Deadline for WM Tip:
				$sql = 'SELECT Deadline FROM MGP_champ';
				$results = $mysqli->query($sql);
				$row = $results->fetch_all(MYSQLI_ASSOC);
				if (is_array($row))	{
					$WmDl = $row[0]["Deadline"];
				}
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
				} elseif ($UID > 1) {
					echo '
					<ul class="nav">
					<li class="nav-item">
						<a class="nav-link active" href="./archiv.php?nick=';echo $Nickname;
						echo '">Archiv</a>
					</li>
					</ul>					';
				}
				echo '<br><br>
				<h2>Hoernerfranzracing MotoGP Tipspiel ';echo date("Y");echo '</h2>
				<h3 id="finMsg" style="display:none">Saisonende - auf ein neues im nächsten Jahr !</h3>
				<span id="Nickname" style="display:none">';echo $Nickname;echo '</span>';
				date_default_timezone_set('Europe/Berlin');
				$d = date("Y-m-d H:i:s");	// finally, correct 23.02.25 :-)
				//	echo ("Date:" . $d . " DL: " . $WmDl);
				if ($d < $WmDl) {
					echo '
					<div id="WmTipForm"> <!-- DONE: only show this until WmDeadline reached 	-->
						<div class="row">
							<div class="col-md-6">
								<h3>Hallo <span id="Vorname"></span></h3>
								<h3>Dein Tip für den MotoGP Endstand 2025</h3><h3><span id="WmDeadline">Deadline: ';echo $WmDl;echo '</span></h3>
								<form action="ajax/savewmtip.php?Nickname=';echo $Nickname;echo '" id="wmform">
									<span id="Uid" style="display:none"></span>
									<div id="WmTipForm" class="row">
										<div class="col-sm-2">
											<label for="P1">P1</label>
											<input class="form-control" type="text" name="P1">
										</div>
										<div class="col-sm-2">
											<label for="P2">P2</label>
											<input class="form-control" type="text" name="P2">
										</div>
										<div class="col-sm-2">
											<label for="P3">P3</label>
											<input class="form-control" type="text" name="P3">
										</div>
									</div>
									<div class="row">
										<div class="col-sm-2" style="margin-top: 1em;">
											<button type="button" class="btn btn-primary" id="wmSubmit">Absenden</button>
										</div>
									</div>
								</form>
							</div>
						</div>
						<div class="row">
							<div class="col-md-8">
								<div id="wmtips-list"></div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
									<h4>Zur Beachtung: Tips für das erste Rennen sind erst <strong>NACH</strong> der o.g. Deadline möglich!</h4>
							</div>
						</div>
					</div>';
				} else {
					echo '
					<div id="TipForm">	<!-- TODO: only show this from WmDeadline 	-->
						<div class="row">
							<div class="col-md-6">
								<h3>Hallo <span id="Vorname"></span></h3>
								<h3>Dein Tip für MotoGP Race</h3><h3><span id="Event"></span></h3><h3><span id="Deadline"></span></h3>
								<form action="ajax/savetips.php" id="form">
									<span id="EidUid" style="display:none"></span>
									<div id="TipForm" class="row">
										<div class="col-sm-2">
											<label for="P1">P1</label>
											<input class="form-control" type="text" name="P1">
										</div>
										<div class="col-sm-2">
											<label for="P2">P2</label>
											<input class="form-control" type="text" name="P2">
										</div>
										<div class="col-sm-2">
											<label for="P3">P3</label>
											<input class="form-control" type="text" name="P3">
										</div>
									</div>
									<div class="row">
										<div class="col-sm-2" style="margin-top: 1em;">
											<button type="button" class="btn btn-primary" id="btnSubmit">Absenden</button>
										</div>
									</div>
								</form>
								<h3 style="margin-top:1em;">Achtung: in die Eingabefelder dürfen NUR Startnummern eingetragen werden, KEINE Namen !</h3>
							</div>
						</div>
						<p></p>
					</div>'; 
				}
				echo'
				<div id="tooLate" style="display:none">	<!-- nach Saisonende :-)	-->
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
			<div class="accordion" id="AccordionContainer">
				<div class="card">
					<div class="card-header">
						<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#results">
						<h3><i class="fa fa-plus"></i> Rennergebnisse</h3>
						</button>
					</div>
					<div class="collapse show" id="results" data-parent="#AccordionContainer">
						<div class="card-body">
							<div class="col-md-8">
								<div id="results-list"></div>
							</div>
						</div>
						<a class="nav-link" href="#top">-> Seitenanfang</a>
					</div>
				</div>
				<div class="card">
					<div class="card-header">
						<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#tips">
							<h3><i class="fa fa-plus"></i> Tips-Liste</h3>
						</button>
					</div>
					<div class="collapse" id="tips" data-parent="#AccordionContainer">
						<a class="nav-link" href="#tips-list-bottom">-> Listenende</a>
						<div class="card-body">
							<div class="row">
								<div class="col-md-8">
									<div id="tips-list"></div>
									<div id = "tips-list-bottom"></div>
								</div>
							</div>
						</div>
						<a class="nav-link" href="#top">-> Seitenanfang</a>
					</div>
				</div>
				<div class="card">
					<div class="card-header">
						<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#scores">
							<h3><i class="fa fa-plus"></i> Punkte-Liste</h3>
						</button>
					</div>
					<div class="collapse" id="scores" data-parent="#AccordionContainer">
						<a class="nav-link" href="#scores-list-bottom">-> Listenende</a>
						<div class="card-body">
							<div class="row">
								<div class="col-md-8">
									<div id="scores-list"></div>
									<div id = "scores-list-bottom"></div>
								</div>
							</div>
							<a class="nav-link" href="#top">-> Seitenanfang</a>
						</div>
					</div>
				</div>
				<div class="card">
					<div class="card-header">
						<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#ranking">
							<h3><i class="fa fa-plus"></i> Gesamt Punktestand</h3>
						</button>
					</div>
					<div class="collapse" id="ranking" data-parent="#AccordionContainer">
					<div class="card-body">
							<div class="row">
								<div class="col-md-8">
									<div id="ranking-list"></div>
								</div>
							</div>
							<a class="nav-link" href="#top">-> Seitenanfang</a>
						</div>
					</div>
				</div>
				<?php
				if (isset($Nickname)) 
				echo '
				<div class="card">
					<div class="card-header">
						<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#ranking">
							<h3><i class="fa fa-plus"></i> Endstand 2025</h3>
						</button>
					</div>
					<div class="collapse" id="ranking" data-parent="#AccordionContainer">
					<div class="card-body">
							<div class="row">
								<div class="col-md-8">
									<div id="wmtips-list"></div>
								</div>
							</div>
							<a class="nav-link" href="#top">-> Seitenanfang</a>
						</div>
					</div>
				</div>';
				?>
			</div>
		</div>	<!-- top container	-->
	</div>	<!-- background container	-->
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
	<script src="assets/js/savewmtip.js"></script>
	<script src="assets/js/savetips.js"></script>
	<script>
	$(document).ready(function(){
		//Add a minus icon to the collapse element that is open by default
		$('.collapse.show').each(function(){
			$(this).parent().find(".fa").removeClass("fa-plus").addClass("fa-minus");
		});
		//Toggle plus/minus icon on show/hide of collapse element
		$('.collapse').on('shown.bs.collapse', function(){
			$(this).parent().find(".fa").removeClass("fa-plus").addClass("fa-minus");
		}).on('hidden.bs.collapse', function(){
			$(this).parent().find(".fa").removeClass("fa-minus").addClass("fa-plus");
		});       
	});
	</script>
</body>
</html>