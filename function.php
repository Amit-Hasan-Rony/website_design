<?php
  if (!empty($_POST)) {
  	$name="Thanks for your message".$_POST['name'];
  }
?>

<!DOCTYPE html>
<html>
<head>
	<title>This is html page</title>
</head>
<body>
	<form action="" method="post">
		<ul>
			<li>
				<label for="name">name:</label>
				<input type="text" name="name" id="name">
			</li>
			<li>
				<label for="email">email:</label>
				<input type="text" name="email" id="email">
			</li>
			<li>
				<label for="message">your_message</label>
				<input type="text" name="message" id="message">
			</li>
			<li>
				<input type="submit" value="Go!">
			</li>
		</ul>
	</form>

	<?php
	  if(!empty($name)){
	  	echo "$name";
	  }
	?>
</body>
</html>