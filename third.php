<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>This is the third page</title>
</head>
<body>
	<h2>this is the name and password of the expected user</h2>

	<?php
        $name=$_SESSION['username'];
        $pass=$_SESSION['password'];
	?>

	<p style="color: red"> <?php echo $name; ?>  </p>
	<p style="color: green"> <?php echo $pass; ?>  </p>

</body>
</html>