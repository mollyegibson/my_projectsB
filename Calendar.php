<?php
require('database.php'); // Includes Database.php
session_start();
<<<<<<< HEAD
//$_SESSION['username'] = $username;
//$_SESSION['token'] = substr(md5(rand()), 0, 10);
//$username = $_POST['username'];
=======
$username = $_POST['username'];
$_SESSION['username'] = $username;
>>>>>>> remotes/origin/master
?>

<!DOCTYPE HTML>
<head>
    <style>
        #mydialog { display:none }
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
    

<div class="calendar">
<p id="table" align="center"></p>

<script language="javascript" type="text/javascript">
var day_of_week = new Array('Sun','Mon','Tue','Wed','Thu','Fri','Sat');
var month_of_year = new Array('January','February','March','April','May','June','July','August','September','October','November','December');


//  DECLARE AND INITIALIZE VARIABLES

function ajaxCallback(event){
  var Today = new Date();
  var jsonData = JSON.parse(event.target.responseText);
  console.log(jsonData[0].event_name);

// alert(event.target.responseText.eventData[0].event_name);

  var year = Today.getFullYear();     // Returns year
  var month = Today.getMonth();    // Returns month (0-11)
  var today = Today.getDate();    // Returns day (1-31)
  var weekday = Today.getDay();    // Returns day (0-6)
  currentMonth = new Month(year, month);
  Today.setDate(1);    // Set today to the first day of the month
  Today.setMonth(month); 
  var DAYS_OF_WEEK = 7;    // "constant" for number of days in a week
  var DAYS_OF_MONTH = 31;    // "constant" for number of days in a month

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
     // var week_day = Today.getDay(); //tells us the current day of the week we're printing
      var currentWeek = new Week(Today);
      var row_id = "0";
      var first_sunday = Today.deltaDays(7).getSunday().getDay();
      console.log("First Sunday: " +first_sunday);
    
    //actually if i take getSunday of the first day it'll give zero, so i dont need the (date > 3) if statement at all
    while (weekday!=0){
        date = Today.getDate();
        if (date > 3){
          row_id = Today.getSunday().getDate();
        }
        var a = document.createElement("TD");
        a.style.borderBottom = "medium solid #0000FF";
        a.style.borderRight = "medium solid #0000FF";
        a.style.textAlign = "right";
        a.style.width = "174px";
        a.style.verticalAlign = "top";
        a.style.fontSize = "20px";
        a.appendChild(document.createTextNode("" + date + "  "));
        document.getElementById(row_id.toString()).appendChild(a);
        Today.setDate(Today.getDate()+1);
        weekday = Today.getDay();
      }

    if (weekday === 0){
        row_id = Today.getSunday().getDate();
        date = Today.getDate();
        var newRow = document.createElement("TR");  //create new row if it's sunday
        newRow.style.height = "100px";
        newRow.setAttribute("id",row_id.toString());
        document.getElementById("cal").appendChild(newRow);
        
        var b = document.createElement("TD");
        b.style.borderRight = "medium solid #0000FF";
        b.style.borderBottom = "medium solid #0000FF";
        b.style.fontSize = "20px";
        b.style.width = "174px";
        b.style.textAlign = "right";
        b.style.verticalAlign = "top";
        b.appendChild(document.createTextNode("" + date + ""));
        newRow.appendChild(b);
        Today.setDate(Today.getDate()+1);
        weekday = Today.getDay();
      }


     
    }

   // Today.setDate(Today.getDate()+1);
  }

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
