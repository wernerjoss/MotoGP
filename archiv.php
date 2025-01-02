<?php
// Start the session
session_start();
?>
<!doctype html>
<html lang="de">
<head>
	<meta charset="UTF-8">
  	<title>MotoGP Tipspiel - Archiv</title>
  	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="assets/bootstrap-4.4.1/css/bootstrap.min.css">
  	<!-- Page CSS -->
  	<link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
<?php 
	function random_pic($dir)
	{
	$files = glob($dir . '/*.*');
	// echo "Files: ".$files."<br>";
	$rand_keys = array_rand($files, 5);
	// echo "Keys: ".$rand_keys."<br>";
	return $files[$rand_keys[0]];
	}
	// echo random_pic("./assets/img")."<br>";	
	echo '<div style="background: url(';echo random_pic("./assets/img");echo')" class="page-holder bg-cover">';	// random background pic from folder assets/img 15.12.24
	?>
	<div class="container">
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
	<br><br>
	<h2>Hoernerfranzracing MotoGP Tipspiel - Jahres-Archiv</h2>
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
			//	echo print_r($_SESSION);
			//	Achtung: $Nickname muss in den span id="Nickname" !!! (wird von results.js als hidden input ins Formular eingefügt und somit an savetips.php weitergegeben)
			if (isset($Nickname)) {
				echo'
				<div id="CommentForm">
					<div class="row">
						<div class="col-md-6">
							<span id="Nickname" style="display:none">';echo $Nickname;echo '</span>
							<h3>Hallo <span id="Vorname"></span></h3>
							<h4>Hier ist das Archiv der bisherigen Tippspiele:</h4>
							<div id="hints">
							Für jedes Jahr gibt es eine Zip Datei mit den entsprechenden Auswertungen, leider können diese wegen Sicherheitseinstellungen des Webservers nicht direkt als <name>.zip angeboten werden (da gibt es einen Zugriffsfehler).<br>
							Deswegen heissen die Dateien z.B. 2022.archiv usw., diese können ohne Probleme abgerufen und lokal gespeichert werden.<br>
							Windows-User müssen die gespeicherte Datei dann umbenennen: z.B. 2022.archiv -> 2022.zip.<br>
							Danach entpacken wie gewohnt (bei Linux ist das nicht erforderlich, das ist schlau genug und erkennt dass es sich hier um Zip Dateien handelt).
							</div>
						</div>
					</div>
					<p></p>
				</div>';
			} else {
				echo '<div class="row">
				<div class="col-md-8">
				<h3>Hallo Gast, du bist nicht angemeldet und kannst daher das Archiv nicht ansehen, sorry.</h3><br>
				</div>
				</div>';
			}
		?>
		<div id="ArchivContainer" style="background-color: white;padding: 1em 0 1em 1em;">
			<div class="col-sm-12">
				<div id="archiv-list" style="font-size: 1.3em;">
				<div class="row">
					<a href="./archiv/2022.archiv">Archiv 2022</a>
				</div>
				<div class="row">
					<a href="./archiv/2023.archiv">Archiv 2023</a>
				</div>
				<div class="row">
					<a href="./archiv/2024.archiv">Archiv 2024</a>
				</div>
				</div>
				
			</div>
		</div>
	</div>
	</div>	<!-- background container	-->
	<!-- Must put our javascript files here to fast the page loading -->
	<!-- jQuery library local -->
	<script src="assets/js/jquery-3.6.0.min.js"></script>
	<!-- Bootstrap JS local -->
	<script src="assets/bootstrap-4.4.1/js/bootstrap.min.js"></script>
	<!-- Moment JS local -->
	<script src="assets/js/moment.js"></script>
	<!-- Page Script -->
	<script src="assets/js/getcomments.js"></script>
</body>
</html>