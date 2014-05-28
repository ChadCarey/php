<?php
function loadDatabase()
{
 $dbHost = "";
 $dbPort = "";
 $dbUser = "";
 $dbPassword = "";

 $dbName = "rexburg_apt";

 $openShiftVar = getenv('OPENSHIFT_MYSQL_DB_HOST');

 if ($openShiftVar === null || $openShiftVar == "")
 {
  // Not in the openshift environment
  //echo "Using local credentials: ";
  $dbUser = "php";
  $dbPassword = "php-pass";
  $dbHost = "localhost";
  $dbPort = 3306;
 }
 else
 {
  // In the openshift environment
  //echo "Using openshift credentials: ";

  $dbHost = getenv('OPENSHIFT_MYSQL_DB_HOST');
  $dbPort = getenv('OPENSHIFT_MYSQL_DB_PORT');
  $dbUser = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
  $dbPassword = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
 }

 //echo "host:$dbHost:$dbPort dbName:$dbName user:$dbUser password:$dbPassword<br />\n";

try 
 {
 $db = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPassword);
 } catch (PDOException $x)
 {
  echo "<p>failed to read from database</p><br/> Details: $x";
 }

 return $db;
}

?>