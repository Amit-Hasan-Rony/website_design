<?php

$conn=mysqli_connect("localhost","root","");
if(!$conn){
	die();
}

$sql="CREATE DATABASE amit";
mysqli_query($conn,$sql);

mysqli_select_db($conn,"amit");

$create="CREATE TABLE ltable (
            id INTEGER AUTO_INCREMENT,
            username VARCHAR(50) NOT NULL,
            email_id VARCHAR(50) NOT NULL,
            house_name VARCHAR(50) UNIQUE NOT NULL,
            password VARCHAR(25) NOT NULL,
            PRIMARY KEY(id))";


 if(mysqli_query($conn,$create)){
      echo "<P>Loging_table created</P>";
 }else{
      echo "<P>Loging_table not created</P>";
 }

$create="CREATE TABLE owner_table (
                      id INTEGER AUTO_INCREMENT,
                      owner_name VARCHAR(50) NOT NULL,
                      house_name VARCHAR(50) NOT NULL,
                      contact_number VARCHAR(50) NOT NULL,
                      owner_address VARCHAR(70) NOT NULL,
                      PRIMARY KEY(id))";

if(mysqli_query($conn,$create)){
      echo "<P>owner tabel created</P>";
}else{
      echo "<P>Owner table not created</P>";
}


$create="CREATE TABLE osthayee_room (
                      id INTEGER AUTO_INCREMENT,
                      floor_room VARCHAR(10) NOT NULL,
                      room_flag INTEGER DEFAULT 0,
                      room_rent VARCHAR(50),
                      room_description TEXT,
                      room_facilities TEXT,
                      room_image LONGBLOB,
                      student_name VARCHAR(50),
                      student_home VARCHAR(50),
                      student_contact VARCHAR(50),
                      student_image LONGBLOB,
                      PRIMARY KEY(id))";

if(mysqli_query($conn,$create)){
      echo "<P>osthayee_room table created</P>";
}else{
      echo "<P>osthayee_room table not created</P>";
}

?>
