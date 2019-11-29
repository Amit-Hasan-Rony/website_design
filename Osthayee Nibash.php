<?php
session_start();
if(isset($_SESSION['loginflag'])){
  $login_flag=$_SESSION['loginflag'];
}       
?>

<?php
///this is for login ............................................................................................
if(!empty($_POST['submit1'])){

  $name=$_POST['uname'];
  $pass=$_POST['psw'];
  $c_type=$_POST['c_type'];

  $savevalue=get_information($name,$pass,$c_type);
  
 
  $_SESSION['loginflag']="false";

  if($savevalue=="null"){
   $_SESSION['flag']="lno";
   header("Location: registration.php");
  }else {

    if($c_type=='Student'){
       //Here is student login information from student_table.....................................................................................

      $_SESSION['username']=$savevalue["name"];
      $_SESSION['password']=$savevalue['password'];
      $_SESSION['building_name']=$savevalue['building_name'];
      $_SESSION['building_floor_no']=$savevalue['building_floor_no'];
      $_SESSION['c_type']=$c_type;
      $_SESSION['id']=$savevalue['id'];

      $loginflag="true";
      $_SESSION['loginflag']=$loginflag; 

    }else if($c_type=='Mess_Owner'){
       //Here is Mess_owner login information from owner_table.....................................................................................

      $_SESSION['username']=$savevalue["name"];
      $_SESSION['password']=$savevalue['password'];
      $_SESSION['id']=$savevalue['id'];
      $_SESSION['house_name']=$savevalue['house_name'];
      $_SESSION['c_type']=$c_type;

      $loginflag="true";
      $_SESSION['loginflag']=$loginflag;

    }else{
       //Here is Admin  login information from admin_table.....................................................................................

      $_SESSION['username']=$savevalue["name"];
      $_SESSION['password']=$savevalue['password'];
      $_SESSION['c_type']=$c_type;

      $loginflag="true";
      $_SESSION['loginflag']=$loginflag;

    }
    
  }

}

function get_information($n,$p,$t){
  $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "project";

    $name="'".$n."'";
    $pass="'".$p."'";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if($t=='Student'){
      //login information for student............will have to add more information about student.................................................
       $sql="SELECT * FROM student_table WHERE student_user_name=$name AND student_password=$pass";

       $result = mysqli_query($conn, $sql);

       if (mysqli_num_rows($result) > 0) {
          while($row = mysqli_fetch_assoc($result)) {
               $a=$row["student_user_name"];
               $b=$row["student_password"];
               $c=$row["building_name"];
               $d=$row["buildin_floor_no"];
               $e=$row["id"];
               $save= array('name' =>$a,
                     'password' =>$b,
                     'building_name' =>$c,
                     'building_floor_no' =>$d,
                     'id' =>$e
                      );
          }
          return $save;
       }else {
          return "null";
       }


    }else if($t=='Mess_Owner'){
      //loging information for mess owner.......................will have to add more information about owner.........................................
      $sql="SELECT * FROM owner_table WHERE owner_name=$name AND password=$pass";

      $result = mysqli_query($conn, $sql);

      if (mysqli_num_rows($result) > 0) {
          while($row = mysqli_fetch_assoc($result)) {
               $a=$row["owner_name"];
               $b=$row["password"];
               $id=$row["id"];
               $house_name=$row["building_name"];
               $save= array('name' =>$a,
                     'password' =>$b,
                     'id' =>$id,
                     'house_name' =>$house_name
                      );
          }
          return $save;
      }else {
          return "null";
      }


    }else{
      //login information for admin...............will have to add more information about admin.........................................................
      $sql="SELECT * FROM admin_table WHERE admin_name=$name AND password=$pass";

      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0) {
         while($row = mysqli_fetch_assoc($result)) {
             $a=$row["admin_name"];
             $b=$row["password"];
             $save= array('name' =>$a,
                     'password' =>$b );
         }
         return $save;
      }else {
         return "null";
      } 

   }
         
}

?>



<?php
//this is for registration for student.................................................................................................................

if(!empty($_POST['submit2'])){
  $name=$_POST['s_name'];
  $uname=$_POST['s_uname'];
  $email=$_POST['s_ename'];
  $pass1=$_POST['s_psw1'];
  $pass2=$_POST['s_psw2'];
  
  insert_function_student($name,$uname,$email,$pass1,$pass2);
}else{
  
}

//this is for registration for Owner.......................................................................................................

if(!empty($_POST['submit3'])){
  $uname=$_POST['o_uname'];
  $email=$_POST['o_ename'];
  $house=$_POST['o_house'];
  $floor=$_POST['o_floor'];
  $room=$_POST['o_room'];
  $pass1=$_POST['o_psw1'];
  $pass2=$_POST['o_psw2'];
  
  insert_function_owner($uname,$email,$house,$floor,$room,$pass2,$pass2);
}else{
  
}

//this is for registration for Admin......................................................................................................

if(!empty($_POST['submit4'])){
  $uname=$_POST['a_uname'];
  $email=$_POST['a_ename'];
  $pass1=$_POST['a_psw1'];
  $pass2=$_POST['a_psw2'];
  
  insert_function_admin($uname,$email,$pass1,$pass2);
}else{
  
}

function insert_function_student($name,$uname,$email,$pass1,$pass2){
  $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "project";

    $name="'".$name."'";
    $uname="'".$uname."'";
    $email="'".$email."'";
    $pass1="'".$pass1."'";
    $pass2="'".$pass2."'";

    //code for email check...........................................................

    if($pass1===$pass2 &&(strpos($email, "@gmail.com")||strpos($email, "@yeahoo.com"))){
          $conn = mysqli_connect($servername, $username, $password, $dbname);


          $sql="INSERT INTO student_table(student_name,student_email,student_user_name,student_password)VALUES($name,$email,$uname,$pass2)";

          if(mysqli_query($conn,$sql)){

             $_SESSION['flag']='yes';
             header("Location: registration.php");
         }else {
             $_SESSION['flag']='nno';
             header("Location: registration.php");
         }
    }else{
         $_SESSION['flag']='no';
         header("Location: registration.php");
    }
}

function insert_function_owner($uname,$email,$house,$floor,$room,$pass1,$pass2){
  $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "project";

  $uname="'".$uname."'";
  $email="'".$email."'";
  $house="'".$house."'";
  $ofloor=(int)$floor;
  $oroom=(int)$room;
  $pass1="'".$pass1."'";
  $pass2="'".$pass2."'";


    //code for email check...........................................................

    /*if($pass1===$pass2 &&(strpos($email, "@gmail.com")||strpos($email, "@yeahoo.com"))){
          $conn = mysqli_connect($servername, $username, $password, $dbname);


          $sql="INSERT INTO owner_table(owner_name,email_id,password,building_name)VALUES($uname,$email,$pass2,$house)";
          $sql1="INSERT INTO building_table(building_name,building_floor_no,room_each_floor)VALUES($house,$ofloor,$oroom)";

          if(mysqli_query($conn,$sql) && mysqli_query($conn,$sql1)){

             $_SESSION['flag']='yes';
             header("Location: registration.php");
         }else {
             $_SESSION['flag']='no';
             header("Location: registration.php");
         }
    }else{
         $_SESSION['flag']='no';
         header("Location: registration.php");
    }*/

    if($pass1===$pass2 &&(strpos($email, "@gmail.com")||strpos($email, "@yeahoo.com"))){
          $conn = mysqli_connect($servername, $username, $password, $dbname);


          $sql="INSERT INTO owner_table_panding(owner_name,email_id,password,building_name,building_floor_no,room_each_floor)VALUES($uname,$email,$pass2,$house,$ofloor,$oroom)";

          if(mysqli_query($conn,$sql)){

             $_SESSION['flag']='yes';
             header("Location: registration.php");
         }else {
             $_SESSION['flag']='no';
             header("Location: registration.php");
         }
    }else{
         $_SESSION['flag']='no';
         header("Location: registration.php");
    }
}


function insert_function_admin($name,$uname,$email,$pass1,$pass2){
  $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "amit";

    $name="'".$name."'";
    $uname="'".$uname."'";
    $email="'".$email."'";
    $pass1="'".$pass1."'";
    $pass2="'".$pass2."'";

    //code for email check...........................................................

    if($pass1===$pass2 &&(strpos($email, "@gmail.com")||strpos($email, "@yeahoo.com"))){
          $conn = mysqli_connect($servername, $username, $password, $dbname);


          $sql="INSERT INTO student_table(student_name,student_email,student_user_name,student_password)VALUES($name,$email,$uname,$pass2)";

          if(mysqli_query($conn,$sql)){

             $_SESSION['flag']='yes';
             header("Location: registration.php");
         }else {
             $_SESSION['flag']='no';
             header("Location: registration.php");
         }
    }else{
         $_SESSION['flag']='no';
         header("Location: registration.php");
    }
}


?>

<?php
  if(!empty($_POST['logout_button'])){
    $_SESSION['loginflag']="false";
  }
?>

<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "amit";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    $room_array=array('fo1'=>'green','fo2'=>'green','fo3'=>'green','fo4'=>'green','fo5'=>'green','fo6'=>'green','fo7'=>'green','fo8'=>'green',
                      'th1'=>'green','th2'=>'green','th3'=>'green','th4'=>'green','th5'=>'green','th6'=>'green','th7'=>'green','th8'=>'green',
                      'se1'=>'green','se2'=>'green','se3'=>'green','se4'=>'green','se5'=>'green','se6'=>'green','se7'=>'green','se8'=>'green',
                      'fi1'=>'green','fi2'=>'green','fi3'=>'green','fi4'=>'green','fi5'=>'green','fi6'=>'green','fi7'=>'green','fi8'=>'green',
                      'gr1'=>'green','gr2'=>'green','gr3'=>'green','gr4'=>'green','gr5'=>'green','gr6'=>'green','gr7'=>'green','gr8'=>'green');



    $dest_array=array('fo1'=>'Osthayee Nibash Green User.php','fo2'=>'Osthayee Nibash Green User.php','fo3'=>'Osthayee Nibash Green User.php','fo4'=>'Osthayee Nibash Green User.php','               fo5'=>'Osthayee Nibash Green User.php','fo6'=>'Osthayee Nibash Green User.php','fo7'=>'Osthayee Nibash Green User.php','fo8'=>'Osthayee Nibash Green User.php',
                      'th1'=>'Osthayee Nibash Green User.php','th2'=>'Osthayee Nibash Green User.php','th3'=>'Osthayee Nibash Green User.php','th4'=>'Osthayee Nibash Green User.php','th5'=>'Osthayee Nibash Green User.php','th6'=>'Osthayee Nibash Green User.php','th7'=>'Osthayee Nibash Green User.php','th8'=>'Osthayee Nibash Green User.php',
                      'se1'=>'Osthayee Nibash Green User.php','se2'=>'Osthayee Nibash Green User.php','se3'=>'Osthayee Nibash Green User.php','se4'=>'Osthayee Nibash Green User.php','se5'=>'Osthayee Nibash Green User.php','se6'=>'Osthayee Nibash Green User.php','se7'=>'Osthayee Nibash Green User.php','se8'=>'Osthayee Nibash  Green User.php',
                      'fi1'=>'Osthayee Nibash Green User.php','fi2'=>'Osthayee Nibash Green User.php','fi3'=>'Osthayee Nibash Green User.php','fi4'=>'Osthayee Nibash Green User.php','fi5'=>'Osthayee Nibash Green User.php','fi6'=>'Osthayee Nibash Green User.php','fi7'=>'Osthayee Nibash Green User.php','fi8'=>'Osthayee Nibash Green User.php',
                      'gr1'=>'Osthayee Nibash Green User.php','gr2'=>'Osthayee Nibash Green User.php','gr3'=>'Osthayee Nibash Green User.php','gr4'=>'Osthayee Nibash Green User.php','gr5'=>'Osthayee Nibash Green User.php','gr6'=>'Osthayee Nibash Green User.php','gr7'=>'Osthayee Nibash Green User.php','gr8'=>'Osthayee Nibash Green User.php');


    //$sql="SELECT * FROM osthayee_room WHERE room_flag=0";
    //for red room link........................................................................................................
    $sql="SELECT * FROM osthayee_room WHERE room_flag=1";
    $result = mysqli_query($conn, $sql);


  if( $login_flag!="true"){

    if (mysqli_num_rows($result) > 0) {
      while($row = mysqli_fetch_assoc($result)) {
        $a=$row["floor_room"];
        
        if($a=="41"){
          $room_array['fo1']='red';
          $dest_array['fo1']='Osthayee Nibash Red User.php';
        }
        else if($a=='42'){
          $room_array['fo2']='red';
          $dest_array['fo2']='Osthayee Nibash Red User.php';
        }
        else if($a=='43'){
          $room_array['fo3']='red';
          $dest_array['fo3']='Osthayee Nibash Red User.php';
        }
        else if($a=='44'){
          $room_array['fo4']='red';
          $dest_array['fo4']='Osthayee Nibash Red User.php';
        }
        else if($a=='45'){
          $room_array['fo5']='red';
          $dest_array['fo5']='Osthayee Nibash Red User.php';
        }
        else if($a=='45'){
          $room_array['fo5']='red';
          $dest_array['fo5']='Osthayee Nibash Red User.php';
        }
        else if($a=='45'){
          $room_array['fo5']='red';
          $dest_array['fo5']='Osthayee Nibash Red User.php';
        }
        else if($a=='46'){
          $room_array['fo6']='red';
          $dest_array['fo6']='Osthayee Nibash Red User.php';
        }
        else if($a=='47'){
          $room_array['fo7']='red';
          $dest_array['fo7']='Osthayee Nibash Red User.php';
        }
        else if($a=='48'){
          $room_array['fo8']='red';
          $dest_array['fo8']='Osthayee Nibash Red User.php';
        }
        else if($a=='31'){
          $room_array['th1']='red';
          $dest_array['th1']='Osthayee Nibash Red User.php';
        }
         else if($a=='32'){
          $room_array['th2']='red';
          $dest_array['th2']='Osthayee Nibash Red User.php';
        }
         else if($a=='33'){
          $room_array['th3']='red';
          $dest_array['th3']='Osthayee Nibash Red User.php';
        }
         else if($a=='34'){
          $room_array['th4']='red';
          $dest_array['th4']='Osthayee Nibash Red User.php';
        }
         else if($a=='35'){
          $room_array['th5']='red';
          $dest_array['th5']='Osthayee Nibash Red User.php';
        }
         else if($a=='36'){
          $room_array['th6']='red';
          $dest_array['th6']='Osthayee Nibash Red User.php';
        }
         else if($a=='37'){
          $room_array['th7']='red';
          $dest_array['th7']='Osthayee Nibash Red User.php';
        }
         else if($a=='38'){
          $room_array['th8']='red';
          $dest_array['th8']='Osthayee Nibash Red User.php';
        }
        else if($a=='21'){
          $room_array['se1']='red';
          $dest_array['se1']='Osthayee Nibash Red User.php';
        }
         else if($a=='22'){
          $room_array['se2']='red';
          $dest_array['se2']='Osthayee Nibash Red User.php';
        }
         else if($a=='23'){
          $room_array['se3']='red';
          $dest_array['se3']='Osthayee Nibash Red User.php';
        }
         else if($a=='24'){
          $room_array['se4']='red';
          $dest_array['se4']='Osthayee Nibash Red User.php';
        }
         else if($a=='25'){
          $room_array['se5']='red';
          $dest_array['se5']='Osthayee Nibash Red User.php';
        }
         else if($a=='26'){
          $room_array['se6']='red';
          $dest_array['se6']='Osthayee Nibash Red User.php';
        }
         else if($a=='27'){
          $room_array['se7']='red';
          $dest_array['se7']='Osthayee Nibash Red User.php';
        }
         else if($a=='28'){
          $room_array['se8']='red';
          $dest_array['se8']='Osthayee Nibash Red User.php';
        }
        else if($a=='11'){
          $room_array['fi1']='red';
          $dest_array['fi1']='Osthayee Nibash Red User.php';
        }
         else if($a=='12'){
          $room_array['fi2']='red';
          $dest_array['fi2']='Osthayee Nibash Red User.php';
        }
         else if($a=='13'){
          $room_array['fi3']='red';
          $dest_array['fi3']='Osthayee Nibash Red User.php';
        }
         else if($a=='14'){
          $room_array['fi4']='red';
          $dest_array['fi4']='Osthayee Nibash Red User.php';
        }
         else if($a=='15'){
          $room_array['fi5']='red';
          $dest_array['fi5']='Osthayee Nibash Red User.php';
        }
         else if($a=='16'){
          $room_array['fi6']='red';
          $dest_array['fi6']='Osthayee Nibash Red User.php';
        }
         else if($a=='17'){
          $room_array['fi7']='red';
          $dest_array['fi7']='Osthayee Nibash Red User.php';
        }
         else if($a=='18'){
          $room_array['fi8']='red';
          $dest_array['fi8']='Osthayee Nibash Red User.php';
        }
        else if($a=='01'){
          $room_array['gr1']='red';
          $dest_array['gr1']='Osthayee Nibash Red User.php';
        }
         else if($a=='02'){
          $room_array['gr2']='red';
          $dest_array['gr2']='Osthayee Nibash Red User.php';
        }
         else if($a=='03'){
          $room_array['gr3']='red';
          $dest_array['gr3']='Osthayee Nibash Red User.php';
        }
         else if($a=='04'){
          $room_array['gr4']='red';
          $dest_array['gr4']='Osthayee Nibash Red User.php';
        }
         else if($a=='05'){
          $room_array['gr5']='red';
          $dest_array['gr5']='Osthayee Nibash Red User.php';
        }
         else if($a=='06'){
          $room_array['gr6']='red';
          $dest_array['gr6']='Osthayee Nibash Red User.php';
        }
         else if($a=='07'){
          $room_array['gr7']='red';
          $dest_array['gr7']='Osthayee Nibash Red User.php';
        }
         else if($a=='08'){
          $room_array['gr8']='red';
          $dest_array['gr8']='Osthayee Nibash Red User.php';
        }
        
      }
    }


  }else {



    $dest_array=array('fo1'=>'Osthayee Nibash Green.php','fo2'=>'Osthayee Nibash Green.php','fo3'=>'Osthayee Nibash Green.php','fo4'=>'Osthayee Nibash Green.php','               fo5'=>'Osthayee Nibash Green.php','fo6'=>'Osthayee Nibash Green.php','fo7'=>'Osthayee Nibash Green User.php','fo8'=>'Osthayee Nibash Green.php',
                      'th1'=>'Osthayee Nibash Green.php','th2'=>'Osthayee Nibash Green.php','th3'=>'Osthayee Nibash Green.php','th4'=>'Osthayee Nibash Green.php','th5'=>'Osthayee Nibash Green.php','th6'=>'Osthayee Nibash Green.php','th7'=>'Osthayee Nibash Green.php','th8'=>'Osthayee Nibash Green.php',
                      'se1'=>'Osthayee Nibash Green.php','se2'=>'Osthayee Nibash Green.php','se3'=>'Osthayee Nibash Green.php','se4'=>'Osthayee Nibash Green.php','se5'=>'Osthayee Nibash Green.php','se6'=>'Osthayee Nibash Green.php','se7'=>'Osthayee Nibash Green.php','se8'=>'Osthayee Nibash  Green.php',
                      'fi1'=>'Osthayee Nibash Green.php','fi2'=>'Osthayee Nibash Green.php','fi3'=>'Osthayee Nibash Green.php','fi4'=>'Osthayee Nibash Green.php','fi5'=>'Osthayee Nibash Green.php','fi6'=>'Osthayee Nibash Green.php','fi7'=>'Osthayee Nibash Green.php','fi8'=>'Osthayee Nibash Green.php',
                      'gr1'=>'Osthayee Nibash Green.php','gr2'=>'Osthayee Nibash Green.php','gr3'=>'Osthayee Nibash Green.php','gr4'=>'Osthayee Nibash Green.php','gr5'=>'Osthayee Nibash Green.php','gr6'=>'Osthayee Nibash Green.php','gr7'=>'Osthayee Nibash Green.php','gr8'=>'Osthayee Nibash Green.php');


      if (mysqli_num_rows($result) > 0) { 
      while($row = mysqli_fetch_assoc($result)) {
        $a=$row["floor_room"];
        
        if($a=="41"){
          $room_array['fo1']='red';
        }
        else if($a=='42'){
          $room_array['fo2']='red';
        }
        else if($a=='43'){
          $room_array['fo3']='red';
        }
        else if($a=='44'){
          $room_array['fo4']='red';
        }
        else if($a=='45'){
          $room_array['fo5']='red';
        }
        else if($a=='45'){
          $room_array['fo5']='red';
        }
        else if($a=='45'){
          $room_array['fo5']='red';
        }
        else if($a=='46'){
          $room_array['fo6']='red';
        }
        else if($a=='47'){
          $room_array['fo7']='red';
        }
        else if($a=='48'){
          $room_array['fo8']='red';
        }
        else if($a=='31'){
          $room_array['th1']='red';
        }
         else if($a=='32'){
          $room_array['th2']='red';
        }
         else if($a=='33'){
          $room_array['th3']='red';
        }
         else if($a=='34'){
          $room_array['th4']='red';
        }
         else if($a=='35'){
          $room_array['th5']='red';
        }
         else if($a=='36'){
          $room_array['th6']='red';
        }
         else if($a=='37'){
          $room_array['th7']='red';
        }
         else if($a=='38'){
          $room_array['th8']='red';
        }
        else if($a=='21'){
          $room_array['se1']='red';
        }
         else if($a=='22'){
          $room_array['se2']='red';
        }
         else if($a=='23'){
          $room_array['se3']='red';
        }
         else if($a=='24'){
          $room_array['se4']='red';
        }
         else if($a=='25'){
          $room_array['se5']='red';
        }
         else if($a=='26'){
          $room_array['se6']='red';
        }
         else if($a=='27'){
          $room_array['se7']='red';
        }
         else if($a=='28'){
          $room_array['se8']='red';
        }
        else if($a=='11'){
          $room_array['fi1']='red';
        }
         else if($a=='12'){
          $room_array['fi2']='red';
        }
         else if($a=='13'){
          $room_array['fi3']='red';
        }
         else if($a=='14'){
          $room_array['fi4']='red';
        }
         else if($a=='15'){
          $room_array['fi5']='red';
        }
         else if($a=='16'){
          $room_array['fi6']='red';
        }
         else if($a=='17'){
          $room_array['fi7']='red';
        }
         else if($a=='18'){
          $room_array['fi8']='red';
        }
        else if($a=='01'){
          $room_array['gr1']='red';
        }
         else if($a=='02'){
          $room_array['gr2']='red';
        }
         else if($a=='03'){
          $room_array['gr3']='red';
        }
         else if($a=='04'){
          $room_array['gr4']='red';
        }
         else if($a=='05'){
          $room_array['gr5']='red';
        }
         else if($a=='06'){
          $room_array['gr6']='red';
        }
         else if($a=='07'){
          $room_array['gr7']='red';
        }
         else if($a=='08'){
          $room_array['gr8']='red';
        }
        
      }
  }

}

?>

<?php  
   
?>


<!DOCTYPE html>
<html>
<head>
	<title>Welcome to mess booking website</title>
	<link rel="stylesheet" type="text/css" href="Osthayee Nibash.css">
	<link rel="stylesheet" type="text/css" href="project.css">

</head>
<body>
	<body>


	<div class="login">
		<ul>
			<li><a href="pproject.php">Home</a></li>
			<li><a href="https://www.facebook.com">About KUET</a></li>
			<li><a href="">About KUET first year student</a></li>
			<li>
				<div class="dropdown">
                    <button class="dropbtn">House/Building</button>
                    <div class="dropdown-content">
                        <a href="Osthayee Nibash.php">Osthayee Nibash</a>
                        <a href="#">Fox House</a>
                        <a href="#">Sakib Chatrabash</a>
                        <a href="#">Amina Monjil</a>
                        <a href="#">Dalan Kuthir</a>
                        <a href="#">New Mese</a>
                        <a href="#">Amena Villa</a>
                        <a href="#">R.S.Moljil</a>
                        <a href="#">Bismillah</a>
                        <a href="#">Bristy Mansion</a>
                    </div>
                </div>
			</li>
			<li><a href="">Customer_service</a></li>
			<li><a href="">Booking</a></li>
			<li><button id="login_button" class="loginbtn" onclick="document.getElementById('id01').style.display='block'" style="width:auto;padding: 20px 32px 20px 20px;background: #3366CC;margin-left: 17px;margin-right: -39px;">Login</button></li>
			<li><button id="register_button" onclick="document.getElementById('id02').style.display='block'" style="width:auto;padding: 20px;background: #3366CC">Reginster</button></li>
		</ul>
	</div>
  

  <form action="" method="post">
    <ul id="aa" style="margin-left: 1113px; position: absolute; visibility: hidden; margin-top: -96px;padding-top: 37px;list-style: none;">
        <li  class="b"><input type="submit" name="profile_button" value="My Profile" style="width:auto;padding: 19px 21px 18px 20px;background: #3366CC;"></li>
    </ul>
  </form>

  <form action="" method="post">
    <ul id="ab" style="margin-left: 1202px; position: absolute; visibility: hidden; margin-top: -96px;padding-top: 37px;list-style: none;">
        <li  class="b"><input type="submit" name="logout_button" value="Logout" style="width:auto; margin-left: 13px;padding: 19px 21px 18px 20px;background: #3366CC;"></li>
    </ul>
  </form>

    <div class="intro_pic">
    	<div class="intro">
    		<h3 style="margin-left: 150px">Osthayee Nibash</h3>
    		<p style="margin-left: 30px">
    			Osthayee Nibash is one of the most popular residential Building for KUET students.This building is situaded near the pocket gate of KUET.One can reach Osthayee Nibash within <strong>two minutes</strong>through walking. Osthayee Nibash is <strong>Five stored Building</strong>.In front of the ground floor there are some <strong>departmental stores for KUET student.</strong>The surrounding of the Osthayee Nibash is quite and beautiful.
    			In one word it can be say that <strong>Osthayee Nibash</strong> is the most popular residential Building for KUET students.
    		</p>
    	</div>


    	<div class="picture">
    		<h2 class="w3-center">Osthayee Nibash</h2>

            <div class="w3-content w3-section" style="max-width:500px">
                   <img class="mySlides" src="images/osthayee1.jpg" alt="" style="width:100%;height: 500px">
                   <img class="mySlides" src="images/osthayee2.jpg" style="width:100%;height: 500px">
                   <img class="mySlides" src="images/osthayee3.jpg" style="width:100%;height: 500px">
                   <img class="mySlides" src="images/osthayee4.jpg" style="width:100%;height: 500px">
            </div>

    	</div>
    </div>



    <dir class="owner">
    	<div class="owner_name">
    		<h2>Owner Name</h2>
    		<strong>Md.Hasan Ali</strong>
    	</div>
    	<div class="owner_contact">
    		<h2>Owner Contact Number</h2>
    		<strong style="margin-left: 60px">01771755543</strong>
    	</div>
    	<div class="owner_address">
    		<h2 style="margin-left: 45px">Owner Address</h2>
    		<strong>Osthayee Nibash,Ground Floor,Roon 15</strong>
    	</div>
    </dir>







    <div class="all_floor">
    	<div class="para">
    		<h2 style="margin-left: 600px">Room Of Osthayee Nibash</h2>
    		<p style="margin-left: 1100px;color: green"><strong>Green are available</strong></p>
    		<p style="margin-left: 1100px;color: red"><strong>Red are booked</strong></p>
    	</div>

    	<div class="forth_floor">
    		<div class="forth_floor_p">
    			<p style="margin-left: 40px">4th Floor:=></p>
    		</div>
    		<div class="forth_floor_room">
    			<ul>

            <form action="" method="post">
               <li><a style="background-color:<?php echo $room_array['fo1']; ?>" href="<?php echo  $dest_array['fo1']; ?>?id=41">Room1</a></li>
               <li><a style="background-color:<?php echo $room_array['fo2']; ?>" href="<?php echo  $dest_array['fo2']; ?>?id=42">Room2</a></li>
               <li><a style="background-color:<?php echo $room_array['fo3']; ?>" href="<?php echo  $dest_array['fo3']; ?>?id=43">Room3</a></li>
               <li><a style="background-color:<?php echo $room_array['fo4']; ?>" href="<?php echo  $dest_array['fo4']; ?>?id=44">Room4</a></li>
               <li><a style="background-color:<?php echo $room_array['fo5']; ?>" href="<?php echo  $dest_array['fo5']; ?>?id=45">Room5</a></li>
               <li><a style="background-color:<?php echo $room_array['fo6']; ?>" href="<?php echo  $dest_array['fo6']; ?>?id=46">Room6</a></li>
               <li><a style="background-color:<?php echo $room_array['fo7']; ?>" href="<?php echo  $dest_array['fo7']; ?>?id=47">Room7</a></li>
               <li><a style="background-color:<?php echo $room_array['fo8']; ?>" href="<?php echo  $dest_array['fo8']; ?>?id=48">Room8</a></li>
            </form>
    				
    			</ul>
    		</div>
    	</div>

    	<div class="third_floor">
    		<div class="third_floor_p">
    			<p style="margin-left: 40px">3th Floor:=></p>
    		</div>
    		<div class="third_floor_room">
    			<ul>
    				<li><a style="background-color:<?php echo $room_array['th1']; ?>" href="<?php echo  $dest_array['th1']; ?>?id=31">Room1</a></li>
    				<li><a style="background-color:<?php echo $room_array['th2']; ?>" href="<?php echo  $dest_array['th1']; ?>?id=32">Room2</a></li>
    				<li><a style="background-color:<?php echo $room_array['th3']; ?>" href="<?php echo  $dest_array['th2']; ?>?id=33">Room3</a></li>
    				<li><a style="background-color:<?php echo $room_array['th4']; ?>" href="<?php echo  $dest_array['th3']; ?>?id=34">Room4</a></li>
    				<li><a style="background-color:<?php echo $room_array['th5']; ?>" href="<?php echo  $dest_array['th4']; ?>?id=35">Room5</a></li>
    				<li><a style="background-color:<?php echo $room_array['th6']; ?>" href="<?php echo  $dest_array['th5']; ?>?id=36">Room6</a></li>
    				<li><a style="background-color:<?php echo $room_array['th7']; ?>" href="<?php echo  $dest_array['th6']; ?>?id=37">Room7</a></li>
    				<li><a style="background-color:<?php echo $room_array['th8']; ?>" href="<?php echo  $dest_array['th7']; ?>?id=38">Room8</a></li>
    			</ul>
    		</div>
    	</div>

    	<div class="second_floor">
    		<div class="second_floor_p">
    			<p style="margin-left: 40px">2nd Floor:=></p>
    		</div>
    		<div class="second_floor_room">
    			<ul>
    				<li><a style="background-color:<?php echo $room_array['se1']; ?>" href="<?php echo  $dest_array['se1']; ?>?id=21">Room1</a></li>
    				<li><a style="background-color:<?php echo $room_array['se2']; ?>" href="<?php echo  $dest_array['se2']; ?>?id=22">Room2</a></li>
    				<li><a style="background-color:<?php echo $room_array['se3']; ?>" href="<?php echo  $dest_array['se3']; ?>?id=23">Room3</a></li>
    				<li><a style="background-color:<?php echo $room_array['se4']; ?>" href="<?php echo  $dest_array['se4']; ?>?id=24">Room4</a></li>
    				<li><a style="background-color:<?php echo $room_array['se5']; ?>" href="<?php echo  $dest_array['se5']; ?>?id=25">Room5</a></li>
    				<li><a style="background-color:<?php echo $room_array['se6']; ?>" href="<?php echo  $dest_array['se6']; ?>?id=26">Room6</a></li>
    				<li><a style="background-color:<?php echo $room_array['se7']; ?>" href="<?php echo  $dest_array['se7']; ?>?id=27">Room7</a></li>
    				<li><a style="background-color:<?php echo $room_array['se8']; ?>" href="<?php echo  $dest_array['se8']; ?>?id=28">Room8</a></li>
    			</ul>
    		</div>
    	</div>

    	<div class="first_floor">
    		<div class="first_floor_p">
    			<p style="margin-left: 40px">1st Floor:=></p>
    		</div>
    		<div class="first_floor_room">
    			<ul>
    				<li><a style="background-color:<?php echo $room_array['fi1']; ?>" href="<?php echo  $dest_array['fi1']; ?>?id=11">Room1</a></li>
    				<li><a style="background-color:<?php echo $room_array['fi2']; ?>" href="<?php echo  $dest_array['fi2']; ?>?id=12">Room2</a></li>
    				<li><a style="background-color:<?php echo $room_array['fi3']; ?>" href="<?php echo  $dest_array['fi3']; ?>?id=13">Room3</a></li>
    				<li><a style="background-color:<?php echo $room_array['fi4']; ?>" href="<?php echo  $dest_array['fi4']; ?>?id=14">Room4</a></li>
    				<li><a style="background-color:<?php echo $room_array['fi5']; ?>" href="<?php echo  $dest_array['fi5']; ?>?id=15">Room5</a></li>
    				<li><a style="background-color:<?php echo $room_array['fi6']; ?>" href="<?php echo  $dest_array['fi6']; ?>?id=16">Room6</a></li>
    				<li><a style="background-color:<?php echo $room_array['fi7']; ?>" href="<?php echo  $dest_array['fi7']; ?>?id=17">Room7</a></li>
    				<li><a style="background-color:<?php echo $room_array['fi8']; ?>" href="<?php echo  $dest_array['fi8']; ?>?id=18">Room8</a></li>
    			</ul>
    		</div>
    	</div>

    	<div class="ground_floor">
    		<div class="ground_floor_p">
    			<?php echo "<p style=\"margin-left: 40px\">Ground Floor:=></p>";?>
    		</div>
    		<div class="ground_floor_room">
    			<ul>
    				<li><a style="background-color:<?php echo $room_array['gr1']; ?>" href="<?php echo  $dest_array['gr1']; ?>?id=01">Room1</a></li>
    				<li><a style="background-color:<?php echo $room_array['gr2']; ?>" href="<?php echo  $dest_array['gr2']; ?>?id=02">Room2</a></li>
    				<li><a style="background-color:<?php echo $room_array['gr3']; ?>" href="<?php echo  $dest_array['gr3']; ?>?id=03">Room3</a></li>
    				<li><a style="background-color:<?php echo $room_array['gr4']; ?>" href="<?php echo  $dest_array['gr4']; ?>?id=04">Room4</a></li>
    				<li><a style="background-color:<?php echo $room_array['gr5']; ?>" href="<?php echo  $dest_array['gr5']; ?>?id=05">Room5</a></li>
    				<li><a style="background-color:<?php echo $room_array['gr6']; ?>" href="<?php echo  $dest_array['gr6']; ?>?id=06">Room6</a></li>
    				<li><a style="background-color:<?php echo $room_array['gr7']; ?>" href="<?php echo  $dest_array['gr7']; ?>?id=07">Room7</a></li>
    				<li><a style="background-color:<?php echo $room_array['gr8']; ?>" href="<?php echo  $dest_array['gr8']; ?>?id=08">Room8</a></li>
    			</ul>
    		</div>
    	</div>

    </div>





    <div class="prices_and_facilities">
    	<div class="prices">
    		<h2 style="margin-left: 80px">Rend Cost</h2>
    		<p><strong>Rand cost between 3000 to 5000 per room</strong></p>
    		<p><strong>According to Floor or other condition</strong></p>
    	</div>
    	<div class="facilities">
    		<h2 style="margin-left: 170px">Facilities Of Osthayee Nibash</h2>
    		<p>A student will get all kind of facilities from Osthayee Nibash. Electricity and Water is available all time. There are also departmental stores in the <strong>Ground Floor</strong>.So student can buy there necessary things very easily. Surrounding is quite so students get a perfect environment for their studies. </p>
    	</div>
    </div>





	<div id="id01" class="modal">
  
  <form class="modal-content animate" action="" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      <img src="img_avatar2.png" alt="Login Form" class="avatar">
    </div>

    <div class="container">
      <label for="uname"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="uname" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw" required>
        
      <input type="submit" name="submit1" value="Login">
      <label>
        <input type="checkbox" checked="checked" name="remember"> Remember me
      </label>
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
      <span class="psw">Forgot <a href="#">password?</a></span>
    </div>
  </form>
</div>





<div id="id02" class="modal1">
  
  <form class="modal-content animate" action="" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
      <img src="img_avatar2.png" alt="Registration Form" class="avatar">
    </div>

    <div class="container">
      <label for="uname"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="uname" required>

      <label for="ename"><b>Email @ Address</b></label>
      <input type="text" placeholder="Enter User Email @ address" name="ename" required>

      <label for="house"><b>House/Building Name</b></label>
      <input type="text" placeholder="Enter House/Building Name" name="house" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw1" required>

      <label for="psw"><b>Confarm Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw2" required>
        
      <input type="submit" name="submit2" value="Register">
      <label>
        <input type="checkbox" checked="checked" name="remember"> Remember me
      </label>
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Cancel</button>
      <span class="psw">Forgot <a href="#">password?</a></span>
    </div>
  </form>
</div>



<script>
                  var myIndex = 0;
                  carousel();

                  function carousel() {
                  var i;
                  var x = document.getElementsByClassName("mySlides");
                  for (i = 0; i < x.length; i++) {
                      x[i].style.display = "none";  
                    }
                  myIndex++;
                  if (myIndex > x.length) {myIndex = 1}    
                  x[myIndex-1].style.display = "block";  
                  setTimeout(carousel, 2000); 
                  }
                  var flag = "<?php echo $_SESSION['loginflag']; ?>"
                  if(flag==="true"){
                         document.getElementById("login_button").style.visibility="hidden";
                         document.getElementById("register_button").style.visibility="hidden";


                         document.getElementById("aa").style.visibility="visible";
                         document.getElementById("ab").style.visibility="visible";
         
                  }else{
                          document.getElementById("login_button").style.visibility="visible";
                          document.getElementById("register_button").style.visibility="visible";

                          document.getElementById("aa").style.visibility="hidden";
                          document.getElementById("ab").style.visibility="hidden";
                  }
                 

</script>
                  

<script>

    var modal1 = document.getElementById('id01');
    var modal=document.getElementById('id02');
    window.onclick = function(event) {
        if (event.target == modal1) {
            modal1.style.display = "none";
        }else if(event.target == modal){
          modal.style.display="none";
        }
}
</script>

</body>
</html>