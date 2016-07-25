//edits event
function editevent(event){
    //gets values from the form
    var username = document.getElementById("usernameadd").value;
    var id = document.getElementById("editid").value;
    var eventname = document.getElementById("editname").value;
	var date = document.getElementById("editdate").value;
    var time = document.getElementById("edittime").value;
    var tag = document.getElementById("edittags").value;
    var groups = document.getElementById("editgroup").value;

	// Make a URL-encoded string for passing POST data:
	var dataString = "username=" + encodeURIComponent(username) + "&id=" + encodeURIComponent(id) + "&eventname=" + encodeURIComponent(eventname)+ "&date=" + encodeURIComponent(date)+ "&time=" + encodeURIComponent(time)+ "&tag=" + encodeURIComponent(tag)+ "&groups=" + encodeURIComponent(groups);
 
	var xmlHttp = new XMLHttpRequest(); // Initialize our XMLHttpRequest instance
	xmlHttp.open("POST", "editevents.php", true); // Starting a POST request (NEVER send passwords as GET variables!!!)
	xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); // It's easy to forget this line for POST requests
	xmlHttp.addEventListener("load", function(event){
		var jsonData = JSON.parse(event.target.responseText); // parse the JSON into a JavaScript object
		if(jsonData.success){  // in PHP, this was the "success" key in the associative array; in JavaScript, it's the .success property of jsonData
			alert("Successful!");
			afteredit();
            afterlogin();
			loadEvents();
		}else{
			alert("Failed  "+jsonData.message);
		}
	}, false); // Bind the callback to the load event
	xmlHttp.send(dataString); // Send the data
}

//loads username after login
function afterlogin() {
    var username = document.getElementById("username").value;
    var welcome = document.getElementById("welcome");
    $("#mydialog").dialog('close');
    welcome.textContent = "Welcome " + username; // writes username
	document.getElementById("usernameadd").value = username;
    document.getElementById("login").value = "Logout";
	document.getElementById("login").onclick = logout;
	}
	
//reloads the calendar after editing    
function afteredit() {
    $("#editeventdialog").dialog('close');
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


var edit = document.getElementById("editevent_btn");
document.addEventListener('DOMContentLoaded', function () {
    edit.addEventListener('click', editevent, false);
});  // Bind the AJAX call to button click