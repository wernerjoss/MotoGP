function getusers() 
{
	// Ajax config
	$.ajax({
        type: "GET", //we are using GET method to get all record from the server
        url: '../ajax/getusers.php', // get the route value, note: will be called from useradd.html in admin subdir !
        success: function (response) {//once the request successfully process to the server side it will return result here
            
            // Parse the json result
        	response = JSON.parse(response);

            var html = "";
            // Check if there is available records
            if(response.length) {
            	html += '<div class="list-group">';
	            // Loop the parsed JSON
	            $.each(response, function(key,value) {
	            	// Our participants list template
					html += '<a href="#" class="list-group-item list-group-item-action">';
					html += "<p>" + value.Vorname +' '+ value.Name + ' '+ value.Nickname + " <span class='list-email'>(" + value.Email + ")</span>" + "</p>";
					//	html += "<p class='list-password'>" + value.Passwort + "</p>";
					html += '</a>';
	            });
	            html += '</div>';
            } else {
            	html += '<div class="alert alert-warning">';
				  html += 'No records found!';
				html += '</div>';
            }
	        // Insert the HTML Template and display all participants records
			$("#participants-list").html(html);
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
	            getusers();	// was: all();

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
	getusers();

	// Submit form using AJAX
	submitForm();
	 
});