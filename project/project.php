<!DOCTYPE html>
<html>

<head>

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
   $aNameSearch = "SELECT * FROM apartment;";

   if (isset($GET["search"])) // display search querry
   {
    echo "<h3>Search Results</h3>";
   }

    try 
    {
     $db = new PDO("mysql:host=localhost; dbname=rexburg_apt", $user, $password);
     $aData = $db->prepare($aNameSearch);
//     $aData->bindValue("", "", PDO::PARAM_STR);
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
    catch (PDOException $x)
    {
     echo "<p>failed to read from database</p><br/>";
    }
   

  ?>
 </div>

</body>

</html>
