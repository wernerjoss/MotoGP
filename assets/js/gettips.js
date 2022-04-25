function get_tipresults() 
{
	var users = {};
	var races = {};
	var Nick = $("#Nickname").text();
	$.ajax({
        type: "GET", //we are using GET method to get all record from the server
        url: 'ajax/getusers.php', // get the route value
        async: false,
		success: function (response) {//once the request successfully process to the server side it will return result here
            
            // Parse the json result
        	response = JSON.parse(response);

            // Check if there is available records
            if(response.length) {
                // Loop the parsed JSON
	            $.each(response, function(key,value) {
					NName = value.Name;
					if (Nick.length < 1)	{
						NName = NName[0];	// strip Name if no valid User
	        			users[value.UID] = value.Vorname + ' ' + NName + '.';
					}	else	{
						users[value.UID] = value.Vorname + ' ' + NName;
					}
			    });
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
		success: function (response) {//once the request successfully process to the server side it will return result here
            // Parse the json result
        	response = JSON.parse(response);

            // Check if there is available records
            if(response.length) {
                // Loop the parsed JSON
	            $.each(response, function(key,value) {
	            	// Our results list template
					races[value.EID] = value.Ort;
			    });
	        } else {
            	html += '<div class="alert alert-warning">';
				html += 'No records found!';
				html += '</div>';
            }
        }
    });
	// get Tips
	$.ajax({
        type: "GET", //we are using GET method to get all record from the server
        url: 'ajax/getresults.php?p=tips', // get the route value
        async: false,
		success: function (response) {//once the request successfully process to the server side it will return result here
            // Parse the json result
        	response = JSON.parse(response);

            var html = "";
            // Check if there is available records
            if(response.length) {
            	html += '<div class="list-group">';
				html += '<table>'
				html += "<tr><th>" + 'Event' +'</th><th>'+ 'Name' + '</th><th>' + 'P1' + '</th><th>' + 'P2' + '</th><th>' + 'P3' + "</th></tr>";
	            // Loop the parsed JSON
				var stop = false;
	            $.each(response, function(key,value) {
	            	// Our results list template
					if (stop === false) {
						html += "<tr><td>" + races[value.EID] +'</td><td>' + users[value.UID] + '</td><td>' + value.P1 + '</td><td>' + value.P2 + '</td><td>' + value.P3 + "</td></tr>";
					}
					if (value.P1 === null) {
						stop = true;
					}
	            });
	            html += '</table>'
	            html += '</div>';
            } else {
            	html += '<div class="alert alert-warning">';
				html += 'No records found!';
				html += '</div>';
            }
            // Insert the HTML Template and display all results records
			$("#tips-list").html(html);
        }
    });
	/*
	console.log("Races:", races);
	console.log("Users:", users);
	*/
}

$(document).ready(function() {

	// Get all results records
	get_tipresults();

});