<!DOCTYPE html>
<html>

<head>

<script type="text/javascript" src="project.js"></script>
<link type="text/css" rel="stylesheet" href="project.css"/>

</head>

<body>
 <form method="GET" action="" id="searchform">
  Search: <input type="text" name="search"/>
  Search by: 
  <select name="sType">
   <option value="aName">Apartment Name</option>
  </select>
  <input type="submit" value="Search"/>
 </form>

<a href="projectAddItem.php"><div class="button" id="addlink">
    Add an Apartment
</div></a>

 <div id="main">
  <h2>Apartments</h2>
  <?php 

     require("aSetup");

     function readDB($db) 
     {
     // default querry
      $aNameSearch = "SELECT * FROM apartment;";
     // search querry
      if (isset($_GET["search"])) // display search querry
      {
       $search = $_GET["search"];
       echo "<h3>Search Results for $search</h3>";
       $aNameSearch = "SELECT * FROM apartment WHERE name='$search';";
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


// Main execution
    try 
    {
     // prepare database
     $db = loadDatabase();
     // read from the database
     readDB($db);
    }
    catch (PDOException $x)
    {
     echo "<p>failed to read from database</p><br/> Details $x";
    }
   
  ?>

 </div><!--Main div-->
 
</body>

</html>
