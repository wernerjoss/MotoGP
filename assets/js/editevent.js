function getresults() 
{
	// Ajax config
	$.ajax({
        type: "GET", //we are using GET method to get all record from the server
        url: '../ajax/getresults.php', // get the route value
		//url: 'getresults.php', // get the route value
        success: function (response) {//once the request successfully process to the server side it will return result here
            // Parse the json result
        	response = JSON.parse(response);

            var html = "";
			var lastEID = "";
            // Check if there is available records
            if(response.length) {
            	html += '<div class="list-group">';
	            html += '<table>'
				html += "<tr><th>" + 'Event' +'</th><th>'+ 'EID' + '</th><th>' + 'Datum' + '</th><th>' + 'P1' + '</th><th>' + 'P2' + '</th><th>' + 'P3' + "</th></tr>";
	            // Loop the parsed JSON
	            var stop = false;
	            $.each(response, function(key,value) {
	            	// Our results list template
					if (!stop) {
						dld = value.Deadline.split(" ");
						evdate = dld[0];	//	value.Deadline;
						html += "<tr><td>" + value.Ort +'</td><td>' + value.EID + '</td><td>' + evdate + '</td><td>' + value.P1 + '</td><td>' + value.P2 + '</td><td>' + value.P3 + "</td></tr>";
						if (value.P1 === null) {
							stop = true;
							lastEvent = value.Ort + ' ' + evdate;
							lastEID = value.EID;
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
			$("#results-list").html(html);
			// console.log("EID", lastEID);
			$('input[name=EID]').val(lastEID);	// preset Input Form with last EID 27.09.22
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

	            // Reload lists of participantss
	            getresults();	// was: all();

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
}

$(document).ready(function() {

	// Get all participants records
	getresults();

	// Submit form using AJAX
	submitForm();
	 
});