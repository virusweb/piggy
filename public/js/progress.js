function loadPrgress(){
	$("#reg-prgs").css("display","block");
	var current_progress = 0;
 	var interval = setInterval(function() {
  		current_progress += 10;
      	$("#reg-progress-bar")
      	.css("width", current_progress + "%")
      	.attr("aria-valuenow", current_progress)
      
      	if (current_progress == 100)
  		current_progress = 0
  	}, 1000);
}

function loadLoginPrgress(){
	$("#login-prgs").css("display","block");
	var current_progress = 10;
 	var interval = setInterval(function() {
  		current_progress += 10;
      	$("#login-progress-bar")
      	.css("width", current_progress + "%")
      	.attr("aria-valuenow", current_progress)
      
      	if (current_progress == 100)
  		current_progress = 0
  	}, 1000);
}

function loadFGPPrgress(){
	$("#fgp-prgs").css("display","block");
	var current_progress = 10;
 	var interval = setInterval(function() {
  		current_progress += 10;
      	$("#fgp-progress-bar")
      	.css("width", current_progress + "%")
      	.attr("aria-valuenow", current_progress)
      
      	if (current_progress == 100)
  		current_progress = 0
  	}, 1000);
}