function signupAjax(event){
	var name = document.getElementById("name").value; // Get the name from the form
	var username = document.getElementById("username_signup").value; // Get the username from the form
	var password = document.getElementById("password_signup").value; // Get the password from the form
 
	// Make a URL-encoded string for passing POST data:
	var dataString = "name=" + encodeURIComponent(name) + "&username=" + encodeURIComponent(username) + "&password=" + encodeURIComponent(password);
 
	var xmlHttp = new XMLHttpRequest(); // Initialize our XMLHttpRequest instance
	xmlHttp.open("POST", "signup_ajax.php", true); // Starting a POST request (NEVER send passwords as GET variables!!!)
	xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); // It's easy to forget this line for POST requests
	xmlHttp.addEventListener("load", function(event){
		var jsonData = JSON.parse(event.target.responseText); // parse the JSON into a JavaScript object
		if(jsonData.success){  // in PHP, this was the "success" key in the associative array; in JavaScript, it's the .success property of jsonData
			alert("Sign up successful!");
		}else{
			alert("Not sucessful  "+jsonData.message);
		}
	}, false); // Bind the callback to the load event
	xmlHttp.send(dataString); // Send the data
}
 
var login = document.getElementById("signup_btn");
    login.addEventListener('click', signupAjax(), false);  // Bind the AJAX call to button click