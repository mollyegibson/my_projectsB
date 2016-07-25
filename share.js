//shares the calendar
function sharecalendar(event){
	var username = document.getElementById("usernameadd").value; // Get the username from the form
	var email = document.getElementById("email").value; // Get the email from the form
 
 
	// Make a URL-encoded string for passing POST data:
	var dataString = "username=" + encodeURIComponent(username) + "&password=" + encodeURIComponent(password);
 
	var xmlHttp = new XMLHttpRequest(); // Initialize our XMLHttpRequest instance
	xmlHttp.open("POST", "login_ajax.php", true); // Starting a POST request (NEVER send passwords as GET variables!!!)
	xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); // It's easy to forget this line for POST requests
	xmlHttp.addEventListener("load", function(event){
		var jsonData = JSON.parse(event.target.responseText); // parse the JSON into a JavaScript object
		if(jsonData.success){  // in PHP, this was the "success" key in the associative array; in JavaScript, it's the .success property of jsonData
			loadEvents();
			alert("You've been Logged In!");
            afterlogin();
		}else{
			alert("You were not logged in.  "+jsonData.message);
		}
	}, false); // Bind the callback to the load event
	xmlHttp.send(dataString); // Send the data
	
}

//loads welcome someone after login 
function afterlogin() {
    var username = document.getElementById("username").value;
    var welcome = document.getElementById("welcome");
    $("#mydialog").dialog('close');
    welcome.textContent = username; // writes username
    document.getElementById("login").value = "Logout";
	document.getElementById("usernameadd").value = username;

	document.getElementById("login").onclick = logout;
	}
	
//loading event
function loadEvents() {
	
		jQuery(function($){
	var username = $('#username');
		jQuery.ajax({
			url: 'getevents.php',
			type: 'post',
			data: 'username=' + username.val(),
			success: function(results){
				alert(results);
			}
		});
	});
	}

//logout
function logout() {
	var xmlHttp = new XMLHttpRequest(); // Initialize our XMLHttpRequest instance
	xmlHttp.open("POST", "logout.php", true); // Starting a POST request (NEVER send passwords as GET variables!!!)
	window.location.reload();
	}

//when button is clicked or enter key is pressed, perform the action
var share = document.getElementById("share_btn");
document.addEventListener('DOMContentLoaded', function () {
    share.addEventListener('click', sharecalendar, false);
});  // Bind the AJAX call to button click

document.getElementById("email")
    .addEventListener("keyup", function(event) {
    event.preventDefault();
    if (event.keyCode == 13) {
        document.getElementById("share_btn").click();
    }
});
