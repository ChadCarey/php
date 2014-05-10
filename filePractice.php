<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Vote</title>
  <link rel="stylesheet" type="text/css" href="phpVotes.css"/>

<script>
</script>

</head>
<body>
  <div id="main">


    <?php 

// NEED TO USE A SESSION OR COOKIE SO THEY ONLY VOTE ONCE!
// IF THE USER VISTITS AGAIN AFTER VOTING THEY WILL BE REDIRECTED HERE

// explode(delimeter, $content); splits
// implode(delimeter, array); puts back together

       function echoFile($fileName) 
       {
          if( file_exists($fileName) )
          {
            // open file, read file
            $file = fopen($fileName, "r"/*read*/);
            while($line = fgets($file)) // reads one line at a time
           {
              $array = explode(" | ", $line);
              echo "<a href='{$array[1]}'>";
              echo $array[0];
              echo "</a>";
              echo "<br />";
            }
            fclose($file);
          }
       }

       function addLinks($fileName)
       {
          
       }

       $fileName = "junk.txt";
       echoFile($fileName);
    ?>

  </div>

</body>

</html>
