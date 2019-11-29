<?php

$conn=mysqli_connect("localhost","root","");
if(!$conn){
	die();
}

$sql="CREATE DATABASE project";
mysqli_query($conn,$sql);

mysqli_select_db($conn,"project");

$create="CREATE TABLE owner_table (
            id INTEGER AUTO_INCREMENT,
            owner_name VARCHAR(50) NOT NULL,
            email_id VARCHAR(50) NOT NULL,
            password VARCHAR(25) NOT NULL,
            building_name VARCHAR(50) NOT NULL,
            owner_contact VARCHAR(11),
            owner_address VARCHAR(50),
            owner_image LONGBLOB,
            PRIMARY KEY(id))";


 if(mysqli_query($conn,$create)){
      echo "<P>owner_table created</P>";
 }else{
      echo "<P>owner_table not created</P>";
 }

$create="CREATE TABLE owner_table_panding (
            id INTEGER AUTO_INCREMENT,
            owner_name VARCHAR(50) NOT NULL,
            email_id VARCHAR(50) NOT NULL,
            password VARCHAR(25) NOT NULL,
            building_name VARCHAR(50) NOT NULL,
            building_floor_no INTEGER NOT NULL,
            room_each_floor INTEGER NOT NULL,
            PRIMARY KEY(id))";


 if(mysqli_query($conn,$create)){
      echo "<P>owner_table_panding created</P>";
 }else{
      echo "<P>owner_table_panding not created</P>";
 }

 $create="CREATE TABLE admin_table (
            id INTEGER AUTO_INCREMENT,
            admin_name VARCHAR(50) NOT NULL,
            email_id VARCHAR(50) NOT NULL,
            password VARCHAR(25) NOT NULL,
            admin_contact VARCHAR(11),
            admin_image LONGBLOB,
            PRIMARY KEY(id))";


 if(mysqli_query($conn,$create)){
      echo "<P>admin_table created</P>";
 }else{
      echo "<P>admin_table not created</P>";
 }

$create="CREATE TABLE building_table (
                      id INTEGER AUTO_INCREMENT,
                      building_name VARCHAR(50) NOT NULL,
                      building_floor_no INTEGER NOT NULL,
                      room_each_floor INTEGER NOT NULL,
                      building_description TEXT,
                      building_picture LONGBLOB,
                      building_rent_cost INTEGER(5),
                      building_facilities TEXT,
                      PRIMARY KEY(id)
                    )";

if(mysqli_query($conn,$create)){
      echo "<P>building_table tabel created</P>";
}else{
      echo "<P>building_table table not created</P>";
}

$create="CREATE TABLE student_table (
                      id INTEGER AUTO_INCREMENT,
                      student_name VARCHAR(50) NOT NULL,
                      student_email VARCHAR(50) NOT NULL,
                      student_user_name VARCHAR(50)NOT NULL,
                      student_password VARCHAR(50)NOT NULL,
                      student_contact VARCHAR(11),
                      building_name VARCHAR(50),
                      buildin_floor_no INTEGER,
                      student_image LONGBLOB,
                      PRIMARY KEY(id)
                    )";

if(mysqli_query($conn,$create)){
      echo "<P>student_table tabel created</P>";
}else{
      echo "<P>student_table table not created</P>";
}

$create="CREATE TABLE transection (
                      id INTEGER AUTO_INCREMENT,
                      transection_id VARCHAR(50) NOT NULL,
                      PRIMARY KEY(id)
                    )";

if(mysqli_query($conn,$create)){
      echo "<P>transection tabel created</P>";
}else{
      echo "<P>transection table not created</P>";
}
