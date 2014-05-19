<!DOCTYPE>
<html>

<head>
	<title>PHP database scriptures</title>
</head>

<body>

<?php

  echo "<form action='phpSQLAccess.php' method='GET'>";
   echo "<input type='text' name='ref' placeholder='book chapter:verse'/>";
   echo "<input type='submit' value='search'/>";
  echo "</form>";

  try
  {
   $dataBase = new PDO("mysql:host=localhost; dbname=light", 'php', 'php-pass');
  }
  catch (PDOException $e)
  {
   echo "ERROR!: " . $e.getMessage();
   die();
  }  

  echo "<h2>Scipture references</h2>";

// put search option here

  foreach ($dataBase->query("SELECT * FROM scriptures") as $row)
  {
    echo "<strong>";
    echo $row['book'] . $row['chapter'] . ":" . $row['verse'];
    echo "</strong>";
    echo " - \"" . $row['content'] . "\"<br/><br/>";
  }


?>

</body>

</html>