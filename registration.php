<?php
 session_start();

 $flag=$_SESSION['flag'];

 if($flag=='yes'){
 	echo "<p style=\" margin-left: 550px;margin-top: 300px\">Registration Successfull<br></p>";
 	echo "<p style=\" margin-left: 535px;margin-top: 10px\">Please Loging for further use<br></p>";
 	echo "<p style=\" margin-left: 555px;margin-top: 10px\">Thanks for using website<br></p>";
 	echo "<p style=\" margin-left: 585px;margin-top: 10px\"><a href=\"pproject.php\">Home_page</a><br></p>";
 }else if($flag=='no'){
    echo "<p style=\" margin-left: 560px;margin-top: 300px\">Registration Unsuccessfull<br></p>";
    echo "<p style=\" margin-left: 550px;margin-top: 10px\">Something went wrong .Try again<br></p>";
    echo "<p style=\" margin-left: 605px;margin-top: 10px\"><a href=\"pproject.php\">Try again </a></p>";
 }else{
 	echo "<p style=\" margin-left: 550px;margin-top: 300px\">Loging Unsuccessfull <br></p>";
    echo "<p style=\" margin-left: 480px;margin-top: 10px\">UserName or Password doesnot match.Try again<br></P>";
    echo "<p style=\" margin-left: 585px;margin-top: 10px\"><a href=\"pproject.php\">Try again </a></p>";
 }

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		body{
			background: #D4651C;
		}
	</style>
</head>
<body>

</body>
</html>
