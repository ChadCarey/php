<!DOCTYPE html>
<html>

<head>
	<title></title>
</head>

<body>
	<p><?php echo $_POST['name']; ?></p>
	<p>
	<a href="mailto:<?php echo $_POST['email']  ?>">
	<?php echo $_POST['email']; ?>
	</a>
	</p>
	<p><?php echo $_POST['major']; ?></p>
<p>Places visited</p>

<ul>
<?php 
foreach ($_POST['place'] as $place) {
   echo "<li>$place</li>";
}
?>
</ul>

<div> <?php echo $_POST['comments'] ?> </div>

</body>

</html>
