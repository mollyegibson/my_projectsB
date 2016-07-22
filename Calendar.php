<?php
require('database.php'); // Includes Database.php
session_start();
$_SESSION['username'] = $username;
//$_SESSION['token'] = substr(md5(rand()), 0, 10);
$username = $_POST['username'];
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
    
<script language="javascript" type="text/javascript">
var day_of_week = new Array('Sun','Mon','Tue','Wed','Thu','Fri','Sat');
var month_of_year = new Array('January','February','March','April','May','June','July','August','September','October','November','December');

//  DECLARE AND INITIALIZE VARIABLES
var Calendar = new Date();

var year = Calendar.getFullYear();     // Returns year
var month = Calendar.getMonth();    // Returns month (0-11)
var today = Calendar.getDate();    // Returns day (1-31)
var weekday = Calendar.getDay();    // Returns day (1-31)

var DAYS_OF_WEEK = 7;    // "constant" for number of days in a week
var DAYS_OF_MONTH = 31;    // "constant" for number of days in a month
var cal;    // Used for printing

Calendar.setDate(1);    // Start the calendar day at '1'
Calendar.setMonth(month);    // Start the calendar month at now


/* VARIABLES FOR FORMATTING
NOTE: You can format the 'BORDER', 'BGCOLOR', 'CELLPADDING', 'BORDERCOLOR'
      tags to customize your caledanr's look. */

var TR_start = '<TR>';
var TR_end = '</TR>';
var highlight_start = '<TD WIDTH="100" HEIGHT="100"><TABLE CELLSPACING=0 BORDER=1 BGCOLOR=DEDEFF BORDERCOLOR=CCCCCC><TR><TD WIDTH=100 HEIGHT=100><B><CENTER>';
var highlight_end   = '</CENTER></TD></TR></TABLE></B>';
var TD_start = '<TD WIDTH="100" HEIGHT="100"><CENTER>';
var TD_end = '</CENTER></TD>';

/* BEGIN CODE FOR CALENDAR
NOTE: You can format the 'BORDER', 'BGCOLOR', 'CELLPADDING', 'BORDERCOLOR'
tags to customize your calendar's look.*/

cal =  '<TABLE BORDER=1 CELLSPACING=0 CELLPADDING=0 BORDERCOLOR=BBBBBB><TR><TD>';
cal += '<TABLE BORDER=1 CELLSPACING=0 CELLPADDING=0>' + TR_start;
cal += '<TD COLSPAN="' + DAYS_OF_WEEK + '" BGCOLOR="#EFEFEF"><CENTER><B>';
cal += month_of_year[month]  + '   ' + year + '</B>' + TD_end + TR_end;
cal += TR_start;

//   DO NOT EDIT BELOW THIS POINT  //

// LOOPS FOR EACH DAY OF WEEK
for(index=0; index < DAYS_OF_WEEK; index++)
{

// BOLD TODAY'S DAY OF WEEK
if(weekday == index)
cal += TD_start + '<B>' + day_of_week[index] + '</B>' + TD_end;

// PRINTS DAY
else
cal += TD_start + day_of_week[index] + TD_end;
}

cal += TD_end + TR_end;
cal += TR_start;

// FILL IN BLANK GAPS UNTIL TODAY'S DAY
for(index=0; index < Calendar.getDay(); index++)
cal += TD_start + '  ' + TD_end;

// LOOPS FOR EACH DAY IN CALENDAR
for(index=0; index < DAYS_OF_MONTH; index++)
{
if( Calendar.getDate() > index )
{
  // RETURNS THE NEXT DAY TO PRINT
  week_day =Calendar.getDay();

  // START NEW ROW FOR FIRST DAY OF WEEK
  if(week_day === 0)
  cal += TR_start;

  if(week_day != DAYS_OF_WEEK)
  {

  // SET VARIABLE INSIDE LOOP FOR INCREMENTING PURPOSES
  var day  = Calendar.getDate();

  // HIGHLIGHT TODAY'S DATE
  if( today==Calendar.getDate() )
  cal += highlight_start + day + highlight_end + TD_end;

  // PRINTS DAY
  else
  cal += TD_start + day + TD_end;
  }

  // END ROW FOR LAST DAY OF WEEK
  if(week_day == DAYS_OF_WEEK)
  cal += TR_end;
  }

  // INCREMENTS UNTIL END OF THE MONTH
  Calendar.setDate(Calendar.getDate()+1);

}// end for loop

cal += '</TD></TR></TABLE></TABLE>';

//  PRINT CALENDAR
document.write(cal);

//  End -->
</script>
</div>

</body>
</html>
