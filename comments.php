<?php
// Start the session
session_start();
?>
<!doctype html>
<html lang="de">
<head>
	<meta charset="UTF-8">
  	<title>MotoGP Tipspiel - Kommentare</title>
  	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="assets/bootstrap-4.4.1/css/bootstrap.min.css">
  	<!-- Page CSS -->
  	<link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
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
	<h2>Hoernerfranzracing MotoGP Tipspiel - Kommentare</h2>
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
							<h4>Dein Kommentar zum GP <span class="Event"></span>:</h4>
							<h3><span id="Deadline"></span></h3>
							<form action="ajax/savecomment.php" id="form">
								<span id="EidUid" style="display:none"></span>
								<div id="Form" class="row">
								<div class="col-sm-12">
									<textarea class="form-control" type="text" rows="4" name="Kommentar"></textarea>
								</div>
								<div class="col-sm-4" style="margin-top: 1em;">
									<button type="button" class="btn btn-primary" id="btnSubmit">Absenden</button>
									</div>
								</div>
							</form>
						</div>
					</div>
					<p></p>
				</div>';
				echo'
				<div id="tooLate">
					<div class="row">
						<div class="col-md-6">
						<h3>Sorry, du bist zu spät dran, Kommentare können nur bis zur Deadline (= 5 Tage nach Zieleinlauf des GP) abgegeben werden !</h3>
						</div>
					</div>
				</div>';
			}	else	{
				echo '<div class="row">
				<div class="col-md-8">
				<h3>Hallo Gast, du bist nicht angemeldet und kannst daher keine Kommentare abgeben oder ansehen, sorry.</h3><br>
				</div>
				</div>';
			}
		?>
		<br><br>
	    <h3>Kommentare zu den bisherigen GP's:</h3>
	    <br><br>
		<div class="row">
			<div class="col-sm-12">
				<div id="comments-list"></div>
			</div>
		</div>
	</div>
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