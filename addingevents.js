function addevent(event){
    var username = document.getElementById("usernameadd").value;
    var eventname = document.getElementById("eventname").value;
	var date = document.getElementById("date").value;
    var time = document.getElementById("time").value;
   // var tag = document.getElementById("tags").value;
  //  var group = document.getElementById("group").value;

	// Make a URL-encoded string for passing POST data:
	var dataString = "username=" + encodeURIComponent(username) + "&eventname=" + encodeURIComponent(eventname)+ "&date=" + encodeURIComponent(date)+ "&time=" + encodeURIComponent(time); //+ "&tag=" + encodeURIComponent(tag)+ "&group=" + encodeURIComponent(group);
 	
	var xmlHttp = new XMLHttpRequest(); // Initialize our XMLHttpRequest instance
	xmlHttp.open("POST", "addingevents.php", true); // Starting a POST request (NEVER send passwords as GET variables!!!)
	xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); // It's easy to forget this line for POST requests
	xmlHttp.addEventListener("load", function(event){
		var jsonData = JSON.parse(event.target.responseText); // parse the JSON into a JavaScript object
		if(jsonData.success){  // in PHP, this was the "success" key in the associative array; in JavaScript, it's the .success property of jsonData
			alert("Successful!");
			afteradd();
            afterlogin();
			loadEvents();
		}else{
			alert("Failed  "+jsonData.message);
		}
	}, false); // Bind the callback to the load event
	xmlHttp.send(dataString); // Send the data
}

function afterlogin() {
    var username = document.getElementById("username").value;
    var welcome = document.getElementById("welcome");
    $("#mydialog").dialog('close');
    welcome.textContent = "Welcome " + username; // writes username
	document.getElementById("usernameadd").value = username;
    document.getElementById("login").value = "Logout";
	document.getElementById("login").onclick = logout;
	}
	
function afteradd() {
    $("#addeventdialog").dialog('close');
	$("#table").empty();
	fetchCal();
	}

function loadEvents() {
	var username = document.getElementById("username").value;
		// Make a URL-encoded string for passing POST data:
	var dataString = "username=" + encodeURIComponent(username);
 
	var xmlHttp = new XMLHttpRequest(); // Initialize our XMLHttpRequest instance
	xmlHttp.open("POST", "getevents.php", true); // Starting a POST request (NEVER send passwords as GET variables!!!)
	xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); // It's easy to forget this line for POST requests
	xmlHttp.send(dataString); // Send the data
}

function logout() {
	var xmlHttp = new XMLHttpRequest(); // Initialize our XMLHttpRequest instance
	xmlHttp.open("POST", "logout.php", true); // Starting a POST request (NEVER send passwords as GET variables!!!)
	window.location.reload();
	}


var add = document.getElementById("addevent_btn");
document.addEventListener('DOMContentLoaded', function () {
    add.addEventListener('click', addevent, false);
});  // Bind the AJAX call to button click