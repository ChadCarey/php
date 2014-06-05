<!DOCTYPE html>
<html>

<head>
	<script type="text/javascript" src="project.js"></script>
	<link type="text/css" rel="stylesheet" href="project.css"/>
</head>

<body>

<?php
// when they log in set the session and reload the page, this should redirect
   if(isSet($_POST['user']) && isSet($_POST['password']))
   {
	session_start();
        $_SESSION['user'] = htmlspecialchars($_POST['user']);
        $_SESSION['password'] = htmlspecialchars($_POST['password']);
	// redirect to main page

	echo "<p>Welcome " . $_SESSION['user'] . "</p>";
   }
?>

<?php
// check to see if they are logged in
if(isSet($_SESSION['user']) && isSet($_SESSION['password']))
{
// if they are logged in display the user features

echo "<br/>";

// we will only show the rest if the user clicks the 'add apartment' button
// slide open using jquery on click
echo "<div id='formbox'>";
echo "<div id='temp'></div>";
echo "<form name='form' action='writeData.php' ";
echo         "onsubmit='return validate()' method='POST'>";
echo  "Apartment Name: <input type='text' name='name'/>";
echo  "Type: ";
echo  "<select name='type'>";
echo    "<option value='MARRIED'>Married</option>";
echo    "<option value='SINGLE'>Single</option>";
echo  "</select>";
echo  "Price: <input type='text' name='cost'/>";
echo  "Distance from campus: <input type='text' name='distance'/><br/>";
echo  "Gas Price: <input type='text' name='gas'/>";
echo  "Electric Price: <input type='text' name='electric'/><br/>";
echo  "Internet Price: <input type='text' name='internet'/>";
echo  "City Utilities Price: <input type='text' name='city'/>";
echo  "<br/><input type='submit' value='Submit'/>";
echo "</form>";
echo "</div>";
}
else
{
echo "<h3>Login</h3>";
echo "<form id='login' action='' method='POST'>";
echo      "<input type='text' name='user'/> <br/>";
echo      "<input type='text' name='password'/> <br/>";
echo      "<input type='submit' value='Log In'/>";
echo "</form>";
}

?>

</body>

</html>
