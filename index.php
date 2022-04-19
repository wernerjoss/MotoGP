<!doctype html>
<html lang="de">
<head>
	<meta charset="UTF-8">
	<title>Ergebnisse MotoGP Tipspiel</title>

  	<!-- Bootstrap CSS CDN -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<!-- local bootstrap
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
  	-->
  	<!-- Page CSS -->
  	<link rel="stylesheet" href="assets/css/styles.css">
</head>
  
<body>
   
	<div class="container">

		<br><br>

	    <h2>Hoernerfranzracing MotoGP Tipspiel</h2>

	    <br><br>
	    
	    <?php
			$Nickname = $_GET["nick"];
			//	Achtung: $Nickname muss in den span id="Nick" !!! (wird von results.js als hidden input ins Formular eingefügt und somit an savetips.php weitergegeben)
			if (isset($Nickname)) {
			echo'
			<div class="row">
				<div class="col-md-4">
					<h3>Hallo <span id="Nick" style="display:none;">'.$Nickname.'</span></h3>
					<h3>Dein Tip für MotoGP Race</h3><h3><span id="Event"></span></h3>
					<form action="ajax/savetips.php" id="form">
						<div id="EidUid"></div>
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
						<button type="button" class="btn btn-primary" id="btnSubmit">Submit</button>
					</form>
				</div>
			</div>
			<p></p>';
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
	</div>

	<!-- Must put our javascript files here to fast the page loading -->
	
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<!-- Popper JS CDN
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	-->
	<!-- Bootstrap JS -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<!-- Page Script -->
	<script src="assets/js/results.js"></script>
	<!--
	-->
	<script src="assets/js/gettips.js"></script>
	<script src="assets/js/savetips.js"></script>
	
</body>
  
</html>