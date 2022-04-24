function getusers() 
{
	$.ajax({
        type: "GET", //we are using GET method to get all record from the server
        url: 'ajax/getresults.php?p=users', // get the route value
        async: false,
		success: function (response) {//once the request successfully process to the server side it will return result here
            // Parse the json result
        	response = JSON.parse(response);

            // Check if there is available records
            if(response.length) {
                // Loop the parsed JSON
				Vorname = 'Gast';
				Nickname = $(Nickname).text();
				//	console.log("Nickname:", Nickname);
	            $.each(response, function(key,value) {
	            	if (Nickname == value.Nickname)
						Vorname = value.Vorname;
			    });
				//	console.log("Vorname", Vorname);
				$("#Vorname").html(Vorname);
	        } else {
            	html += '<div class="alert alert-warning">';
				html += 'No records found!';
				html += '</div>';
            }
        }
    });
}
function getresults() 
{
	// Ajax config
	var EID;
	var UID;
	var deadline;
	$.ajax({
        type: "GET", //we are using GET method to get all record from the server
        url: 'ajax/getresults.php', // get the route value
		//url: 'getresults.php', // get the route value
        success: function (response) {//once the request successfully process to the server side it will return result here
            // Parse the json result
        	response = JSON.parse(response);

            var html = "";
            // Check if there is available records
            if(response.length) {
            	html += '<div class="list-group">';
	            html += '<table>'
				html += "<tr><th>" + 'Event' +'</th><th>'+ 'Datum' + '</th><th>' + 'P1' + '</th><th>' + 'P2' + '</th><th>' + 'P3' + "</th></tr>";
	            // Loop the parsed JSON
	            var stop = false;
	            $.each(response, function(key,value) {
	            	// Our results list template
					if (stop === false) {
						deadline = value.Deadline;
						dld = value.Deadline.split(" ");
						evdate = dld[0];	//	value.Deadline;
						html += "<tr><td>" + value.Ort +'</td><td>'+ evdate + '</td><td>' + value.P1 + '</td><td>' + value.P2 + '</td><td>' + value.P3 + "</td></tr>";
						if (value.P1 === null) {
							stop = true;
							lastEvent = value.Ort;	// + ' ' + evdate;
							EID = value.EID;
						}
					}
				});
				html += '</table>'
	            html += '</div>';
	            html += '</div>';
            } else {
            	html += '<div class="alert alert-warning">';
				  html += 'No records found!';
				html += '</div>';
            }
            // Insert the HTML Template and display all results records
			now = moment();
			/*
			console.log("Now:", now);
			console.log("Deadline", moment(deadline));
			*/
			isAfter = now.isAfter(deadline);
			//	console.log("isAfter:", isAfter);
			if (isAfter) {
				$("#TipForm").attr("hidden",true);
			}
			$("#Event").html(lastEvent);
        	$("#Deadline").html("Deadline: " + deadline);
        	$("#results-list").html(html);
			html = '<input type="hidden" name="EID" value="' + EID + '"></input><input type="hidden" name="Nickname" value="' + $("#Nickname").text() + '"></input>';
			$("#EidUid").html(html);
		}
    });
}

$(document).ready(function() {

	// Get all results records
	getusers();
	getresults();

});