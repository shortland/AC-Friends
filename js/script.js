/*
* Ilan Kleiman
* script.js
* First: 11/28/2017
* Last: 11/28/2017
*/

$(document).ready(function() {

	(function sizeDisplay() {
		$(".display").css({"height" : ($(window).height() * 0.7)});
		$(".belowDisplay").css({"top" : ($(window).height() * 0.7 + 40) });
	})();

	$(window).resize(function(){sizeDisplay()});

	var currentTime;
	$.get("action_page.php?method=timestamp", function(data, status) {
    	if(status == "success") {
    		if(typeof data === 'object') {
    			//
    		}
    		else {
    			data = JSON.parse(data);
    		}
    		currentTime = data['time'];
    		console.log(currentTime);
    		getUnverified();
    	}
    	else {
    		alert("An error occured: couldn't fetch time... (" + status + ")");
    	}
	});

	function getUnverified() {
		$.get("unverified/public.json", function(data, status){
	    	if(status == "success") {
	    		for(var i = data['users'].length -1; i >= 0; i--) {
	    			var minutesAgo = parseInt((currentTime - data['users'][i]['timestamp']) / 60);
	    			if (minutesAgo == 1) {
	    				minutesAgo += " min ago";
	    			}
	    			else if (minutesAgo == 0) {
	    				minutesAgo = "just now";
	    			}
	    			else {
	    				minutesAgo += " min ago";
	    			}
					document.getElementById("displayUnverified").innerHTML += "<tr><td>" + data['users'][i]['id']+"</td><td>"+ minutesAgo +"</td></tr>";
				}
	    	}
	    	else {
	    		alert("An error occured: couldn't fetch data... (" + status + ")");
	    	}
		});
	}

});
