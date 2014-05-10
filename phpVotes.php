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
// header(Location: otherSite.com);

// sleep(2); sleeps 2 seconds

// explode(delimeter, $content); splits
// implode(delimeter, array); puts back together


       function echoFile($fileName) 
       {
          if( file_exists($fileName) )
          {
          // open file, read file
            $file = fopen($fileName, "r");

            for($i = 1; $line = fgets($file); $i++)
            {
             $array = explode(" | ", $line);
             echo "<p>";
               echo "<span class='bold'>Question {$i}: </span><br/>";
               $numItems = count($array)-1;
               for($x = 0; $x < $numItems; $x++)
	       {
                  $y = $x+1;
                  echo "Response {$y} results: {$array[$x]}<br />";
               }
             echo "</p> <br />";
            }
          }
          else
          {
          echo "No votes have been cast yet.";
          }
       }


       function writeFile($fileName, $q1, $q2, $q3, $q4)
       {
          $str1 = implode(" | ", $q1);
          $str2 = implode(" | ", $q2);
          $str3 = implode(" | ", $q3);
          $str4 = implode(" | ", $q4);

          $str = $str1.$str2.$str3.$str4;

          $file = fopen($fileName, "w");
          fwrite($file, $str);
          fclose($file);
       }


       function updateFile($fileName)
       {
          
          if ( !(file_exists($fileName)) )
          {
             $a = array(0, 0, 0, 0, "\n");
             // may have to create new file here
             writeFile($fileName, $a, $a, $a, $a);
          }

       // read in the old file
       $file = fopen($fileName, "r"); 
       
       $line = fgets($file);
       $q1 = explode(" | ", $line);
       
       $line = fgets($file);
       $q2 = explode(" | ", $line);
       
       $line = fgets($file);
       $q3 = explode(" | ", $line);
       
       $line = fgets($file);
       $q4 = explode(" | ", $line);
       
       fclose($file);
       
       // update variables 
       $index = $_POST["vote1"];
       if(gettype($index) == gettype("") && $index >= 0 && $index < 5)
       {
         $q1[$index] = $q1[$index] + 1;
       }

       $index =$_POST["vote2"];
       if(gettype($index) == gettype("") && $index >= 0 && $index < 5)
       {
         $q2[$index] = $q2[$index] + 1;
       }       

       $index =$_POST["vote3"];
       if(gettype($index) == gettype("") && $index >= 0 && $index < 5)
       {
         $q3[$index] = $q3[$index] + 1;
       }

       $index =$_POST["vote4"];
       if(gettype($index) == gettype("") && $index >= 0 && $index < 5)
       {
         $q4[$index] = $q4[$index] + 1;
       }

       // write to file
        writeFile($fileName, $q1, $q2, $q3, $q4);
       }

       $fileName = "pollData.txt";
       
   session_start();


if( !(isset ($_SESSION["count"])) )
{
    $_SESSION["count"] = 1;
    updateFile($fileName);
    echo "Thank you for voting<br/>";
}

 echoFile($fileName);

    ?>

  </div>

</body>

</html>
