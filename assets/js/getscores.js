function get_tipscores() 
{
	var users = {};
	var races = {};
	var scores = {};
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
	        		users[value.UID] = value.Vorname + ' ' + value.Name;
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
				// console.log(races);
	        } else {
            	html += '<div class="alert alert-warning">';
				html += 'No records found!';
				html += '</div>';
            }
        }
    });
	// get scores
	$.ajax({
        type: "GET", //we are using GET method to get all record from the server
        url: 'ajax/calcscores.php', // get the route value
        async: false,
		success: function (response) {//once the request successfully process to the server side it will return result here
            // Parse the json result
        	response = JSON.parse(response);

            if(response.length) {
                $.each(response, function(key,value) {
					//	scores[value.UID][value.EID] = value.Scores;
				});
	        } else {
            	html += '<div class="alert alert-warning">';
				html += 'No records found!';
				html += '</div>';
            }
            // 	Insert the HTML Template and display all results records
			//	$("#scores-list").html(html);
        }
    });
	$.ajax({
        type: "GET", //we are using GET method to get all record from the server
        url: 'ajax/getscores.php', // get the route value
        async: false,
		success: function (response) {//once the request successfully process to the server side it will return result here
            // Parse the json result
        	response = JSON.parse(response);

            var html = "";
            // Check if there is available records
            if(response.length) {
            	html += '<div class="list-group">';
				html += '<table>'
				html += "<tr><th>" + 'Event' +'</th><th>'+ 'Name' + '</th><th>' + 'Punkte' + "</th></tr>";
	            // Loop the parsed JSON
				console.log(response);
	            var stop = false;
	            $.each(response, function(key,value) {
					// 	Our scores list template
					//	html += "<tr><td>" + users[value.UID] + '</td><td>' + races[value.EID] +'</td><td>' + value.Score + "</td></tr>";
					if (value.Score > 0)
						html += "<tr><td>" + races[value.EID] + '</td><td>' + users[value.UID] +'</td><td>' + value.Score + "</td></tr>";
				});
	            html += '</table>'
	            html += '</div>';
            } else {
            	html += '<div class="alert alert-warning">';
				html += 'No records found!';
				html += '</div>';
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