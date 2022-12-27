function get_tipscores() 
{
	var users = {};
	var races = {};
	var scores = {};
	var Nick = $("#Nickname").text();
	var firstName = $("#Vorname").text();
	//	console.log("Nick:", Nick);
	$.ajax({
        type: "GET", //we are using GET method to get all record from the server
        url: 'ajax/getusers.php', // get the route value
        async: false,
		dataType: "json",
		success: function (response) {//once the request successfully process to the server side it will return result here
            // Check if there is available records
            if(response.length) {
                // Loop the parsed JSON
	            $.each(response, function(key,value) {
	        		NName = value.Name;
					if ((firstName == 'Gast') || (Nick.length < 1))	{
						NName = NName[0] + '.';	// strip Name if no valid User
					}
					users[value.UID] = value.Vorname + ' ' + NName;
			    });
				//	console.log(users);
	        } else {
            	html += '<div class="alert alert-warning">';
				html += 'No records found!';
				html += '</div>';
            }
        }
    });
	// get events
	$.ajax({
        type: "GET", //we are using GET method to get all record from the server
        url: 'ajax/getresults.php?p=events', // get the route value
        async: false,
		dataType: "json",
		success: function (response) {//once the request successfully process to the server side it will return result here
            // Check if there is available records
            if(response.length) {
                // Loop the parsed JSON
	            $.each(response, function(key,value) {
	            	// Our results list template
					races[value.EID] = value.Ort;
			    });
				// console.log(races);
	        } else {
            	html += '<div class="alert alert-warning">';
				html += 'No records found!';
				html += '</div>';
            }
        }
    });
	$.ajax({
        type: "GET", //we are using GET method to get all record from the server
        url: 'ajax/calcscores.php',	// achtung: calcscores.php erzeugt hier JSON parse Fehler !!! (war nur wegen zuviel echo am schluss :-)
        async: false,
		dataType: "json",
		success: function (response) {//once the request successfully process to the server side it will return result here
			var html = "";
            // Check if there is available records
			var Location = '';
            try {
				if(response.length) {
					html += '<div class="list-group">';
					html += '<table>'
					html += "<tr><th>" + 'Event' +'</th><th>'+ 'Name' + '</th><th>' + 'Punkte' + "</th></tr>";
					//	Loop the parsed JSON
					$.each(response, function(key,value) {
						// console.log(response);
						if (value.Score > 0) {
							if ((races[value.EID] != (Location))) {
								html += "<tr><td>" + races[value.EID] + '</td><td>' + users[value.UID] +'</td><td>' + value.Score + "</td></tr>";
								Location = races[value.EID];
							}	else	{
								html += "<tr><td>" + '</td><td>' + users[value.UID] +'</td><td>' + value.Score + "</td></tr>";
							}
						}
					});
					html += '</table>'
					html += '</div>';
				} else {
					console.log('No score records found!');
				}
			} catch (err) {
				console.log("Error:", err.message);
			}
            // Insert the HTML Template and display all results records
			$("#scores-list").html(html);
        }
    });
	/*
	console.log("Races:", races);
	console.log("Users:", users);
	*/
}

$(document).ready(function() {

	// Get all results records
	get_tipscores();

});