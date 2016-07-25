<?php
require('database.php'); // Includes Database.php
session_start();
$username = $_POST['username'];
$_SESSION['username'] = $username;
?>

<!DOCTYPE HTML>
<html>
<head>
    <style>
        #mydialog { display:none }
		#addeventdialog { display:none }
		#editeventdialog { display:none }

    </style>
    
    <title> Calendar </title>
    
    <link rel="stylesheet" type="text/css" href="calendar.css" />
    
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js" type="text/javascript"></script>
    
    <link href="jquery-ui.css" type="text/css" rel="Stylesheet" />
    <!-- We need the style sheet linked above or the dialogs/other parts of jquery-ui won't display correctly!-->

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js"></script>
    <!-- The main library. Note: must be listed before the jquery-ui library -->

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/jquery-ui.min.js"></script>
    <!-- jquery-UI hosted on Google's Ajax CDN-->
    <!-- Note: you can download the javascript file from the link provided on the google doc, or simply provide its URLin the src attribute (microsoft and google also host the jQuery library-->
    
    <script type="text/javascript">

	var myDoc = document;
	
	function fetchCal(){
		var xmlHttp = new XMLHttpRequest();
		xmlHttp.open("POST", "getevents.php", true);  //figure out how to pass 'username' into the getevents.php url (getevents.php?username='')
		xmlHttp.addEventListener("load", ajaxCallback, false);
		xmlHttp.send(null);
	}
	
    function showdialog()
    {
      $("#mydialog").dialog();
    }
	
	 function addeventdialog()
    {
      $("#addeventdialog").dialog();
    }
	
	 function editeventdialog()
    {
      $("#editeventdialog").dialog();
    }
	
	function logout() {
		var xmlHttp = new XMLHttpRequest(); // Initialize our XMLHttpRequest instance
		xmlHttp.open("POST", "logout.php", true); // Starting a POST request (NEVER send passwords as GET variables!!!)
		window.location.reload();
	}

    </script>

</head>
<body>

<header>
    <ul>
    <li class=logo>Calendar</li>
<!--login-->
    <li class =right id="loginbutton" ><input class="login" type="button" value="Sign In / Sign Up" id="login" onclick= "showdialog();" /></li>
    <div id = "mydialog" title="Sign In / Sign Up">
    <p>Sign In</p>	
            
		<label for="username"></label>
		<input type="text" name="username" id="username" placeholder="Username"/>
        <br />
        <label for="password"></label>
		<input type="password" name="password" id="password" placeholder="Password" />
        <br />
        <button class ="login" id="login_btn">Sign In</button>
        <script type="text/javascript" src="login.js"></script>
    <br />
    
    <p>Sign up</p>
        
        <label for="name"></label>
		<input type="text" name="name" id="name" placeholder="Name"/>
        <br />

		<label for="username"></label>
		<input type="text" name="username" id="username_signup" placeholder="Username"/>
        <br />

        <label for="password"></label>
		<input type="password" name="password" id="password_signup" placeholder="Password"/>
        <br />

        <button class ="login" id="signup_btn">Sign Up</button>
        <script type="text/javascript" src="signup.js"></script>
    </div>

    </ul>
        <div id = "welcome" class= "welcome"></div>

</header>
    
<ul>
	<div id = addingevents>
    <li class =right id="add" ><input class="add" type="button" value="Add event" id="addEvent" onclick= "addeventdialog();" /></li>
    <div id = "addeventdialog" title="Add Events">
    <p>Add Events</p>	
        
		<input type="hidden" name="usernameadd" id="usernameadd" value ="<?php
require('database.php'); // Includes Database.php
session_start();
$username = $_POST['username'];
$_SESSION['username'] = $username;
echo $username;
?>"/>
    
		<label for="Event name"></label>
		<input type="text" name="eventname" id="eventname" placeholder="Event Name"/>
        <br />
        <label for="Date"></label>
		<input type="date" name="date" id="date" placeholder="Date" />
        <br />
		<label for="Time"></label>
		<input type="time" name="time" id="time" placeholder="Time"/>
        <br />
		
        <label for="Tag"></label>
		<h4>Tag:*</h4>
		<select id="tags">
		<option value = "meeting">Meeting</option>
		<option value = "work">Work</option>
		<option value = "home">Home</option>
		<option value = "school">School</option>

		</select>
		
        <br />
		
		<label for="Group"></label>
		<h4>Group:*</h4>
		<select id="group">
		<option value = "group1">Group 1</option>
		<option value = "group2">Group 2</option>
		<option value = "group3">Group 3</option>
		</select>
        <br />
        <button class ="login" id="addevent_btn">Add Event</button>
        <script type="text/javascript" src="addingevents.js"></script>
    </div>
	
	
	<div id = editingevents>
    <!--<li class =right id="edit" ><input class="edit" type="button" value="Edit event" id="editEvent" onclick= "editeventdialog();" /></li>-->
    <div id = "editeventdialog" title="Edit Events">
    <p>Edit Events</p>	
        
		<input type="hidden" name="usernameadd" id="usernameadd" value ="<?php
require('database.php'); // Includes Database.php
session_start();
$username = $_POST['username'];
$_SESSION['username'] = $username;
echo $username;
?>"/>
		<input type="int" name="id" id="editid" placeholder="Enter event_id"/>
    
		<label for="Event name"></label>
		<input type="text" name="eventname" id="editname" placeholder="Event Name"/>
        <br />
        <label for="Date"></label>
		<input type="date" name="date" id="editdate" placeholder="Date" />
        <br />
		<label for="Time"></label>
		<input type="time" name="time" id="edittime" placeholder="Time"/>
        <br />
		
        <label for="Tag"></label>
		<h4>Tag:*</h4>
		<select id="edittags">
		<option value = "meeting">Meeting</option>
		<option value = "work">Work</option>
		<option value = "home">Home</option>
		<option value = "school">School</option>

		</select>
		
        <br />
		
		<label for="Group"></label>
		<h4>Group:*</h4>
		<select id="editgroup">
		<option value = "group1">Group 1</option>
		<option value = "group2">Group 2</option>
		<option value = "group3">Group 3</option>
		</select>
        <br />
        <button class ="login" id="editevent_btn">Edit Event</button>
        <script type="text/javascript" src="editevents.js"></script>
		
		<button class ="login" id="delete_btn">Delete</button>
        <script type="text/javascript" src="deleteevents.js"></script>
    </div>
</ul>
	

<div class="tags" id="tags_div">
	<label> <input id = "select" name = "tagss" type="radio" value = "meeting" /> Meeting </label><br />
    <label> <input id = "select2" name = "tagss" type="radio" value = "work" /> Work </label><br />
    <label> <input id = "select3" name = "tagss" type="radio" value = "home" /> Home </label><br />
    <label> <input id = "select4" name = "tagss" type="radio" value = "School" /> School </label><br />
	
	<script type="text/javascript">

        document.getElementById("select").addEventListener("change", function() {
				checkTag();
            	$("#table").empty();
				fetchCal();
        }, false);
   
        document.getElementById("select2").addEventListener("change", function() {
            	
				checkTag();
				$("#table").empty();
				fetchCal();
        }, false);
    
        document.getElementById("select3").addEventListener("change", function() {
            	
				checkTag();
				$("#table").empty();
				fetchCal();
        }, false);
    
        document.getElementById("select4").addEventListener("change", function() {
            	
				checkTag();
				$("#table").empty();
				fetchCal();
        }, false);

    //Behavior
    
        //add
function meeting() {
           var tag = "meeting";
 
	// Make a URL-encoded string for passing POST data:
	var dataString = "tag=" + encodeURIComponent(tag);
	var xmlHttp = new XMLHttpRequest(); // Initialize our XMLHttpRequest instance
	xmlHttp.open("POST", "getevents.php", true); // Starting a POST request (NEVER send passwords as GET variables!!!)
	xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); // It's easy to forget this line for POST requests
	xmlHttp.addEventListener("load", function(event){
		var jsonData = JSON.parse(event.target.responseText); // parse the JSON into a JavaScript object
		if(jsonData.success){  // in PHP, this was the "success" key in the associative array; in JavaScript, it's the .success property of jsonData
			loadEvents();
			alert("Tag on");
            afterlogin();
		}else{
			alert("Tag not on  "+jsonData.message);
		}
		}, false); // Bind the callback to the load event
	xmlHttp.send(dataString); // Send the data
}
        
        //subtract
function work() {
    var tag = "work";
 
	// Make a URL-encoded string for passing POST data:
	var dataString = "tag=" + encodeURIComponent(tag);
	var xmlHttp = new XMLHttpRequest(); // Initialize our XMLHttpRequest instance
	xmlHttp.open("POST", "getevents.php", true); // Starting a POST request (NEVER send passwords as GET variables!!!)
	xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); // It's easy to forget this line for POST requests
	xmlHttp.addEventListener("load", function(event){
		var jsonData = JSON.parse(event.target.responseText); // parse the JSON into a JavaScript object
		if(jsonData.success){  // in PHP, this was the "success" key in the associative array; in JavaScript, it's the .success property of jsonData
			loadEvents();
			alert("Tag on");
            afterlogin();
		}
		else{
			alert("Tag not on  "+jsonData.message);
		}
		}, false); // Bind the callback to the load event
	xmlHttp.send(dataString); // Send the data
}

        
        //multiply
function home() {
                   var tag = "home";
 
	// Make a URL-encoded string for passing POST data:
	var dataString = "tag=" + encodeURIComponent(tag);
	var xmlHttp = new XMLHttpRequest(); // Initialize our XMLHttpRequest instance
	xmlHttp.open("POST", "getevents.php", true); // Starting a POST request (NEVER send passwords as GET variables!!!)
	xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); // It's easy to forget this line for POST requests
	xmlHttp.addEventListener("load", function(event){
		var jsonData = JSON.parse(event.target.responseText); // parse the JSON into a JavaScript object
		if(jsonData.success){  // in PHP, this was the "success" key in the associative array; in JavaScript, it's the .success property of jsonData
			loadEvents();
			alert("Tag on");
            afterlogin();
		}else{
			alert("Tag not on  "+jsonData.message);
		}
	}, false); // Bind the callback to the load event
	xmlHttp.send(dataString); // Send the data
}

        
        //divide
function school() {
    var tag = "school";
 
	// Make a URL-encoded string for passing POST data:
	var dataString = "tag=" + encodeURIComponent(tag);
	var xmlHttp = new XMLHttpRequest(); // Initialize our XMLHttpRequest instance
	xmlHttp.open("POST", "getevents.php", true); // Starting a POST request (NEVER send passwords as GET variables!!!)
	xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); // It's easy to forget this line for POST requests
	xmlHttp.addEventListener("load", function(event){
		var jsonData = JSON.parse(event.target.responseText); // parse the JSON into a JavaScript object
		if(jsonData.success){  // in PHP, this was the "success" key in the associative array; in JavaScript, it's the .success property of jsonData
			loadEvents();
			alert("Tag on");
            afterlogin();
		}else{
			alert("Tag not on  "+jsonData.message);
		}
	}, false); // Bind the callback to the load event
	xmlHttp.send(dataString); // Send the data
}

    
        //check which tag
        
function checkTag() {
    var radio_pointers = document.getElementsByName("tagss");
    var which_tag = null;
    for (var i=0; i<radio_pointers.length; i++) {
        if(radio_pointers[i].checked) {
            which_tag = radio_pointers[i].value;
        }
}
            
switch (which_tag) {
        case 'meeting':
            meeting();
            break;
		case 'work':
            work();
            break;
		case 'home':
            home();
            break;
        case 'school':
            school();
            }
        }
</script>
</div>		


	
	

<div class="calendar" id="calendar">
<p id="table" align="center"></p>

<script language="javascript" type="text/javascript">
var day_of_week = new Array('Sun','Mon','Tue','Wed','Thu','Fri','Sat');
var month_of_year = new Array('January','February','March','April','May','June','July','August','September','October','November','December');

var Today = new Date();
var year = parseInt(Today.getFullYear());     // Returns year
var month = parseInt(Today.getMonth());   // Returns month (0-11)
var today = parseInt(Today.getDate());  // Returns day (1-31)
var currentMonth = new Month(year, month);
   // Set today to the first day of the month

var DAYS_OF_WEEK = 7;    // "constant" for number of days in a week
var DAYS_OF_MONTH = 31;    // "constant" for number of days in a month

function ajaxCallback(event){
//CALENDAR DOESNT SHOW UP IF THERE ARE NO EVENTS IN THE DATABASE - fix this
  Today.setDate(1); 
  Today.setMonth(currentMonth.month);
  console.log("The month today: " + currentMonth.month);
  console.log("Today's mONTH: " + Today.getMonth());
  
  var eventData = JSON.parse(event.target.responseText);
  var first_sunday = Today.deltaDays(7).getSunday().getDate();
  var weekday = Today.getDay();

  //Create a table DOM 
  var cal = document.createElement("TABLE");    
  cal.style.width = "75%";
  cal.style.height = "400px";
  cal.style.border = "thick solid #0000FF";
  cal.setAttribute("id", "cal");
  document.getElementById("table").appendChild(cal);

  var firstRow = document.createElement("TR");
  firstRow.setAttribute("id", "firstrow");
  document.getElementById("cal").appendChild(firstRow);

  var topL = document.createElement("TD");  //Move backwards one month
  topL.style.height = "40px";
  topL.setAttribute("id", "topL");
  topL.setAttribute("colspan", "1");
  var prev = document.createElement("p");
  prev.style.width = "0px";
  prev.style.height = "0px";
  prev.style.borderTop = "15px solid white";
  prev.style.borderLeft = "15px solid white";
  prev.style.borderBottom = "15px solid white";
  prev.style.borderRight = "15px solid #800000";
  prev.addEventListener("click", previousMonth, false);
  console.log("Current month: " +currentMonth.month);
  console.log("Today's month: " +Today.getMonth());
  topL.appendChild(prev);
  firstRow.appendChild(topL);

  var top = document.createElement("TD"); //Display month and year
  top.style.height = "40px";
  top.style.textAlign = "center";
  top.style.fontSize = "35px";
  top.setAttribute("id", "top");
  top.setAttribute("colspan", "5"); 
  top.appendChild(document.createTextNode("" +month_of_year[currentMonth.month]+ " " +year+ ""));
  console.log("the month " + month_of_year[currentMonth.month]);
  document.getElementById("firstrow").appendChild(top);

  var topR = document.createElement("TD");  //Move forwards one month
  topR.style.height = "40px";
  topR.setAttribute("id", "topL");
  topR.setAttribute("colspan", "1");
  var next = document.createElement("p");
  next.style.width = "0px";
  next.style.position = "relative";
  next.style.left = "50px";
  next.style.borderTop = "15px solid white";
  next.style.borderLeft = "15px solid #800000";
  next.style.borderBottom = "15px solid white";
  next.style.borderRight = "15px solid white";
  next.addEventListener("click", upcomingMonth, false);
  topR.appendChild(next);
  firstRow.appendChild(topR);

  var secondRow = document.createElement("TR");
  secondRow.style.height = "70px";
  secondRow.setAttribute("id", "secondrow");
  document.getElementById("cal").appendChild(secondRow);

  for (index=0; index < DAYS_OF_WEEK; index++){  //displaying names of each day
    //maybe later i can change it so today is bold but for now
    var x = document.createElement("TD");
    x.style.textAlign = "center";
    x.style.fontSize = "25px";
    x.style.width = "174px";
    x.style.borderBottom = "medium solid #0000FF";
    x.style.borderTop = "medium solid #0000FF";
    x.appendChild(document.createTextNode("" + day_of_week[index] + ""));
    document.getElementById("secondrow").appendChild(x);
  }

  var rowThree = document.createElement("TR");
  rowThree.style.height = "100px";
  rowThree.setAttribute("id", "1");
  document.getElementById("cal").appendChild(rowThree);

  for(index=0; index < Today.getDay(); index++){  //Fill in blank days until we get to today
    var y = document.createElement("TD");
    y.style.borderBottom = "medium solid #0000FF";
    y.style.width = "174px"; 
    y.style.borderRight = "medium solid #0000FF";
    y.appendChild(document.createTextNode(" "));
    document.getElementById("1").appendChild(y);
  }

  for(index=0; index < 5; index++){ //six iterations bc that's the max number of weeks that a month can span


    if (Today.getDate() > index){
        var row_id = "1";
        
        while (weekday!=0){
        //  console.log("Day: " +weekday);
          if (Today.getMonth()+1 > 9){
            var today_string = "" + Today.getFullYear() + "-" + parseInt(Today.getMonth()+1) + "-" + Today.getDate();} 
          else {
            var today_string = "" + Today.getFullYear() + "-0" + parseInt(Today.getMonth()+1) + "-" + Today.getDate();}
          date = Today.getDate();
        //  console.log("Date: " +date);
          if (date > first_sunday){
            row_id = Today.getSunday().getDate();
            console.log("Month " + Today.getMonth());}

          var a = document.createElement("TD");
		  a.id = cal;
          a.style.borderBottom = "medium solid #0000FF";
          a.style.borderRight = "medium solid #0000FF";
          a.style.textAlign = "right";
          a.style.width = "174px";
          a.style.verticalAlign = "top";
          a.style.fontSize = "20px";
          a.appendChild(document.createTextNode("" + date + "  "));
          for(var i = 0; i < eventData.length; i++) {
            if (eventData[i].date === today_string){
              var cal_event = document.createElement('span');
              cal_event.style.width = "100%";
              cal_event.style.height = "70%";
              cal_event.style.display = "block";
              cal_event.style.fontSize = "15px";
              cal_event.style.backgroundColor = "#AED6F1";
			  cal_event.appendChild(document.createTextNode("" + eventData[i].id + ":"));
              cal_event.appendChild(document.createTextNode("" + eventData[i].event_name + ""));
              cal_event.appendChild(document.createTextNode(" " + eventData[i].time + ""));
			  cal_event.addEventListener("click", alertEvent, false);
              a.appendChild(cal_event);
            }
          }
          document.getElementById(row_id.toString()).appendChild(a);
          Today.setDate(Today.getDate()+1);
          if (Today.getDate() === 1){break;}
          weekday = Today.getDay();
          
        }

      if (weekday === 0){

          if (Today.getMonth() > 9){ 
            var today_string = "" + Today.getFullYear() + "-" + parseInt(Today.getMonth()+1) + "-" + Today.getDate();
            console.log("THEmonth: " +Today.getMonth());}
          else 
            {var today_string = "" + Today.getFullYear() + "-0" + parseInt(Today.getMonth()+1) + "-" + Today.getDate();}
          date = Today.getDate();
          row_id = Today.getSunday().getDate();
          if (row_id != 1){
          var newRow = document.createElement("TR");  
          newRow.style.height = "100px";
          newRow.setAttribute("id",row_id.toString());
          document.getElementById("cal").appendChild(newRow);
          }
          var b = document.createElement("TD");
		  b.id = cal;
          b.style.borderRight = "medium solid #0000FF";
          b.style.borderBottom = "medium solid #0000FF";
          b.style.fontSize = "20px";
          b.style.width = "174px";
          b.style.textAlign = "right";
          b.style.verticalAlign = "top";
          b.appendChild(document.createTextNode("" + date + ""));
          for(var i = 0; i < eventData.length; i++) {
            if (eventData[i].date === today_string){
              var cal_event = document.createElement('span');
              cal_event.style.width = "100%";
              cal_event.style.height = "50%";
              cal_event.style.fontSize = "15px";
			  cal_event.appendChild(document.createTextNode("" + eventData[i].id + ":"));
              cal_event.appendChild(document.createTextNode("" + eventData[i].event_name + ""));
              cal_event.appendChild(document.createTextNode(" " + eventData[i].time + ""))
			cal_event.addEventListener("click", alertEvent, false);
              b.appendChild(cal_event);
            }
          }
          if (date != 1){
          newRow.appendChild(b);}
          else{
            document.getElementById("1").appendChild(b);}
          Today.setDate(Today.getDate()+1);
          weekday = Today.getDay();
          if (Today.getDate() === 1){break;}
        }


     
    }
   // Today.setDate(Today.getDate()+1);
  }

}

function upcomingMonth(){
  var myNode = document.getElementById("table");
  while (myNode.firstChild){ myNode.removeChild(myNode.firstChild);}  //Delete the current calendar
  currentMonth = currentMonth.nextMonth();  //Move the current month up one
  console.log(currentMonth);
  if (currentMonth.month == 0){
    year = parseInt(year + 1);
  }
  fetchCal();
  }

function previousMonth(){
  var myNode = document.getElementById("table");
  while (myNode.firstChild){ myNode.removeChild(myNode.firstChild);}
  if (currentMonth.month == 0){
    year = parseInt(year - 1);
  }
  currentMonth = currentMonth.prevMonth();
  fetchCal();
  }



(function(){
  Date.prototype.deltaDays=function(c){  //returns a Date object c days in the future
    return new Date(this.getFullYear(),this.getMonth(),this.getDate()+c);
  };
  
  Date.prototype.getSunday=function(){ //returns the nearest Sunday in the past to the date
    return this.deltaDays(-1*this.getDay());
  };
})();


 /* function updateCalendar(){
    var Today = new Date();
    Today.setMonth(Today.getMonth()+1);
    console.log("New month: " + Today.setMonth(Today.getMonth()+1));
    var myNode = document.getElementById("cal");
    while (myNode.firstChild){
      myNode.removeChild(myNode.firstChild);
    }
    fetchCal(Today);
  }*/
 
  function alertEvent(){

	//var str = $('#cal span').text();
	//	alert(str);
	//
	//var myRe = /.+?(?=:)/g;
	//var myArray = myRe.exec(str);
	//
	//alert(myArray);
	//document.getElementById("editid").val = myArray;

    editeventdialog();
  }
  
  
  function Week(c){  //
    this.sunday=c.getSunday();
    this.nextWeek=function(){
      return new Week(this.sunday.deltaDays(7));
    };
    this.prevWeek=function(){
      return new Week(this.sunday.deltaDays(-7));
    };
    this.contains=function(b){
      return this.sunday.valueOf()===b.getSunday().valueOf();
    };
    this.getDates=function(){
      for(var b=[],a=0;7>a;a++)
        b.push(this.sunday.deltaDays(a));
        return b;
    };
  }

  function Month(c,b){  
    this.year=c;
    this.month=b;
    this.nextMonth=function(){ 
      return new Month(c+Math.floor((b+1)/12),(b+1)%12);
    };
    this.prevMonth=function(){
      return new Month(c+Math.floor((b-1)/12),(b+11)%12);
    };
    this.getDateObject=function(a){
      return new Date(this.year,this.month,a); 
    };
    this.getWeeks=function(){
      var a=this.getDateObject(1),b=this.nextMonth().getDateObject(0),c=[],a=new Week(a);
      for(c.push(a);!a.contains(b);)
        a=a.nextWeek(),c.push(a);
        return c;
    };
  }

//var Today = new Date();
document.addEventListener("DOMContentLoaded", fetchCal, false);
</script>
</div>



</body>
</html>