function get_totals() 
{
	var users = {};	// get Vorname + Name for all users
	var Nick = $("#Nickname").text();
	var firstName = $("#Vorname").text();
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
					if ((firstName == 'Gast') || (Nick.length < 1))
						NName = NName[0] + '.';	// strip Name if no valid User
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
	// get totals
	$.ajax({
        type: "GET", //we are using GET method to get all record from the server
        url: 'ajax/calctotals.php', // get the route value
        async: false,
		success: function (response) {//once the request successfully process to the server side it will return result here
            // Parse the json result
        	try {
				response = JSON.parse(response);
			}
			catch (e) {
				console.err(e);
				// Return a default object, or null based on use case.
				response = null;	//	return {}
			}
            var html = "";
            // Check if there is available records
            if(response.length) {
            	html += '<div class="list-group">';
				html += '<table>'
				html += "<tr><th></th><th>" + 'Name' + '</th><th>' + 'Punkte' + "</th></tr>";
	            // Loop the parsed JSON
				console.log(response);
	            var stop = false;
	            $.each(response, function(key,value) {
					if (value.Score > 0)
						html += "<tr><td></td><td>" + users[value.UID] + '</td><td>' + value.Score + "</td></tr>";
				});
	            html += '</table>'
	            html += '</div>';
            } else {
            	html += '<div class="alert alert-warning">';
				html += 'No records found!';
				html += '</div>';
            }
            // Insert the HTML Template and display all results records
			$("#ranking-list").html(html);
        }
    });
}

$(document).ready(function() {

	// Get all results records
	get_totals();

});