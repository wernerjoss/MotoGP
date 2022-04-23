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

	    <h1>Hoernerfranzracing MotoGP Tipspiel - Events</h1>

	    <br><br>
	    
	    <div class="row">
	    	<div class="col-md-4">
	    		<h3>Ergebnis hinzufügen</h3>

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
		</div>
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