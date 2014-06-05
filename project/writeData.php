<!DOCTYPE html>
<html>
<head></head>

<body>
  <?php
     require("aSetup.php");

  function validData()
  {
   if( isSet($_POST['name'])     && isSet($_POST['type'])     &&
       isSet($_POST['cost'])     && isSet($_POST['distance']) &&
       isSet($_POST['internet']) && isSet($_POST['city'])     &&
       isSet($_POST['gas'])      && isSet($_POST['electric']) )
   {
    return true;
   }
    return false;
  }

  function writeDB($db)
  {
   if(validData())
   {
    echo "<h1>Data entered</h1>";
    $name = $_POST['name'];
    $type = $_POST['type'];
    $cost = (float)$_POST['cost'];
    $distance = (int)$_POST['distance'];
    $gas = (float)$_POST['gas'];
    $electric = (float)$_POST['electric'];
    $internet = (float)$_POST['internet'];
    $city = (float)$_POST['city'];

	    $pdb = $db->prepare("INSERT INTO utilities (gas, electric, internet, city_utilities) VALUES (:gas, :electric, :internet, :city);");
	$pdb->bindvalue(':gas', $gas);
	$pdb->bindvalue(':electric', $electric);
	$pdb->bindvalue(':internet', $internet);
	$pdb->bindvalue(':city', $city);
	$pdb->execute();
	$util = $db->lastInsertId();
	echo "<p>$util</p>";

	$pdb = $db->prepare("INSERT INTO apartment (utilities, cost, type, miles_from_campus, name) VALUES (:util, :cost, :type, :distance, :name);");
	$pdb->bindvalue(':name', $name, PDO::PARAM_STR);
	$pdb->bindvalue(':type', $type, PDO::PARAM_STR);
	$pdb->bindvalue(':util', $util);
	$pdb->bindvalue(':cost', $cost);
	$pdb->bindvalue(':distance', $distance);
	$pdb->execute();
   	$util = $db->lastInsertId(); 
		echo "<p>$util</p>";
    header("Location: project.php");
   }
   else
   {
    echo "<h1>No data entered</h1>";
   }
  }

// Main execution
    try
    {
     $db = loadDatabase();

     // write to database
     writeDB($db);
    }
    catch (PDOException $x)
    {
     echo "<p>failed to write to database</p><br/> Details $x";
    }

  ?>
</body>
</html>
