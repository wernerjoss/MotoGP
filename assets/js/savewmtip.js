function getwmtip() 
{
	$.ajax({
		type: "GET", //we are using GET method to get all record from the server
		url: 'ajax/getresults.php?p=wmtips', // get the route value
		async: false,
		success: function (response) {//once the request successfully process to the server side it will return result here
			// Parse the json result
			response = JSON.parse(response);

			var html = "";
			// Check if there is available records
			if(response.length) {
				html += '<div class="list-group">';
				html += '<h4>Aktuelle Tips:</h4>';
				html += '<table>';
				html += "<tr><th>Name</th><th>P1</th><th>P2</th><th>P3</th></tr>";
				// Loop the parsed JSON
				var stop = false;
				$.each(response, function(key,value) {
					// Our results list template
					if (!stop) {
						html += "<tr><td>" + value.Vorname + ' ' + value.Name + '</td><td>' + value.P1 + '</td><td>' + value.P2 + '</td><td>' + value.P3 + "</td></tr>";
					}
					/*
					if (value.Name === null) {
						stop = true;
					}	*/
				});
				html += '</table>'
				html += '</div>';
				$("#wmtips-list").html(html);	// comment wichtig !!!
			} else {
				html += '<div class="alert alert-warning">';
				html += 'No WM Tips found!';
				html += '</div>';
			}
			//	console.log(html);
		}
	});
}

function submitWmForm() 	// do NOT use submitForm() as this is already defined in savetips.js !
{
	$("#wmSubmit").on("click", function() {
		var $this 		    = $("#wmSubmit"); //submit button selector using ID
        var $caption        = $this.html();// We store the html content of the submit button
        var form 			= "#wmform"; //defined the #wmform ID
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

	            // Reload lists of Tips
	            getwmtip();	// was: all();

	            // We will display the result using alert
	            alert(response);

	            // Reset form
	            resetWmForm();
	        },
	        error: function (XMLHttpRequest, textStatus, errorThrown) {
	        	// You can put something here if there is an error from submitted request
	        }
	    });
	});
}

function resetWmForm() 
{
	$('#wmform')[0].reset();
	location.reload();
}


$(document).ready(function() {

	// Get all Tips records
	getwmtip();

	// Submit form using AJAX
	submitWmForm();
	 
});