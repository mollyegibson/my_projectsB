function signupAjax(event){
	var name = document.getElementById("name").value; // Get the name from the form
	var username_signup = document.getElementById("username_signup").value; // Get the username from the form
	var password_signup = document.getElementById("password_signup").value; // Get the password from the form
 
	// Make a URL-encoded string for passing POST data:
	var dataString = "name=" + encodeURIComponent(name) + "&username=" + encodeURIComponent(username_signup) + "&password=" + encodeURIComponent(password_signup);
 
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
 
function enterPress(e)
{
    // look for window.event in case event isn't passed in
    e = e || window.event;
    if (e.keyCode == 13)
    {
        document.getElementById('signup_btn').click();
        return false;
    }
    return true;
}

var signup = document.getElementById("signup_btn");
document.addEventListener('DOMContentLoaded', function () {
    signup.addEventListener('click', signupAjax, false);
});  // Bind the AJAX call to button click
	
document.getElementById("password_signup").addEventListener("keyup", function(event) {
    event.preventDefault();
    if (event.keyCode == 13) {
        document.getElementById("signup_btn").click();
    }
});