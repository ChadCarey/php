<!DOCTYPE html>
<html>

<head>

<script type="text/javascript" src="project.js"></script>

</head>

<body>
 <form method="GET" action="">
  Search: <input type="text" name = "search"/>
  Search by: 
  <select name="sType">
   <option value="aName">Apartment Name</option>
  </select>
  <input type="submit" value="Search"/>
 </form>
 
 <div id="main">
  <h2>Apartments</h2>
  <?php 
     require("aSetup");

     function readDB($db) 
     {
      $aNameSearch = "SELECT * FROM apartment;";
      if (isset($GET["search"])) // display search querry
      {
       echo "<h3>Search Results</h3>";
      }
      $aData = $db->prepare($aNameSearch);
      $aData->execute();
     
      echo "\n<table>\n";
      echo "\n<tr>\n<th>Type</th>\n<th>Name</th>\n<th>Cost</th>\n";
      echo "<th>Gas</th>\n<th>Electric</th>\n<th>Internet</th>\n";
      echo "<th>City Utilities</th>\n";
      echo "<th>Distance from Campus</th></tr>\n\n";

      while ($row = $aData->fetch(PDO::FETCH_ASSOC))
      {
       echo "<tr>\n";
       echo "<td>" . $row["type"] . "</td>";
       echo "<td>" . $row["name"] . "</td>";
       echo "<td>$" . $row["cost"] . "</td>";

       // utilities
       $uId = $row["utilities"];
       $utilities = $db->prepare("SELECT * FROM utilities WHERE id=$uId");
       $utilities->execute();
       $utilities = $utilities->fetch(PDO::FETCH_ASSOC);
       echo "<td>$" . $utilities["gas"] . "</td>";
       echo "<td>$" . $utilities["electric"] . "</td>";
       echo "<td>$" . $utilities["internet"] . "</td>";
       echo "<td>$" . $utilities["city_utilities"] . "</td>";

       echo "<td>" . $row["miles_from_campus"] . "</td>";
       echo "\n</tr>\n";
      }
      echo "</table>\n\n";
     }

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

    $pdb = $db->prepare("INSERT INTO utilities (gas, electric, internet, city_utilities) VALUES ($gas, $electric, $internet, $city);");
    $pdb->execute();

    // get utilities id
    $util = $db->lastInsertId();

    $pdb = $db->prepare("INSERT INTO apartment (utilities, cost, type, miles_from_campus, name) VALUES ($util, $cost, '$type', $distance, '$name');");
    $pdb->execute();
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
 
     // read from the database
     readDB($db);
     
    }
    catch (PDOException $x)
    {
     echo "<p>failed to read from database</p><br/> Details $x";
    }
   
  ?>
 </div>
 
<br/>
<div id='temp'></div>
<form name="form" action="" onsubmit="return validate()" method="POST">
  Apartment Name: <input type="text" name="name"/>
  Type: 
  <select name="type">
    <option value="MARRIED">Married</option>
    <option value="SINGLE">Single</option>
  </select>
  Price: <input type="text" name="cost"/>
  Distance from campus: <input type="text" name="distance"/><br/>
  Gas Price: <input type="text" name="gas"/>
  Electric Price: <input type="text" name="electric"/><br/>
  Internet Price: <input type="text" name="internet"/>
  City Utilities Price: <input type="text" name="city"/>
  <br/><input type="submit" value="Submit"/>
</form>

</body>

</html>
