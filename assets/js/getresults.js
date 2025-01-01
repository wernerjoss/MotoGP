function getusers() 
{
	$.ajax({
        type: "GET", //we are using GET method to get all record from the server
        url: 'ajax/getresults.php?p=users', // get the route value
        async: false,
		dataType: "json",	// no need for JSON.parse() anymore !
		success: function (response) {//once the request successfully process to the server side it will return result here
            // Check if there is available records
            if(response.length) {
                // Loop the parsed JSON
				Vorname = 'Gast';
				Nickname = $("#Nickname").text();
				//	console.log("Nickname:", Nickname);
				var UID = 0;
	            $.each(response, function(key,value) {
	            	if (Nickname == value.Nickname) {
						Vorname = value.Vorname;
					}
			    });
				//	console.log("Vorname", Vorname);
				$("#Vorname").html(Vorname);
	        } else {
            	html += '<div class="alert alert-warning">';
				html += 'No user records found!';
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
	var deadline = null;
	$.ajax({
        type: "GET", //we are using GET method to get all record from the server
        url: 'ajax/getresults.php', // get the route value
		dataType: "json",	// no need for JSON.parse() anymore !
		success: function (response) {//once the request successfully process to the server side it will return result here
            var html = "";
			var fin = false;
			var stop = false;
			var lastEvent = null;
			var EID = null;
			var deadline = null;
	        // Check if there is available records
            var now = moment();
			if(response.length) {
            	// console.log(response);	// comment out !
				html += '<div class="list-group">';
	            html += '<table>'
				html += "<tr><th>" + 'Event' +'</th><th>'+ 'Datum' + '</th><th>' + 'P1' + '</th><th>' + 'P2' + '</th><th>' + 'P3' + "</th></tr>";
	            numUnfinished = 0;
	            // Loop the parsed JSON
				$.each(response, function(key,value) {
	            	// Our results list template
					if (numUnfinished === 0) {	// finally :-)
						deadline = value.Deadline;
						lastEvent = value.Ort;
						EID = value.EID;
					}
					RaceFinished = moment(deadline).add(2, 'hours');	// race is assumed to be finished 2 hours after deadline
					dld = value.Deadline.split(" ");
					evdate = dld[0];	//	value.Deadline;
					//	if (value.P1 === null) {	// default until 2023 !
					console.log("DL:", value.Deadline, "Ort:", value.Ort, "P1", value.P1, "RF:", RaceFinished, "NumUF:", numUnfinished);
					//lastEvent = value.Ort;
					html += "<tr><td>" + value.Ort +'</td><td>'+ evdate + '</td><td>' + value.P1 + '</td><td>' + value.P2 + '</td><td>' + value.P3 + "</td></tr>";
					if (stop) {
						return false; // see https://stackoverflow.com/questions/1799284/how-to-break-exit-from-a-each-function-in-jquery
					}
					if (!stop) {	// deadline is not over yet, now check for valid result, set stop to true if so
						if (numUnfinished < 2)	{	// only list one unfinished Race
							EID = value.EID;
							// lastEvent = value.Ort;
							// console.log(lastEvent);
							if (value.P1 === null) {
								numUnfinished += 1;
								// console.log(RaceFinished.format());
								EID = value.EID;
								// lastEvent = value.Ort;
								console.log("LE:", lastEvent);
								if (now.isAfter(RaceFinished))	{	// from 2023, first check if event is over, set stop to false even if no result is present yet
									stop = false;
								}	else {
									stop = true;
								}
							} else	{	// in this case, result is available 
								EID = value.EID;
								// lastEvent = value.Ort;
								// stop = true;	// commented 26.03.23
							}
							if (!now.isAfter(RaceFinished))	
								deadline = value.Deadline;	// moved here, deadline is from first unfinished Race, IF not yet RaceFinished ! 25.03.25
						}	else {
							EID = value.EID;
							lastEvent = value.Ort;
							stop = true;	// important !
							//return false;
						}
						if (numUnfinished > 1) stop = true;	// 25.03.23
						if (now.isAfter(RaceFinished))	deadline = value.Deadline;	// deadline from last unfinished Race 25.03.23
						lastEvent = value.Ort;
						console.log("Stop: ", stop);
					}
					if (!stop)	{
						lastEvent = value.Ort;	// Event Liste voll, kein weiteres Rennen !
						fin = true;
						//	console.log("Fin:", fin);
					}
					// console.log(value.Ort);
				});
				html += '</table>'
	            html += '</div>';
	            html += '</div>';
            } else {
            	console.log('No score records found!');
            }
            // Insert the HTML Template and display all results records
			isAfter = now.isAfter(deadline);	//	RaceFinished);
			$("#finMsg").attr("hidden",true);	// Default :-)
			console.log(deadline);
			console.log("isAfter:", isAfter);
			if (isAfter) {
				$("#TipForm").attr("hidden",true);
				// console.log("Fin:", fin);
				if (!fin)	 {
					$("#tooLate").attr("hidden",false);
				}
				else	{
					$("#finMsg").attr("hidden",false);
				}
			}	else	{
				$("#tooLate").attr("hidden",true);
			}
			firstName = $("#Vorname").text();
			console.log("Name", firstName, "stop:", stop);
			if (firstName == 'Gast' || (!stop))	// check for valid user, hide #TipForm, if not, same when all events completed
				$("#TipForm").attr("hidden",true);
			$("#Event").html(lastEvent);
			console.log("set DL:", deadline, "LE:", lastEvent);
        	$("#Deadline").html("Deadline: " + deadline);
        	$("#results-list").html(html);
			console.log("EID:", EID);
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