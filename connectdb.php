<?php

$conn=mysqli_connect("localhost","root","");

if(!$conn)
{
	die("Not connected".mysqli_connect_error());
}

$sql="CREATE DATABASE myDB";

if(mysqli_query($conn,$sql)){
	echo "Database created";
}
else{
	echo "Database not created";
}

mysqli_select_db($conn,"myDB");

$create="CREATE TABLE student (
fname varchar(20),
lname varchar(20),
roll integer PRIMARY KEY
)";

if(mysqli_query($conn,$create)){
	echo "Table created";
}
else{
	echo "Table not created";
}

$sql="INSERT INTO student (fname, lname, roll) VALUES ('Amit', 'Rony', 88)";

if(!mysqli_query($conn,$sql)){
	echo "Not inserted";
}
$sql="INSERT INTO student (fname, lname, roll) VALUES ('Nazmul', 'Johny', 89)";

if(!mysqli_query($conn,$sql)){
	echo "Not inserted";
}

$sql="INSERT INTO student (fname, lname, roll) VALUES ('Jannatul', 'Monny', 90)";

if(!mysqli_query($conn,$sql)){
	echo "Not inserted";
}
$sql="INSERT INTO student (fname, lname, roll) VALUES ('tanvir', 'rifat', 91)";
mysqli_query($conn,$sql);

$sql="INSERT INTO student (fname, lname, roll) VALUES ('Nurojjaman', 'totoul', 92)";
mysqli_query($conn,$sql);

?>