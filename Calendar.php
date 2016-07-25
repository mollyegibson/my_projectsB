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
        #deleteeventdialog { display:none }

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
	
	 function deleteeventdialog()
    {
      $("#deleteeventdialog").dialog();
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
		<input type="text" name="tag" id="tag" placeholder="Tag" />
        <br />
		<label for="Group"></label>
		<input type="text" name="group" id="group" placeholder="Group" />
        <br />
        <button class ="login" id="addevent_btn">Add Event</button>
        <script type="text/javascript" src="addingevents.js"></script>
    </div>
	</div>
	
	<li class =right id="delete" ><input class="delete" type="button" value="Delete event" id="deleteEvent" onclick= "deleteeventdialog();" /></li>
    <div id = "deleteeventdialog" title="Delete Events">
    <p>Delete Events</p>	
            

        <button class ="login" id="delte_btn">Delete</button>
        <script type="text/javascript" src="deleteevent.js"></script>
    </div>
</ul>
	
	
	

<div class="calendar" id="calendar">
<p id="table" align="center"></p>

<script language="javascript" type="text/javascript">
var day_of_week = new Array('Sun','Mon','Tue','Wed','Thu','Fri','Sat');
var month_of_year = new Array('January','February','March','April','May','June','July','August','September','October','November','December');


//  DECLARE AND INITIALIZE VARIABLES

function ajaxCallback(event){
  var Today = new Date();
  console.log("Today: " + Today.getDate());
  //console.log(event.target.responseText);
  var eventData = JSON.parse(event.target.responseText);
  console.log(eventData[0].event_name);
  

  var first_sunday = Today.deltaDays(7).getSunday().getDate();
  console.log("First Sun: " + first_sunday);
  var year = Today.getFullYear();     // Returns year
  var month = Today.getMonth();    // Returns month (0-11)
  var today = Today.getDate();    // Returns day (1-31)
  // Returns day (0-6)
  currentMonth = new Month(year, month);
  Today.setDate(1);    // Set today to the first day of the month
  Today.setMonth(month);
  var weekday = Today.getDay();
  console.log("Weekday: " +weekday);
  var DAYS_OF_WEEK = 7;    // "constant" for number of days in a week
  var DAYS_OF_MONTH = 31;    // "constant" for number of days in a month
console.log("Today should be 1: " + Today.getDate());

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

  var top = document.createElement("TD");
  top.style.width = "100%";
  top.style.height = "40px";
  top.style.textAlign = "center";
  top.style.fontSize = "35px";
  top.setAttribute("id", "top");
  top.setAttribute("colspan", "7"); 
  top.appendChild(document.createTextNode("" +month_of_year[month]+ " " +year+ ""));
  document.getElementById("firstrow").appendChild(top);

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
  //rowThree.style.border = "medium solid #0000FF";
  rowThree.setAttribute("id", "0");
  document.getElementById("cal").appendChild(rowThree);

  for(index=0; index < Today.getDay(); index++){  //Fill in blank days until we get to today
    var y = document.createElement("TD");
    y.style.borderBottom = "medium solid #0000FF";
    y.style.width = "174px"; 
    y.style.borderRight = "medium solid #0000FF";
    y.appendChild(document.createTextNode(" "));
    document.getElementById("0").appendChild(y);
  }

  for(index=0; index < DAYS_OF_MONTH; index++){
    //var week_day = Today.getDay();

       if (Today.getDate() > index){

		console.log("Today should still be 1: " + Today.getDate());
        var row_id = "0";
      
console.log("WeeeeeeeKDAY: " +weekday);

while (weekday !== 0){
          var today_string = "" + Today.getFullYear() + "-0" + parseInt(Today.getMonth()+1) + "-" + Today.getDate();
          console.log(today_string);
          date = Today.getDate();
		  console.log("Date: " + date);
          if (date > 3){
            row_id = Today.getSunday().getDate();
          }
          var a = document.createElement("TD");
          a.style.borderBottom = "medium solid #0000FF";
          a.style.borderRight = "medium solid #0000FF";
          a.style.textAlign = "right";
          a.style.width = "174px";
		  a.addEventListener("click", alertEvent, false);
          a.style.verticalAlign = "top";
          a.style.fontSize = "20px";
          a.appendChild(document.createTextNode("" + date + "  "));
		for(var i = 0; i < eventData.length; i++) {
          if (eventData[i].date === today_string){
            var cal_event = document.createElement('span');
            cal_event.style.width = "100%";
            cal_event.style.height = "50%";
            cal_event.style.display = "block";
            cal_event.style.fontSize = "15px";
            cal_event.style.backgroundColor = "#AED6F1";
            cal_event.appendChild(document.createTextNode("" + eventData[i].event_name + ""));
            a.appendChild(cal_event);
          }
		}
          document.getElementById(row_id.toString()).appendChild(a);
          Today.setDate(Today.getDate()+1);
          weekday = Today.getDay();
	  }
	  
if (weekday === 0){
          var today_string = "" + Today.getFullYear() + "-0" + parseInt(Today.getMonth()+1) + "-" + Today.getDate();
          row_id = Today.getSunday().getDate();
          date = Today.getDate();
          var newRow = document.createElement("TR");  //create new row if it's sunday
          newRow.style.height = "100px";
          newRow.setAttribute("id",row_id.toString());
          document.getElementById("cal").appendChild(newRow);
          
		  var b = document.createElement("TD");
          b.addEventListener("click", alertEvent, false);
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
              cal_event.appendChild(document.createTextNode("" + eventData[i].event_name + ""));
              b.appendChild(cal_event);
            }
          }
          newRow.appendChild(b);
          Today.setDate(Today.getDate()+1);
          weekday = Today.getDay();
        }


     
    }
   // Today.setDate(Today.getDate()+1);
  }

}


  function alertEvent(){
    alert("yo!");
  }

(function(){
  Date.prototype.deltaDays=function(c){  //returns a Date object c days in the future
    return new Date(this.getFullYear(),this.getMonth(),this.getDate()+c);
  };
  
  Date.prototype.getSunday=function(){ //returns the nearest Sunday in the past to the date
    return this.deltaDays(-1*this.getDay());
  };
})();

  
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

document.addEventListener("DOMContentLoaded", fetchCal, false);
</script>
</div>


</body>
</html>
