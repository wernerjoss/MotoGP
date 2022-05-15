function getcomments() 
{
	var users = {};
	var races = {};
	var Nick = $("#Nickname").text();
	var EID = null;
	var evdate = null;
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
					users[value.UID] = value.Vorname + ' ' + NName;
					if (Nick == value.Nickname)
						Vorname = value.Vorname;
			    });
				$("#Vorname").html(Vorname);
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
	            var stop = false;
	            $.each(response, function(key,value) {
	            	if (stop === false) {
						deadline = value.Deadline;
						dld = value.Deadline.split(" ");
						evdate = dld[0];	//	value.Deadline;
						now = moment();
						CommentDeadline = moment(deadline).add(5, 'd');	// Kommentare bis 5 Tage nach Deadline möglich
						isAfter = now.isAfter(CommentDeadline);
						commentEvent = value.Ort + ' ' + evdate;
						races[value.EID] = value.Ort;
						EID = value.EID;
						console.log("Ort: ", commentEvent," EID: ", EID);
						console.log("Deadline: ", deadline, " CommentDeadline:", CommentDeadline, "isAfter: ", isAfter);
						if (!isAfter) {	// dies ist der nächste nicht beendete GP
							stop = true;
						}
					}
			    });
	        } else {
            	html += '<div class="alert alert-warning">';
				html += 'No records found!';
				html += '</div>';
            }
        }
    });
	// get comments
	$.ajax({
        type: "GET", //we are using GET method to get all record from the server
        url: 'ajax/getcomments.php', // get the route value
		//url: 'getresults.php', // get the route value
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
			console.log("resp.:", response);
            var html = "";
            // Check if there is available records
            var Location = '';
            if(response.length) {
            	html += '<div class="list-group">';
	            html += '<table>'
				html += "<tr><th>" + 'Event' + '</th><th>' + 'Name' + '</th><th>' + 'Datum' + '</th><th>' + 'Kommentar' + "</th></tr>";
				// TODO: Auswahl Event zum Anzeigen Kommentare (oder alle Events)
	            var stop = false;
	            $.each(response, function(key,value) {
					/*
					if (value.EID == EID)	// nur Kommentare für bearbeitbaren Event anzeigen
						html += "<tr><td>" + users[value.UID] + '</td><td>' + value.Date + '</td><td>' + value.Comment + "</td></tr>";
					*/
					if (stop === false) {
						if ((races[value.EID] != (Location))) {
							html += "<tr><td>" + races[value.EID] +'</td><td>' + users[value.UID] + '</td><td>' + value.Date + '</td><td>' + value.Comment + "</td></tr>";
							Location = races[value.EID];
						}	else	{
							html += "<tr><td>" + '</td><td>' + users[value.UID] + '</td><td>' + value.Date + '</td><td>' + value.Comment + "</td></tr>";
						}
					}
					if (value.P1 === null) {
						stop = true;
					}
				});
				
				html += '</table>'
	            html += '</div>';
	            html += '</div>';
            }
            $(".Event").html(commentEvent);
        	$("#tooLate").attr("hidden",true);
			firstName = $("#Vorname").text();
			if (firstName.length > 0)	// check for valid user
				$("#comments-list").html(html);
			else
				$("#CommentForm").attr("hidden",true);
			html = '<input type="hidden" name="EID" value="' + EID + '"></input><input type="hidden" name="Nickname" value="' + $("#Nickname").text() + '"></input>';
			$("#EidUid").html(html);
		}
    });
}

function submitForm() 
{
	$("#btnSubmit").on("click", function() {
		var $this 		    = $("#btnSubmit"); //submit button selector using ID
        var $caption        = $this.html();// We store the html content of the submit button
        var form 			= "#form"; //defined the #form ID
        var formData        = $(form).serializeArray(); //serialize the form into array
        var route 			= $(form).attr('action'); //get the route using attribute action
		console.log("Formdata:", formData);
        // Ajax config
    	$.ajax({
	        type: "POST", //we are using POST method to submit the data to the server side
	        url: route, // get the route value
	        data: formData, // our serialized array data for server side
	        beforeSend: function () {//We add this before send to disable the button once we submit it so that we prevent the multiple click
	            $this.attr('disabled', true).html("Processing...");
	        },
	        success: function (response) {//once the request successfully process to the server side it will return result here
	            $this.attr('disabled', false).html($caption);
	            // Reload lists of Comments
	            getcomments();
	            // We will display the result using alert
	            alert(response);
	            // Reset form
	            resetForm();
	        },
	        error: function (XMLHttpRequest, textStatus, errorThrown) {
	        	// You can put something here if there is an error from submitted request
	        }
	    });
	});
}

function resetForm() 
{
	$('#form')[0].reset();
	location.reload();
}

$(document).ready(function() {

	// Get all results records
	getcomments();
	submitForm();

});