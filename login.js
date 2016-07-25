function loginAjax(event){
	var username = document.getElementById("username").value; // Get the username from the form
	var password = document.getElementById("password").value; // Get the password from the form
 
	// Make a URL-encoded string for passing POST data:
	var dataString = "username=" + encodeURIComponent(username) + "&password=" + encodeURIComponent(password);
 
	var xmlHttp = new XMLHttpRequest(); // Initialize our XMLHttpRequest instance
	xmlHttp.open("POST", "login_ajax.php", true); // Starting a POST request (NEVER send passwords as GET variables!!!)
	xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); // It's easy to forget this line for POST requests
	xmlHttp.addEventListener("load", function(event){
		var jsonData = JSON.parse(event.target.responseText); // parse the JSON into a JavaScript object
		if(jsonData.success){  // in PHP, this was the "success" key in the associative array; in JavaScript, it's the .success property of jsonData
			//loadEvents();
			alert("You've been Logged In!");
            afterlogin();
		}else{
			alert("You were not logged in.  "+jsonData.message);
		}
	}, false); // Bind the callback to the load event
	xmlHttp.send(dataString); // Send the data
}

function afterlogin() {
    var username = document.getElementById("username").value;
    var welcome = document.getElementById("welcome");
    $("#mydialog").dialog('close');
    welcome.textContent = username; // writes username
    document.getElementById("login").value = "Logout";
	document.getElementById("usernameadd").value = username;

	document.getElementById("login").onclick = logout;
	}
	



function logout() {
	var xmlHttp = new XMLHttpRequest(); // Initialize our XMLHttpRequest instance
	xmlHttp.open("POST", "logout.php", true); // Starting a POST request (NEVER send passwords as GET variables!!!)
	window.location.reload();
	}


var login = document.getElementById("login_btn");
document.addEventListener('DOMContentLoaded', function () {
    login.addEventListener('click', loginAjax, false);
});  // Bind the AJAX call to button click

/*document.getElementById("password")
    .addEventListener("keyup", function(event) {
    event.preventDefault();
    if (event.keyCode == 13) {
        document.getElementById("login_btn").click();
    }
});*/
