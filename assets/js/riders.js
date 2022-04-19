function getresults() 
{
	// Ajax config
	$.ajax({
        type: "GET", //we are using GET method to get all record from the server
        url: 'ajax/getriders.php', // get the route value
        success: function (response) {//once the request successfully process to the server side it will return result here
            
            // Parse the json result
        	response = JSON.parse(response);

            var html = "";
            // Check if there is available records
            if(response.length) {
            	html += '<div class="list-group">';
	            // Loop the parsed JSON
	            $.each(response, function(key,value) {
	            	// Our results list template
					if (value.P1 !== null) {
						html += '<a href="#" class="list-group-item list-group-item-action">';
						html += "<p>" + value.RID +' '+ value.Vorname + ' ' + value.Name + "</p>";
						html += '</a>';
					}
	            });
	            html += '</div>';
            } else {
            	html += '<div class="alert alert-warning">';
				  html += 'No records found!';
				html += '</div>';
            }
            // Insert the HTML Template and display all results records
			$("#riders-list").html(html);
        }
    });
}

function resetForm() 
{
	$('#form')[0].reset();
}


$(document).ready(function() {

	// Get all riders records
	getresults();

});