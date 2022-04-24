<!doctype html>
<html lang="de">
<head>
	<meta charset="UTF-8">
	<title>Ergebnisse MotoGP Tipspiel</title>

  	<!-- Bootstrap CSS local -->
	<link rel="stylesheet" href="assets/bootstrap-4.4.1/css/bootstrap.min.css">
	<!-- Page CSS -->
  	<link rel="stylesheet" href="assets/css/styles.css">
	
</head>
  
<body>
	<ul class="nav">
	<li class="nav-item">
		<a class="nav-link active" href="./">Home</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="riders.html">Fahrerliste</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="howto.html">Anleitung</a>
	</li>
	</ul>
	<div class="container">
		<br><br>
	    <h2>Hoernerfranzracing MotoGP Tipspiel</h2>
	    <br><br>
	    <?php
			$Nickname = $_GET["nick"];
			//	Achtung: $Nickname muss in den span id="Nick" !!! (wird von results.js als hidden input ins Formular eingefügt und somit an savetips.php weitergegeben)
			if (isset($Nickname)) {
			echo'
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
						
					</div>
				</div>
				<p></p>
			</div>';
			}
		?>
		<div class="row">
			<div class="col-md-8">
				<h3>Ergebnisse:</h3>
				<div id="results-list"></div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8">
				<h3>Tips:</h3>
				<div id="tips-list"></div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8">
				<h3>Punkte:</h3>
				<div id="scores-list"></div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8">
				<h3>Gesamt Punktestand:</h3>
				<div id="ranking-list"></div>
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
	<!-- Page Scripts -->
	<script src="assets/js/getresults.js"></script>
	<script src="assets/js/gettips.js"></script>
	<script src="assets/js/getscores.js"></script>
	<script src="assets/js/gettotals.js"></script>
	<script src="assets/js/savetips.js"></script>
	
</body>
</html>