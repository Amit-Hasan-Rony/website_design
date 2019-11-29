<?php
$months= array(
	'january' =>'https://www.facebook.com',
	'february' =>'https://www.facebook.com/',
	'March' =>'https://www.facebook.com/',
	'April' =>'https://www.facebook.com/'
);
?>

<!DOCTYPE html>
<html>
<head>
	<title>This is the array</title>
</head>
<body>
	<?php
	 array_push($months, 'May'=>'https://www.facebook.com');
	?>
	<ul>
		<?php
		   foreach ($months as $month => $url) {
		   	 echo "<li><a href=\"$url\">$month</a></li>";
		   }
		?>
	</ul>
</body>
</html>