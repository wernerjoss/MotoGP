<!doctype html>
<html lang="de">
<head>
	<meta charset="UTF-8">
	<title>Teilnehmer MotoGP Tipspiel</title>

  	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="../assets/bootstrap-4.4.1/css/bootstrap.min.css">
  	
  	<!-- Page CSS -->
  	<link rel="stylesheet" href="../assets/css/styles.css">
</head>
  
<body>
   
	<div class="container">

		<br><br>

	    <h1>Hoernerfranzracing MotoGP Tipspiel - Teilnehmer</h1>

	    <br><br>
	    
	    <?php
			$Nickname = $_GET["nick"];
			//	Achtung: $Nickname muss in den span id="Nick" !!! (wird von results.js als hidden input ins Formular eingefügt und somit an savetips.php weitergegeben)
			if (isset($Nickname)) {
				echo '<span id="Nickname" style="display:none">';echo $Nickname;echo '</span>';
				if (md5("$Nickname") == "0209fffded52973ca4ff82f5333b3de1")		{	// md5 Hash des Superusers :-)
					echo '<div class="row">
					<div class="col-md-4">
						<h3>Teilnehmer hinzuf&uuml;gen</h3>
		
						<form action="saveuser.php" id="form">
							<div class="form-group">
								<label for="Vorname">Vorname</label>
								<input class="form-control" type="text" name="Vorname">
							  </div>
							  <div class="form-group">
								<label for="Name">Name</label>
								<input class="form-control" type="text" name="Name">
							  </div>
							  <div class="form-group">
								<label for="Nickname">Nickname</label>
								<input class="form-control" type="text" name="Nickname">
							  </div>
							  <div class="form-group">
								<label for="Email">Email</label>
								<input class="form-control" type="text" name="Email">
							  </div>
							  <div class="form-group">
								<label for="Passwort">Passwort</label>
								<input class="form-control" type="text" name="Passwort">
							  </div>
							  <button type="button" class="btn btn-primary" id="btnSubmit">Submit</button>
						</form>
					</div>
					</div>
					<p></p>
					<div class="row">
						<div class="col-md-8">
							<h3>Teilnehmer-Liste</h3>
							<div id="participants-list"></div>
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
	<script src="../assets/js/adduser.js"></script>

</body>
  
</html>