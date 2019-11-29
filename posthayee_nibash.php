<?php
session_start();
//This is the code for what will happne after the loging condition.................................................................
if(isset($_SESSION['loginflag'])){
  $login_flag=$_SESSION['loginflag'];//if loging flag is flase the the logout button is worked..................................... 
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
//Here is the code for after login button..........................................................................................................
  if(!empty($_POST['logout_button'])){
    $_SESSION['loginflag']="false";
    header("Location: pproject.php");
  }

  // This is for MyProfile button....................................................................................................................
  if(!empty($_POST['profile_button'])){
    header("Location: padmin.php");
  }

  //code for update button..........................................................................................................................
  if(!empty($_POST['confarm_button'])){
    header("Location: pupdate_building_information.php");
  }

  $_SESSION['q_a_table']="";//for query and ans pages building tracking................................................

?>

<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "project";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    $expected_building=$_GET['building_tracking'];
    $_SESSION['building_name_table']=$expected_building;

    $sql="SELECT * FROM building_table";
    $result=mysqli_query($conn,$sql);

    if (mysqli_num_rows($result) > 0) {
          while($row = mysqli_fetch_assoc($result)) {
               $a=$row["building_name"];
    
               if($expected_building==$a){
                 $a=$row['id'];
                 $b=$row['building_name'];
                 $c=$row['building_floor_no'];      //determine which house or building is clicked.....................................
                 $d=$row['room_each_floor'];
                 $e=$row['building_description'];
                 $f=$row['building_rent_cost'];
                 $g=$row['building_facilities'];
                 $b_image=$row['building_picture'];
                 $building_information_array= array('id' => $a,'building_name' => $b,'building_floor_no' =>$c ,
                                                    'room_each_floor' => $d,'building_description'=> $e,'building_rent_cost'=> $f,
                                                    'building_facilities' => $g,'building_picture'=> $b_image);
                 break;
               }
          }
//for tracking the table name to the building..................................................
      }

      if($building_information_array['building_description']==NULL)$building_information_array['building_description']="Building Description is not available";
      if($building_information_array['building_facilities']==NULL)$building_information_array['building_facilities']="Building Facilities are not available";
      if($building_information_array['building_rent_cost']==NULL)$building_information_array['building_rent_cost']="Building rent cost is not Available";
      if($building_information_array['building_picture']==NULL)$building_information_array['building_picture']="Buidling Image is not Available"; 

      //array for each floor rooms.....................from building table(removing space)..................................................
      $floor_arry= array();//floor_array is for color detection.............................................................................

      $building_table="";
      for ($i=0; $i <strlen($b) ; $i++) { 
         if($b[$i]==' '){
          $building_table=$building_table."_";
         }else{
          $building_table=$building_table.$b[$i];
         }
      }

      for ($i=0; $i <$c ; $i++) { 
         $a=(string)$i;
         for ($j=1; $j <=$d ; $j++) {         //floor no begins with index 0 and room no begins with index 1.................................    
            $b=(string)$j;
            $floor_room=$a.$b;
            $floor_arry[$floor_room]="green";  //initializing here....................
         }
      }

      $sql="SELECT * FROM $building_table";

      $result=mysqli_query($conn,$sql);
      if (mysqli_num_rows($result) > 0) {
          while($row = mysqli_fetch_assoc($result)) {
               $a=$row["room_flag"];
               $b=$row["floor_room"];
               if($a==1){
                 $floor_arry[$b]='yellow';
               }else if($a==2){
                 $floor_arry[$b]='red';
               }
          }
      }
      
      
      //code for owner information..........................................................................
      $tin=$building_information_array['building_name'];
      $sql="SELECT * FROM owner_table WHERE building_name='$tin'";
      $result=mysqli_query($conn,$sql);

      if(mysqli_num_rows($result)){
        while($row = mysqli_fetch_assoc($result)) {
               $o_name=$row['owner_name'];
               $o_contact=$row['owner_contact'];
               $o_address=$row['owner_address'];

               break;
          }
      }

      if($o_contact==NULL)$o_contact="Not Available";
      if($o_address==NULL)$o_address="Not Available";

?>

<?php
//Code for dropdown content..................................................................................
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "project";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    $building_name_array=array();

    $sql="SELECT * FROM building_table";
    $result=mysqli_query($conn,$sql);                       //code for drop down content of menubar..................

     if (mysqli_num_rows($result) > 0) {
          $i=-1;
          while($row = mysqli_fetch_assoc($result)) {
               $i++;
               $building_name_array[$i]=$row['building_name'];
          }
      }

?>

<!DOCTYPE html>
<html>
<head>
	<title>Welcome to mess booking website</title>
	<link rel="stylesheet" type="text/css" href="Osthayee Nibash.css">
	<link rel="stylesheet" type="text/css" href="project.css">
  <style type="text/css">
    .room_list ul li{
      float: left;list-style: none;text-align: center;;
        }
    .room_list ul li a{
      text-decoration: none;
    }
  </style>

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
                    <div class="dropdown-content" style="margin-left: 23px">
                        <?php 
                             $count=count($building_name_array);
                             for ($i=0; $i <$count ; $i++) { 
                                echo "<a href=\"posthayee_nibash.php?building_tracking=$building_name_array[$i]\">$building_name_array[$i]</a>";
                             }
                        ?>
                    </div>
                </div>
      </li>
      <li>
        <div class="dropdown">
                    <button class="dropbtn" style="margin-left: -20px;">Query and Answer</button>
                    <div class="dropdown-content" style="margin-left: -14px;">
                        <?php 
                             $count=count($building_name_array);
                             for ($i=0; $i <$count ; $i++) { 
                                echo "<a href=\"posthayee_nibash.php\">$building_name_array[$i]</a>";
                             }
                        ?>
                    </div>
                </div>
      </li>
      <li><button id="login_button" class="loginbtn" onclick="document.getElementById('id01').style.display='block'" style="width:auto;padding: 20px 32px 20px 20px;background: #3366CC;margin-left: -4px;margin-right: -39px;border: none;color: white;font-size: 16px;">Login</button></li>
      <div class="dropdown">
                    <button class="dropbtn" style="width:auto;margin-left: -50px;background: #3366CC">Registration</button>
                    <div class="dropdown-content" style="margin-left: -45px;">
                        <button id="register_button" onclick="document.getElementById('id02').style.display='block'" style="width:auto;padding: 20px 58px 20px 56px;background: #3366CC">Student</button>
                        <button id="register_button" onclick="document.getElementById('id03').style.display='block'" style="width:auto;padding: 20px 60px 20px 60px;background: #3366CC">Owner</button>
                        <button id="register_button" onclick="document.getElementById('id04').style.display='block'" style="width:auto;padding: 20px 59px 20px 63px;background: #3366CC">Admin</button>
                    </div>
                </div>
      </li>
		</ul>
	</div>
  
   <form action="" method="post">
    <ul id="aaa" style="margin-left: 1027px; position: absolute; visibility: hidden; margin-top: -96px;padding-top: 37px;list-style: none;">
        <li  class="b"><input type="submit" name="confarm_button" value="Update" style="width:auto;padding: 19px 21px 18px 20px;background: #3366CC;"></li>
    </ul>
  </form>

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
    		<h3 style="margin-left: 150px"><?php echo $building_information_array['building_name'];  ?></h3>
    		<p style="margin-left: 30px">
    			<strong><i><?php echo $building_information_array['building_description'];  ?></i></strong>
    		</p>
    	</div>


    	<div class="picture">
    		<h2 class="w3-center"><?php echo $building_information_array['building_name'];  ?></h2>

            <div class="w3-content w3-section" style="max-width:500px">
              <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $building_information_array['building_picture']).'"  style="margin-left: 30px;margin-top: 70px;" width="100%" height="500px"/>'; ?>
            </div>

    	</div>
    </div>



    <dir class="owner">
    	<div class="owner_name">
    		<h2>Owner Name</h2>
    		<strong><?php echo "whai is going on??"; ?></strong>
    	</div>
    	<div class="owner_contact">
    		<h2>Owner Contact Number</h2>
    		<strong style="margin-left: 60px"><?php echo $o_contact; ?></strong>
    	</div>
    	<div class="owner_address">
    		<h2 style="margin-left: 45px">Owner Address</h2>
    		<strong><?php echo $o_address;  ?></strong>
    	</div>
    </dir>







    <div class="all_floor">
    	<div class="para">
    		<h2 style="margin-left: 600px">Room Of Osthayee Nibash</h2>
    		<p style="margin-left: 1100px;color: green;margin-top: -45px;"><strong>Green are available For double</strong></p>
        <p style="margin-left: 1100px;color: yellow"><strong>Yellow are available for single</strong></p>
    		<p style="margin-left: 1100px;color: red"><strong>Red are totally booked</strong></p>
    	</div>

    	
    	<?php 
         //for room devision...................................................
         for ($i=0; $i <$building_information_array['building_floor_no'] ; $i++) { 
           $a=(string)$i;

           if($building_information_array['room_each_floor']==3){
               $room1=$floor_arry[$a.'1'];$room2=$floor_arry[$a.'2'];$room3=$floor_arry[$a.'3'];
               if($i==0)$amit_floor="Ground Floor";
                else if($i==1)$amit_floor="First Floor";
                else if($i==2)$amit_floor="Second Floor";
                else if($i==3)$amit_floor="Third Floor";
                else if($i==4)$amit_floor="Forth Floor";
                else if($i==5)$amit_floor="Fifth Floor";
                else if($i==6)$amit_floor="Sixth Floor";
                else if($i==7)$amit_floor="Seventh Floor";
                else if($i==8)$amit_floor="Eight Floor";
                else if($i==9)$amit_floor="Ninth Floor";
                else if($i==10)$amit_floor="Tenth Floor";
               echo " 
                   <div class=\"room_list\" style=\"margin-left: 20px;margin-top: 20px;\">
                      <ul style=\"margin-top:10px;margin-left: 545px;\">
                         <li style=\"background-color:#826145;padding: 0px 70px 0px 70px;margin-left: -300px;color: black;\">$amit_floor  ==></p>
                         <li><a style=\"background-color:$room1;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.1\">Room1</a></li>
                         <li><a style=\"background-color:$room2;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.2\">Room2</a></li>
                         <li><a style=\"background-color:$room3;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.3\">Room3</a></li>
                      </ul>
                   </div>
                   ";
               echo "<p>.<br></p>";

           }else if($building_information_array['room_each_floor']==4){
                $room1=$floor_arry[$a.'1'];$room2=$floor_arry[$a.'2'];$room3=$floor_arry[$a.'3'];$room4=$floor_arry[$a.'4'];
                if($i==0)$amit_floor="Ground Floor";
                else if($i==1)$amit_floor="First Floor";
                else if($i==2)$amit_floor="Second Floor";
                else if($i==3)$amit_floor="Third Floor";
                else if($i==4)$amit_floor="Forth Floor";
                else if($i==5)$amit_floor="Fifth Floor";
                else if($i==6)$amit_floor="Sixth Floor";
                else if($i==7)$amit_floor="Seventh Floor";
                else if($i==8)$amit_floor="Eight Floor";
                else if($i==9)$amit_floor="Ninth Floor";
                else if($i==10)$amit_floor="Tenth Floor";
                echo " 
                   <div class=\"room_list\" style=\"margin-left: 20px;margin-top: 20px;\">
                      <ul style=\"margin-top:10px;margin-left: 545px;\">
                         <li style=\"background-color:#826145;padding: 0px 70px 0px 70px;margin-left: -300px;color: black;\">$amit_floor  ==></p>
                         <li><a style=\"background-color:$room1;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.1\">Room1</a></li>
                         <li><a style=\"background-color:$room2;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.2\">Room2</a></li>
                         <li><a style=\"background-color:$room3;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.3\">Room3</a></li>
                         <li><a style=\"background-color:$room4;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.4\">Room4</a></li>
                      </ul>
                   </div>
                   ";
                echo "<p>.<br></p>";
           }else if($building_information_array['room_each_floor']==5){
                $room1=$floor_arry[$a.'1'];$room2=$floor_arry[$a.'2'];$room3=$floor_arry[$a.'3'];$room4=$floor_arry[$a.'4'];$room5=$floor_arry[$a.'5'];
                if($i==0)$amit_floor="Ground Floor";
                else if($i==1)$amit_floor="First Floor";
                else if($i==2)$amit_floor="Second Floor";
                else if($i==3)$amit_floor="Third Floor";
                else if($i==4)$amit_floor="Forth Floor";
                else if($i==5)$amit_floor="Fifth Floor";
                else if($i==6)$amit_floor="Sixth Floor";
                else if($i==7)$amit_floor="Seventh Floor";
                else if($i==8)$amit_floor="Eight Floor";
                else if($i==9)$amit_floor="Ninth Floor";
                else if($i==10)$amit_floor="Tenth Floor";
                echo " 
                   <div class=\"room_list\" style=\"margin-left: 20px;margin-top: 20px;\">
                      <ul style=\"margin-top:10px;margin-left: 430px;\">
                         <li style=\"background-color:#826145;padding: 0px 70px 0px 70px;margin-left: -300px;color: black;\">$amit_floor  ==></p>
                         <li><a style=\"background-color:$room1;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.1\">Room1</a></li>
                         <li><a style=\"background-color:$room2;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.2\">Room2</a></li>
                         <li><a style=\"background-color:$room3;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.3\">Room3</a></li>
                         <li><a style=\"background-color:$room4;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.4\">Room4</a></li>
                         <li><a style=\"background-color:$room5;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.5\">Room5</a></li>
                      </ul>
                   </div>
                   ";
                echo "<p>.<br></p>";
           }else if($building_information_array['room_each_floor']==6){
            $room1=$floor_arry[$a.'1'];$room2=$floor_arry[$a.'2'];$room3=$floor_arry[$a.'3'];$room4=$floor_arry[$a.'4'];$room5=$floor_arry[$a.'5'];$room6=$floor_arry[$a.'6'];
                if($i==0)$amit_floor="Ground Floor";
                else if($i==1)$amit_floor="First Floor";
                else if($i==2)$amit_floor="Second Floor";
                else if($i==3)$amit_floor="Third Floor";
                else if($i==4)$amit_floor="Forth Floor";
                else if($i==5)$amit_floor="Fifth Floor";
                else if($i==6)$amit_floor="Sixth Floor";
                else if($i==7)$amit_floor="Seventh Floor";
                else if($i==8)$amit_floor="Eight Floor";
                else if($i==9)$amit_floor="Ninth Floor";
                else if($i==10)$amit_floor="Tenth Floor";
                echo " 
                   <div class=\"room_list\" style=\"margin-left: 20px;margin-top: 20px;\">
                      <ul style=\"margin-top:10px;margin-left: 430px;\">
                         <li style=\"background-color:#826145;padding: 0px 70px 0px 70px;margin-left: -300px;color: black;\">$amit_floor  ==></p>
                         <li><a style=\"background-color:$room1;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.1\">Room1</a></li>
                         <li><a style=\"background-color:$room2;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.2\">Room2</a></li>
                         <li><a style=\"background-color:$room3;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.3\">Room3</a></li>
                         <li><a style=\"background-color:$room4;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.4\">Room4</a></li>
                         <li><a style=\"background-color:$room5;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.5\">Room5</a></li>
                         <li><a style=\"background-color:$room6;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.6\">Room6</a></li>
                      </ul>
                   </div>
                   ";

                echo "<p>.<br></p>";
           }else if($building_information_array['room_each_floor']==7){
                $room1=$floor_arry[$a.'1'];$room2=$floor_arry[$a.'2'];$room3=$floor_arry[$a.'3'];$room4=$floor_arry[$a.'4'];$room5=$floor_arry[$a.'5'];$room6=$floor_arry[$a.'6'];$room7=$floor_arry[$a.'7'];
                if($i==0)$amit_floor="Ground Floor";
                else if($i==1)$amit_floor="First Floor";
                else if($i==2)$amit_floor="Second Floor";
                else if($i==3)$amit_floor="Third Floor";
                else if($i==4)$amit_floor="Forth Floor";
                else if($i==5)$amit_floor="Fifth Floor";
                else if($i==6)$amit_floor="Sixth Floor";
                else if($i==7)$amit_floor="Seventh Floor";
                else if($i==8)$amit_floor="Eight Floor";
                else if($i==9)$amit_floor="Ninth Floor";
                else if($i==10)$amit_floor="Tenth Floor";
                echo " 
                   <div class=\"room_list\" style=\"margin-left: 20px;margin-top: 20px;\">
                      <ul style=\"margin-top:10px;margin-left: 430px;\">
                         <li style=\"background-color:#826145;padding: 0px 70px 0px 70px;margin-left: -300px;color: black;\">$amit_floor  ==></p>
                         <li><a style=\"background-color:$room1;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.1\">Room1</a></li>
                         <li><a style=\"background-color:$room2;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.2\">Room2</a></li>
                         <li><a style=\"background-color:$room3;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.3\">Room3</a></li>
                         <li><a style=\"background-color:$room4;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.4\">Room4</a></li>
                         <li><a style=\"background-color:$room5;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.5\">Room5</a></li>
                         <li><a style=\"background-color:$room6;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.6\">Room6</a></li>
                         <li><a style=\"background-color:$room7;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.7\">Room7</a></li>
                      </ul>
                   </div>
                   ";
                echo "<p>.<br></p>";
           }else if($building_information_array['room_each_floor']==8){
                $room1=$floor_arry[$a.'1'];$room2=$floor_arry[$a.'2'];$room3=$floor_arry[$a.'3'];$room4=$floor_arry[$a.'4'];$room5=$floor_arry[$a.'5'];$room6=$floor_arry[$a.'6'];$room7=$floor_arry[$a.'7'];$room8=$floor_arry[$a.'8'];
                if($i==0)$amit_floor="Ground Floor";
                else if($i==1)$amit_floor="First Floor";
                else if($i==2)$amit_floor="Second Floor";
                else if($i==3)$amit_floor="Third Floor";
                else if($i==4)$amit_floor="Forth Floor";
                else if($i==5)$amit_floor="Fifth Floor";
                else if($i==6)$amit_floor="Sixth Floor";
                else if($i==7)$amit_floor="Seventh Floor";
                else if($i==8)$amit_floor="Eight Floor";
                else if($i==9)$amit_floor="Ninth Floor";
                else if($i==10)$amit_floor="Tenth Floor";
                echo " 
                   <div class=\"room_list\" style=\"margin-left: 20px;margin-top: 30px;\">
                      <ul style=\"margin-top:10px;margin-left: 430px;\">
                         <li style=\"background-color:#826145;padding: 0px 70px 0px 70px;margin-left: -300px;color: black;\">$amit_floor  ==></p>
                         <li><a style=\"background-color:$room1;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.1\">Room1</a></li>
                         <li><a style=\"background-color:$room2;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.2\">Room2</a></li>
                         <li><a style=\"background-color:$room3;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.3\">Room3</a></li>
                         <li><a style=\"background-color:$room4;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.4\">Room4</a></li>
                         <li><a style=\"background-color:$room5;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.5\">Room5</a></li>
                         <li><a style=\"background-color:$room6;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.6\">Room6</a></li>
                         <li><a style=\"background-color:$room7;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.7\">Room7</a></li>
                         <li><a style=\"background-color:$room8;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.8\">Room8</a></li>
                      </ul>
                   </div>
                   ";
                   echo "<p>.<br></p>";
           }else if($building_information_array['room_each_floor']==9){
                $room1=$floor_arry[$a.'1'];$room2=$floor_arry[$a.'2'];$room3=$floor_arry[$a.'3'];$room4=$floor_arry[$a.'4'];$room5=$floor_arry[$a.'5'];$room6=$floor_arry[$a.'6'];$room7=$floor_arry[$a.'7'];$room8=$floor_arry[$a.'8'];$room9=$floor_arry[$a.'9'];
                if($i==0)$amit_floor="Ground Floor";
                else if($i==1)$amit_floor="First Floor";
                else if($i==2)$amit_floor="Second Floor";
                else if($i==3)$amit_floor="Third Floor";
                else if($i==4)$amit_floor="Forth Floor";
                else if($i==5)$amit_floor="Fifth Floor";
                else if($i==6)$amit_floor="Sixth Floor";
                else if($i==7)$amit_floor="Seventh Floor";
                else if($i==8)$amit_floor="Eight Floor";
                else if($i==9)$amit_floor="Ninth Floor";
                else if($i==10)$amit_floor="Tenth Floor";
                echo " 
                   <div class=\"room_list\" style=\"margin-left: 20px;margin-top: 20px;\">
                      <ul style=\"margin-top:10px;margin-left: 430px;\">
                         <li style=\"background-color:#826145;padding: 0px 70px 0px 70px;margin-left: -300px;color: black;\">$amit_floor  ==></p>
                         <li><a style=\"background-color:$room1;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.1\">Room1</a></li>
                         <li><a style=\"background-color:$room2;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.2\">Room2</a></li>
                         <li><a style=\"background-color:$room3;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.3\">Room3</a></li>
                         <li><a style=\"background-color:$room4;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.4\">Room4</a></li>
                         <li><a style=\"background-color:$room5;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.5\">Room5</a></li>
                         <li><a style=\"background-color:$room6;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.6\">Room6</a></li>
                         <li><a style=\"background-color:$room7;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.7\">Room7</a></li>
                         <li><a style=\"background-color:$room8;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.8\">Room8</a></li>
                         <li><a style=\"background-color:$room9padding:  5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.9\">Room9</a></li>
                      </ul>
                   </div>
                   ";
                echo "<p>.<br></p>";
           }else if($building_information_array['room_each_floor']==10){
                $room1=$floor_arry[$a.'1'];$room2=$floor_arry[$a.'2'];$room3=$floor_arry[$a.'3'];$room4=$floor_arry[$a.'4'];$room5=$floor_arry[$a.'5'];$room6=$floor_arry[$a.'6'];$room7=$floor_arry[$a.'7'];$room8=$floor_arry[$a.'8'];$room9=$floor_arry[$a.'9'];$room10=$floor_arry[$a.'10'];
                if($i==0)$amit_floor="Ground Floor";
                else if($i==1)$amit_floor="First Floor";
                else if($i==2)$amit_floor="Second Floor";
                else if($i==3)$amit_floor="Third Floor";
                else if($i==4)$amit_floor="Forth Floor";
                else if($i==5)$amit_floor="Fifth Floor";
                else if($i==6)$amit_floor="Sixth Floor";
                else if($i==7)$amit_floor="Seventh Floor";
                else if($i==8)$amit_floor="Eight Floor";
                else if($i==9)$amit_floor="Ninth Floor";
                else if($i==10)$amit_floor="Tenth Floor";
                echo " 
                   <div class=\"room_list\" style=\"margin-left: 20px;margin-top: 20px;\">
                      <ul style=\"margin-top:10px;margin-left: 430px;\">
                         <li style=\"background-color:#826145;padding: 0px 70px 0px 70px;margin-left: -300px;color: black;\">$amit_floor  ==></p>
                         <li><a style=\"background-color:$room1;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.1\">Room1</a></li>
                         <li><a style=\"background-color:$room2;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.2\">Room2</a></li>
                         <li><a style=\"background-color:$room3;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.3\">Room3</a></li>
                         <li><a style=\"background-color:$room4;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.4\">Room4</a></li>
                         <li><a style=\"background-color:$room5;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.5\">Room5</a></li>
                         <li><a style=\"background-color:$room6;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.6\">Room6</a></li>
                         <li><a style=\"background-color:$room7;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.7\">Room7</a></li>
                         <li><a style=\"background-color:$room8;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.8\">Room8</a></li>
                         <li><a style=\"background-color:$room9padding:  5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.9\">Room9</a></li>
                         <li><a style=\"background-color:$room10padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.10\">Room10</a></li>
                      </ul>
                   </div>
                   ";
                echo "<p>.<br></p>";
           }else if($building_information_array['room_each_floor']==11){
                $room1=$floor_arry[$a.'1'];$room2=$floor_arry[$a.'2'];$room3=$floor_arry[$a.'3'];$room4=$floor_arry[$a.'4'];$room5=$floor_arry[$a.'5'];$room6=$floor_arry[$a.'6'];$room7=$floor_arry[$a.'7'];$room8=$floor_arry[$a.'8'];$room9=$floor_arry[$a.'9'];$room10=$floor_arry[$a.'10'];$room11=$floor_arry[$a.'11'];
                if($i==0)$amit_floor="Ground Floor";
                else if($i==1)$amit_floor="First Floor";
                else if($i==2)$amit_floor="Second Floor";
                else if($i==3)$amit_floor="Third Floor";
                else if($i==4)$amit_floor="Forth Floor";
                else if($i==5)$amit_floor="Fifth Floor";
                else if($i==6)$amit_floor="Sixth Floor";
                else if($i==7)$amit_floor="Seventh Floor";
                else if($i==8)$amit_floor="Eight Floor";
                else if($i==9)$amit_floor="Ninth Floor";
                else if($i==10)$amit_floor="Tenth Floor";
                echo " 
                   <div class=\"room_list\" style=\"margin-left: 20px;margin-top: 20px;\">
                      <ul style=\"margin-top:10px;margin-left: 430px;\">
                         <li style=\"background-color:#826145;padding: 0px 70px 0px 70px;margin-left: -300px;color: black;\">$amit_floor  ==></p>
                         <li><a style=\"background-color:$room1;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.1\">Room1</a></li>
                         <li><a style=\"background-color:$room2;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.2\">Room2</a></li>
                         <li><a style=\"background-color:$room3;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.3\">Room3</a></li>
                         <li><a style=\"background-color:$room4;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.4\">Room4</a></li>
                         <li><a style=\"background-color:$room5;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.5\">Room5</a></li>
                         <li><a style=\"background-color:$room6;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.6\">Room6</a></li>
                         <li><a style=\"background-color:$room7;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.7\">Room7</a></li>
                         <li><a style=\"background-color:$room8;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.8\">Room8</a></li>
                         <li><a style=\"background-color:$room9padding:  5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.9\">Room9</a></li>
                         <li><a style=\"background-color:$room10padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.10\">Room10</a></li>
                         <li><a style=\"background-color:$room11padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.11\">Room11</a></li>
                      </ul>
                   </div>
                   ";
                echo "<p>.<br></p>";
           }else if($building_information_array['room_each_floor']==12){
                $room1=$floor_arry[$a.'1'];$room2=$floor_arry[$a.'2'];$room3=$floor_arry[$a.'3'];$room4=$floor_arry[$a.'4'];$room5=$floor_arry[$a.'5'];$room6=$floor_arry[$a.'6'];$room7=$floor_arry[$a.'7'];$room8=$floor_arry[$a.'8'];$room9=$floor_arry[$a.'9'];$room10=$floor_arry[$a.'10'];$room11=$floor_arry[$a.'11'];$room12=$floor_arry[$a.'12'];
                if($i==0)$amit_floor="Ground Floor";
                else if($i==1)$amit_floor="First Floor";
                else if($i==2)$amit_floor="Second Floor";
                else if($i==3)$amit_floor="Third Floor";
                else if($i==4)$amit_floor="Forth Floor";
                else if($i==5)$amit_floor="Fifth Floor";
                else if($i==6)$amit_floor="Sixth Floor";
                else if($i==7)$amit_floor="Seventh Floor";
                else if($i==8)$amit_floor="Eight Floor";
                else if($i==9)$amit_floor="Ninth Floor";
                else if($i==10)$amit_floor="Tenth Floor";
                echo " 
                   <div class=\"room_list\" style=\"margin-left: 20px;margin-top: 20px;\">
                      <ul style=\"margin-top:10px;margin-left: 380px;\">
                         <li style=\"background-color:#826145;padding: 0px 70px 0px 70px;margin-left: -300px;color: black;\">$amit_floor  ==></p>
                         <li><a style=\"background-color:$room1;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.1\">Room1</a></li>
                         <li><a style=\"background-color:$room2;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.2\">Room2</a></li>
                         <li><a style=\"background-color:$room3;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.3\">Room3</a></li>
                         <li><a style=\"background-color:$room4;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.4\">Room4</a></li>
                         <li><a style=\"background-color:$room5;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.5\">Room5</a></li>
                         <li><a style=\"background-color:$room6;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.6\">Room6</a></li>
                         <li><a style=\"background-color:$room7;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.7\">Room7</a></li>
                         <li><a style=\"background-color:$room8;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.8\">Room8</a></li>
                         <li><a style=\"background-color:$room9padding:  5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.9\">Room9</a></li>
                         <li><a style=\"background-color:$room10padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.10\">Room10</a></li>
                         <li><a style=\"background-color:$room11padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.11\">Room11</a></li>
                         <li><a style=\"background-color:$room12padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.12\">Room12</a></li>
                      </ul>
                   </div>
                   ";
                echo "<p>.<br></p>";
           }else if($building_information_array['room_each_floor']==13){
               $room1=$floor_arry[$a.'1'];$room2=$floor_arry[$a.'2'];$room3=$floor_arry[$a.'3'];$room4=$floor_arry[$a.'4'];$room5=$floor_arry[$a.'5'];$room6=$floor_arry[$a.'6'];$room7=$floor_arry[$a.'7'];$room8=$floor_arry[$a.'8'];$room9=$floor_arry[$a.'9'];$room10=$floor_arry[$a.'10'];$room11=$floor_arry[$a.'11'];$room12=$floor_arry[$a.'12'];
            $room13=$floor_arry[$a.'13'];
            if($i==0)$amit_floor="Ground Floor";
                else if($i==1)$amit_floor="First Floor";
                else if($i==2)$amit_floor="Second Floor";
                else if($i==3)$amit_floor="Third Floor";
                else if($i==4)$amit_floor="Forth Floor";
                else if($i==5)$amit_floor="Fifth Floor";
                else if($i==6)$amit_floor="Sixth Floor";
                else if($i==7)$amit_floor="Seventh Floor";
                else if($i==8)$amit_floor="Eight Floor";
                else if($i==9)$amit_floor="Ninth Floor";
                else if($i==10)$amit_floor="Tenth Floor";
                echo " 
                   <div class=\"room_list\" style=\"margin-left: 20px;margin-top: 20px;\">
                      <ul style=\"margin-top:10px;margin-left: 330px;\">
                         <li style=\"background-color:#826145;padding: 0px 70px 0px 70px;margin-left: -300px;color: black;\">$amit_floor  ==></p>
                         <li><a style=\"background-color:$room1;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.1\">Room1</a></li>
                         <li><a style=\"background-color:$room2;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.2\">Room2</a></li>
                         <li><a style=\"background-color:$room3;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.3\">Room3</a></li>
                         <li><a style=\"background-color:$room4;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.4\">Room4</a></li>
                         <li><a style=\"background-color:$room5;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.5\">Room5</a></li>
                         <li><a style=\"background-color:$room6;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.6\">Room6</a></li>
                         <li><a style=\"background-color:$room7;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.7\">Room7</a></li>
                         <li><a style=\"background-color:$room8;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.8\">Room8</a></li>
                         <li><a style=\"background-color:$room9;padding:  5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.9\">Room9</a></li>
                         <li><a style=\"background-color:$room10;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.10\">Room10</a></li>
                         <li><a style=\"background-color:$room11;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.11\">Room11</a></li>
                         <li><a style=\"background-color:$room12;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.12\">Room12</a></li>
                         <li><a style=\"background-color:$room13;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.13\">Room13</a></li>
                      </ul>
                   </div>
                   ";
                echo "<p>.<br></p>";
           }else if($building_information_array['room_each_floor']==14){
                $room1=$floor_arry[$a.'1'];$room2=$floor_arry[$a.'2'];$room3=$floor_arry[$a.'3'];$room4=$floor_arry[$a.'4'];$room5=$floor_arry[$a.'5'];$room6=$floor_arry[$a.'6'];$room7=$floor_arry[$a.'7'];$room8=$floor_arry[$a.'8'];$room9=$floor_arry[$a.'9'];$room10=$floor_arry[$a.'10'];$room11=$floor_arry[$a.'11'];$room12=$floor_arry[$a.'12'];
            $room13=$floor_arry[$a.'13'];$room14=$floor_arry[$a.'14'];
            if($i==0)$amit_floor="Ground Floor";
                else if($i==1)$amit_floor="First Floor";
                else if($i==2)$amit_floor="Second Floor";
                else if($i==3)$amit_floor="Third Floor";
                else if($i==4)$amit_floor="Forth Floor";
                else if($i==5)$amit_floor="Fifth Floor";
                else if($i==6)$amit_floor="Sixth Floor";
                else if($i==7)$amit_floor="Seventh Floor";
                else if($i==8)$amit_floor="Eight Floor";
                else if($i==9)$amit_floor="Ninth Floor";
                else if($i==10)$amit_floor="Tenth Floor";
                echo " 
                   <div class=\"room_list\" style=\"margin-left: 20px;margin-top: 20px;\">
                      <ul style=\"margin-top:10px;margin-left: 330px;\">
                         <li style=\"background-color:#826145;padding: 0px 70px 0px 70px;margin-left: -300px;color: black;\">$amit_floor  ==></p>
                         <li><a style=\"background-color:$room1;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.1\">Room1</a></li>
                         <li><a style=\"background-color:$room2;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.2\">Room2</a></li>
                         <li><a style=\"background-color:$room3;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.3\">Room3</a></li>
                         <li><a style=\"background-color:$room4;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.4\">Room4</a></li>
                         <li><a style=\"background-color:$room5;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.5\">Room5</a></li>
                         <li><a style=\"background-color:$room6;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.6\">Room6</a></li>
                         <li><a style=\"background-color:$room7;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.7\">Room7</a></li>
                         <li><a style=\"background-color:$room8;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.8\">Room8</a></li>
                         <li><a style=\"background-color:$room9padding:  5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.9\">Room9</a></li>
                         <li><a style=\"background-color:$room10padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.10\">Room10</a></li>
                         <li><a style=\"background-color:$room11padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.11\">Room11</a></li>
                         <li><a style=\"background-color:$room12padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.12\">Room12</a></li>
                         <li><a style=\"background-color:$room13padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.13\">Room13</a></li>
                         <li><a style=\"background-color:$room14padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.14\">Room14</a></li>
                      </ul>
                   </div>
                   ";
                echo "<p>.<br></p>";
           }else if($building_information_array['room_each_floor']==15){
            $room1=$floor_arry[$a.'1'];$room2=$floor_arry[$a.'2'];$room3=$floor_arry[$a.'3'];$room4=$floor_arry[$a.'4'];$room5=$floor_arry[$a.'5'];$room6=$floor_arry[$a.'6'];$room7=$floor_arry[$a.'7'];$room8=$floor_arry[$a.'8'];$room9=$floor_arry[$a.'9'];$room10=$floor_arry[$a.'10'];$room11=$floor_arry[$a.'11'];$room12=$floor_arry[$a.'12'];
            $room13=$floor_arry[$a.'13'];$room14=$floor_arry[$a.'14'];$room15=$floor_arry[$a.'15'];
            if($i==0)$amit_floor="Ground Floor";
                else if($i==1)$amit_floor="First Floor";
                else if($i==2)$amit_floor="Second Floor";
                else if($i==3)$amit_floor="Third Floor";
                else if($i==4)$amit_floor="Forth Floor";
                else if($i==5)$amit_floor="Fifth Floor";
                else if($i==6)$amit_floor="Sixth Floor";
                else if($i==7)$amit_floor="Seventh Floor";
                else if($i==8)$amit_floor="Eight Floor";
                else if($i==9)$amit_floor="Ninth Floor";
                else if($i==10)$amit_floor="Tenth Floor";
                echo " 
                   <div class=\"room_list\" style=\"margin-left: 20px;margin-top: 20px;\">
                      <ul style=\"margin-top:10px;margin-left: 330px;\">
                         <li style=\"background-color:#826145;padding: 0px 70px 0px 70px;margin-left: -300px;color: black;\">$amit_floor  ==></p>
                         <li><a style=\"background-color:$room1;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.1\">Room1</a></li>
                         <li><a style=\"background-color:$room2;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.2\">Room2</a></li>
                         <li><a style=\"background-color:$room3;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.3\">Room3</a></li>
                         <li><a style=\"background-color:$room4;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.4\">Room4</a></li>
                         <li><a style=\"background-color:$room5;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.5\">Room5</a></li>
                         <li><a style=\"background-color:$room6;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.6\">Room6</a></li>
                         <li><a style=\"background-color:$room7;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.7\">Room7</a></li>
                         <li><a style=\"background-color:$room8;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.8\">Room8</a></li>
                         <li><a style=\"background-color:$room9padding:  5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.9\">Room9</a></li>
                         <li><a style=\"background-color:$room10padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.10\">Room10</a></li>
                         <li><a style=\"background-color:$room11padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.11\">Room11</a></li>
                         <li><a style=\"background-color:$room12padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.12\">Room12</a></li>
                         <li><a style=\"background-color:$room13padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.13\">Room13</a></li>
                         <li><a style=\"background-color:$room14padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.14\">Room14</a></li>
                         <li><a style=\"background-color:$room15padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.15\">Room15</a></li>
                      </ul>
                   </div>
                   ";
              echo "<p>.<br></p>";
           }else if($building_information_array['room_each_floor']==16){
            $room1=$floor_arry[$a.'1'];$room2=$floor_arry[$a.'2'];$room3=$floor_arry[$a.'3'];$room4=$floor_arry[$a.'4'];$room5=$floor_arry[$a.'5'];$room6=$floor_arry[$a.'6'];$room7=$floor_arry[$a.'7'];$room8=$floor_arry[$a.'8'];$room9=$floor_arry[$a.'9'];$room10=$floor_arry[$a.'10'];$room11=$floor_arry[$a.'11'];$room12=$floor_arry[$a.'12'];
            $room13=$floor_arry[$a.'13'];$room14=$floor_arry[$a.'14'];$room15=$floor_arry[$a.'15'];$room16=$floor_arry[$a.'16'];
            if($i==0)$amit_floor="Ground Floor";
                else if($i==1)$amit_floor="First Floor";
                else if($i==2)$amit_floor="Second Floor";
                else if($i==3)$amit_floor="Third Floor";
                else if($i==4)$amit_floor="Forth Floor";
                else if($i==5)$amit_floor="Fifth Floor";
                else if($i==6)$amit_floor="Sixth Floor";
                else if($i==7)$amit_floor="Seventh Floor";
                else if($i==8)$amit_floor="Eight Floor";
                else if($i==9)$amit_floor="Ninth Floor";
                else if($i==10)$amit_floor="Tenth Floor";
                echo " 
                   <div class=\"room_list\" style=\"margin-left: 20px;margin-top: 20px;\">
                      <ul style=\"margin-top:10px;margin-left: 280px;\">
                         <li style=\"background-color:#826145;padding: 0px 70px 0px 70px;margin-left: -300px;color: black;\">$amit_floor  ==></p>
                         <li><a style=\"background-color:$room1;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.1\">Room1</a></li>
                         <li><a style=\"background-color:$room2;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.2\">Room2</a></li>
                         <li><a style=\"background-color:$room3;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.3\">Room3</a></li>
                         <li><a style=\"background-color:$room4;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.4\">Room4</a></li>
                         <li><a style=\"background-color:$room5;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.5\">Room5</a></li>
                         <li><a style=\"background-color:$room6;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.6\">Room6</a></li>
                         <li><a style=\"background-color:$room7;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.7\">Room7</a></li>
                         <li><a style=\"background-color:$room8;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.8\">Room8</a></li>
                         <li><a style=\"background-color:$room9padding:  5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.9\">Room9</a></li>
                         <li><a style=\"background-color:$room10padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.10\">Room10</a></li>
                         <li><a style=\"background-color:$room11padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.11\">Room11</a></li>
                         <li><a style=\"background-color:$room12padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.12\">Room12</a></li>
                         <li><a style=\"background-color:$room13padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.13\">Room13</a></li>
                         <li><a style=\"background-color:$room14padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.14\">Room14</a></li>
                         <li><a style=\"background-color:$room15padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.15\">Room15</a></li>
                         <li><a style=\"background-color:$room16padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.16\">Room16</a></li>
                      </ul>
                   </div>
                   ";
              echo "<p>.<br></p>";
           }else if($building_information_array['room_each_floor']==17){
            $room1=$floor_arry[$a.'1'];$room2=$floor_arry[$a.'2'];$room3=$floor_arry[$a.'3'];$room4=$floor_arry[$a.'4'];$room5=$floor_arry[$a.'5'];$room6=$floor_arry[$a.'6'];$room7=$floor_arry[$a.'7'];$room8=$floor_arry[$a.'8'];$room9=$floor_arry[$a.'9'];$room10=$floor_arry[$a.'10'];$room11=$floor_arry[$a.'11'];$room12=$floor_arry[$a.'12'];
            $room13=$floor_arry[$a.'13'];$room14=$floor_arry[$a.'14'];$room15=$floor_arry[$a.'15'];$room16=$floor_arry[$a.'16'];$room17=$floor_arry[$a.'17'];
            if($i==0)$amit_floor="Ground Floor";
                else if($i==1)$amit_floor="First Floor";
                else if($i==2)$amit_floor="Second Floor";
                else if($i==3)$amit_floor="Third Floor";
                else if($i==4)$amit_floor="Forth Floor";
                else if($i==5)$amit_floor="Fifth Floor";
                else if($i==6)$amit_floor="Sixth Floor";
                else if($i==7)$amit_floor="Seventh Floor";
                else if($i==8)$amit_floor="Eight Floor";
                else if($i==9)$amit_floor="Ninth Floor";
                else if($i==10)$amit_floor="Tenth Floor";
                echo " 
                   <div class=\"room_list\" style=\"margin-left: 20px;margin-top: 20px;\">
                      <ul style=\"margin-top:10px;margin-left: 280px;\">
                         <li style=\"background-color:#826145;padding: 0px 70px 0px 70px;margin-left: -300px;color: black;\">$amit_floor  ==></p>
                         <li><a style=\"background-color:$room1;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.1\">Room1</a></li>
                         <li><a style=\"background-color:$room2;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.2\">Room2</a></li>
                         <li><a style=\"background-color:$room3;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.3\">Room3</a></li>
                         <li><a style=\"background-color:$room4;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.4\">Room4</a></li>
                         <li><a style=\"background-color:$room5;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.5\">Room5</a></li>
                         <li><a style=\"background-color:$room6;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.6\">Room6</a></li>
                         <li><a style=\"background-color:$room7;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.7\">Room7</a></li>
                         <li><a style=\"background-color:$room8;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.8\">Room8</a></li>
                         <li><a style=\"background-color:$room9padding:  5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.9\">Room9</a></li>
                         <li><a style=\"background-color:$room10padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.10\">Room10</a></li>
                         <li><a style=\"background-color:$room11padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.11\">Room11</a></li>
                         <li><a style=\"background-color:$room12padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.12\">Room12</a></li>
                         <li><a style=\"background-color:$room13padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.13\">Room13</a></li>
                         <li><a style=\"background-color:$room14padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.14\">Room14</a></li>
                         <li><a style=\"background-color:$room15padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.15\">Room15</a></li>
                         <li><a style=\"background-color:$room16padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.16\">Room16</a></li>
                         <li><a style=\"background-color:$room17padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.17\">Room17</a></li>
                      </ul>
                   </div>
                   ";
              echo "<p>.<br></p>";
           }else if($building_information_array['room_each_floor']==18){
           $room1=$floor_arry[$a.'1'];$room2=$floor_arry[$a.'2'];$room3=$floor_arry[$a.'3'];$room4=$floor_arry[$a.'4'];$room5=$floor_arry[$a.'5'];$room6=$floor_arry[$a.'6'];$room7=$floor_arry[$a.'7'];$room8=$floor_arry[$a.'8'];$room9=$floor_arry[$a.'9'];$room10=$floor_arry[$a.'10'];$room11=$floor_arry[$a.'11'];$room12=$floor_arry[$a.'12'];
            $room13=$floor_arry[$a.'13'];$room14=$floor_arry[$a.'14'];$room15=$floor_arry[$a.'15'];$room16=$floor_arry[$a.'16'];$room17=$floor_arry[$a.'17'];$room18=$floor_arry[$a.'18'];
            if($i==0)$amit_floor="Ground Floor";
                else if($i==1)$amit_floor="First Floor";
                else if($i==2)$amit_floor="Second Floor";
                else if($i==3)$amit_floor="Third Floor";
                else if($i==4)$amit_floor="Forth Floor";
                else if($i==5)$amit_floor="Fifth Floor";
                else if($i==6)$amit_floor="Sixth Floor";
                else if($i==7)$amit_floor="Seventh Floor";
                else if($i==8)$amit_floor="Eight Floor";
                else if($i==9)$amit_floor="Ninth Floor";
                else if($i==10)$amit_floor="Tenth Floor";
                echo " 
                   <div class=\"room_list\" style=\"margin-left: 20px;margin-top: 20px;\">
                      <ul style=\"margin-top:10px;margin-left: 280px;\">
                         <li style=\"background-color:#826145;padding: 0px 70px 0px 70px;margin-left: -300px;color: black;\">$amit_floor  ==></p>
                         <li><a style=\"background-color:$room1;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.1\">Room1</a></li>
                         <li><a style=\"background-color:$room2;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.2\">Room2</a></li>
                         <li><a style=\"background-color:$room3;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.3\">Room3</a></li>
                         <li><a style=\"background-color:$room4;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.4\">Room4</a></li>
                         <li><a style=\"background-color:$room5;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.5\">Room5</a></li>
                         <li><a style=\"background-color:$room6;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.6\">Room6</a></li>
                         <li><a style=\"background-color:$room7;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.7\">Room7</a></li>
                         <li><a style=\"background-color:$room8;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.8\">Room8</a></li>
                         <li><a style=\"background-color:$room9padding:  5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.9\">Room9</a></li>
                         <li><a style=\"background-color:$room10padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.10\">Room10</a></li>
                         <li><a style=\"background-color:$room11padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.11\">Room11</a></li>
                         <li><a style=\"background-color:$room12padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.12\">Room12</a></li>
                         <li><a style=\"background-color:$room13padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.13\">Room13</a></li>
                         <li><a style=\"background-color:$room14padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.14\">Room14</a></li>
                         <li><a style=\"background-color:$room15padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.15\">Room15</a></li>
                         <li><a style=\"background-color:$room16padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.16\">Room16</a></li>
                         <li><a style=\"background-color:$room17padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.17\">Room17</a></li>
                         <li><a style=\"background-color:$room18padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.18\">Room18</a></li>
                      </ul>
                   </div>
                   ";
                echo "<p>.<br></p>";
           }else if($building_information_array['room_each_floor']==19){
            $room1=$floor_arry[$a.'1'];$room2=$floor_arry[$a.'2'];$room3=$floor_arry[$a.'3'];$room4=$floor_arry[$a.'4'];$room5=$floor_arry[$a.'5'];$room6=$floor_arry[$a.'6'];$room7=$floor_arry[$a.'7'];$room8=$floor_arry[$a.'8'];$room9=$floor_arry[$a.'9'];$room10=$floor_arry[$a.'10'];$room11=$floor_arry[$a.'11'];$room12=$floor_arry[$a.'12'];
            $room13=$floor_arry[$a.'13'];$room14=$floor_arry[$a.'14'];$room15=$floor_arry[$a.'15'];$room16=$floor_arry[$a.'16'];$room17=$floor_arry[$a.'17'];$room18=$floor_arry[$a.'18'];$room19=$floor_arry[$a.'19'];
            if($i==0)$amit_floor="Ground Floor";
                else if($i==1)$amit_floor="First Floor";
                else if($i==2)$amit_floor="Second Floor";
                else if($i==3)$amit_floor="Third Floor";
                else if($i==4)$amit_floor="Forth Floor";
                else if($i==5)$amit_floor="Fifth Floor";
                else if($i==6)$amit_floor="Sixth Floor";
                else if($i==7)$amit_floor="Seventh Floor";
                else if($i==8)$amit_floor="Eight Floor";
                else if($i==9)$amit_floor="Ninth Floor";
                else if($i==10)$amit_floor="Tenth Floor";
                echo " 
                   <div class=\"room_list\" style=\"margin-left: 20px;margin-top: 20px;\">
                      <ul style=\"margin-top:10px;margin-left: 230px;\">
                         <li style=\"background-color:#826145;padding: 0px 70px 0px 70px;margin-left: -300px;color: black;\">$amit_floor  ==></p>
                         <li><a style=\"background-color:$room1;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.1\">Room1</a></li>
                         <li><a style=\"background-color:$room2;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.2\">Room2</a></li>
                         <li><a style=\"background-color:$room3;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.3\">Room3</a></li>
                         <li><a style=\"background-color:$room4;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.4\">Room4</a></li>
                         <li><a style=\"background-color:$room5;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.5\">Room5</a></li>
                         <li><a style=\"background-color:$room6;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.6\">Room6</a></li>
                         <li><a style=\"background-color:$room7;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.7\">Room7</a></li>
                         <li><a style=\"background-color:$room8;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.8\">Room8</a></li>
                         <li><a style=\"background-color:$room9padding:  5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.9\">Room9</a></li>
                         <li><a style=\"background-color:$room10padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.10\">Room10</a></li>
                         <li><a style=\"background-color:$room11padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.11\">Room11</a></li>
                         <li><a style=\"background-color:$room12padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.12\">Room12</a></li>
                         <li><a style=\"background-color:$room13padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.13\">Room13</a></li>
                         <li><a style=\"background-color:$room14padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.14\">Room14</a></li>
                         <li><a style=\"background-color:$room15padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.15\">Room15</a></li>
                         <li><a style=\"background-color:$room16padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.16\">Room16</a></li>
                         <li><a style=\"background-color:$room17padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.17\">Room17</a></li>
                         <li><a style=\"background-color:$room18padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.18\">Room18</a></li>
                         <li><a style=\"background-color:$room19padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.19\">Room19</a></li>
                      </ul>
                   </div>
                   ";
                echo "<p>.<br></p>";
           }else if($building_information_array['room_each_floor']==20){
            $room1=$floor_arry[$a.'1'];$room2=$floor_arry[$a.'2'];$room3=$floor_arry[$a.'3'];$room4=$floor_arry[$a.'4'];$room5=$floor_arry[$a.'5'];$room6=$floor_arry[$a.'6'];$room7=$floor_arry[$a.'7'];$room8=$floor_arry[$a.'8'];$room9=$floor_arry[$a.'9'];$room10=$floor_arry[$a.'10'];$room11=$floor_arry[$a.'11'];$room12=$floor_arry[$a.'12'];
            $room13=$floor_arry[$a.'13'];$room14=$floor_arry[$a.'14'];$room15=$floor_arry[$a.'15'];$room16=$floor_arry[$a.'16'];$room17=$floor_arry[$a.'17'];$room18=$floor_arry[$a.'18'];$room19=$floor_arry[$a.'19'];$room20=$floor_arry[$a.'20'];
            if($i==0)$amit_floor="Ground Floor";
                else if($i==1)$amit_floor="First Floor";
                else if($i==2)$amit_floor="Second Floor";
                else if($i==3)$amit_floor="Third Floor";
                else if($i==4)$amit_floor="Forth Floor";
                else if($i==5)$amit_floor="Fifth Floor";
                else if($i==6)$amit_floor="Sixth Floor";
                else if($i==7)$amit_floor="Seventh Floor";
                else if($i==8)$amit_floor="Eight Floor";
                else if($i==9)$amit_floor="Ninth Floor";
                else if($i==10)$amit_floor="Tenth Floor";
                echo " 
                   <div class=\"room_list\" style=\"margin-left: 20px;margin-top: 20px;\">
                      <ul style=\"margin-top:10px;margin-left: 230px;\">
                         <li style=\"background-color:#826145;padding: 0px 70px 0px 70px;margin-left: -300px;color: black;\">$amit_floor  ==></p>
                         <li><a style=\"background-color:$room1;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.1\">Room1</a></li>
                         <li><a style=\"background-color:$room2;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.2\">Room2</a></li>
                         <li><a style=\"background-color:$room3;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.3\">Room3</a></li>
                         <li><a style=\"background-color:$room4;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.4\">Room4</a></li>
                         <li><a style=\"background-color:$room5;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.5\">Room5</a></li>
                         <li><a style=\"background-color:$room6;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.6\">Room6</a></li>
                         <li><a style=\"background-color:$room7;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.7\">Room7</a></li>
                         <li><a style=\"background-color:$room8;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.8\">Room8</a></li>
                         <li><a style=\"background-color:$room9padding:  5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.9\">Room9</a></li>
                         <li><a style=\"background-color:$room10padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.10\">Room10</a></li>
                         <li><a style=\"background-color:$room11padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.11\">Room11</a></li>
                         <li><a style=\"background-color:$room12padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.12\">Room12</a></li>
                         <li><a style=\"background-color:$room13padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.13\">Room13</a></li>
                         <li><a style=\"background-color:$room14padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.14\">Room14</a></li>
                         <li><a style=\"background-color:$room15padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.15\">Room15</a></li>
                         <li><a style=\"background-color:$room16padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.16\">Room16</a></li>
                         <li><a style=\"background-color:$room17padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.17\">Room17</a></li>
                         <li><a style=\"background-color:$room18padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.18\">Room18</a></li>
                         <li><a style=\"background-color:$room19padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.19\">Room19</a></li>
                         <li><a style=\"background-color:$room20padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.20\">Room20</a></li>
                      </ul>
                   </div>
                   ";
              echo "<p>.<br></p>";
           }else if($building_information_array['room_each_floor']==21){
            $room1=$floor_arry[$a.'1'];$room2=$floor_arry[$a.'2'];$room3=$floor_arry[$a.'3'];$room4=$floor_arry[$a.'4'];$room5=$floor_arry[$a.'5'];$room6=$floor_arry[$a.'6'];$room7=$floor_arry[$a.'7'];$room8=$floor_arry[$a.'8'];$room9=$floor_arry[$a.'9'];$room10=$floor_arry[$a.'10'];$room11=$floor_arry[$a.'11'];$room12=$floor_arry[$a.'12'];
            $room13=$floor_arry[$a.'13'];$room14=$floor_arry[$a.'14'];$room15=$floor_arry[$a.'15'];$room16=$floor_arry[$a.'16'];$room17=$floor_arry[$a.'17'];$room18=$floor_arry[$a.'18'];$room19=$floor_arry[$a.'19'];$room20=$floor_arry[$a.'20'];$room21=$floor_arry[$a.'21'];
            if($i==0)$amit_floor="Ground Floor";
                else if($i==1)$amit_floor="First Floor";
                else if($i==2)$amit_floor="Second Floor";
                else if($i==3)$amit_floor="Third Floor";
                else if($i==4)$amit_floor="Forth Floor";
                else if($i==5)$amit_floor="Fifth Floor";
                else if($i==6)$amit_floor="Sixth Floor";
                else if($i==7)$amit_floor="Seventh Floor";
                else if($i==8)$amit_floor="Eight Floor";
                else if($i==9)$amit_floor="Ninth Floor";
                else if($i==10)$amit_floor="Tenth Floor";
                echo " 
                   <div class=\"room_list\" style=\"margin-left: 20px;margin-top: 20px;\">
                      <ul style=\"margin-top:10px;margin-left: 230px;\">
                         <li style=\"background-color:#826145;padding: 0px 70px 0px 70px;margin-left: -300px;color: black;\">$amit_floor  ==></p>
                         <li><a style=\"background-color:$room1;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.1\">Room1</a></li>
                         <li><a style=\"background-color:$room2;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.2\">Room2</a></li>
                         <li><a style=\"background-color:$room3;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.3\">Room3</a></li>
                         <li><a style=\"background-color:$room4;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.4\">Room4</a></li>
                         <li><a style=\"background-color:$room5;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.5\">Room5</a></li>
                         <li><a style=\"background-color:$room6;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.6\">Room6</a></li>
                         <li><a style=\"background-color:$room7;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.7\">Room7</a></li>
                         <li><a style=\"background-color:$room8;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.8\">Room8</a></li>
                         <li><a style=\"background-color:$room9padding:  5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.9\">Room9</a></li>
                         <li><a style=\"background-color:$room10padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.10\">Room10</a></li>
                         <li><a style=\"background-color:$room11padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.11\">Room11</a></li>
                         <li><a style=\"background-color:$room12padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.12\">Room12</a></li>
                         <li><a style=\"background-color:$room13padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.13\">Room13</a></li>
                         <li><a style=\"background-color:$room14padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.14\">Room14</a></li>
                         <li><a style=\"background-color:$room15padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.15\">Room15</a></li>
                         <li><a style=\"background-color:$room16padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.16\">Room16</a></li>
                         <li><a style=\"background-color:$room17padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.17\">Room17</a></li>
                         <li><a style=\"background-color:$room18padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.18\">Room18</a></li>
                         <li><a style=\"background-color:$room19padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.19\">Room19</a></li>
                         <li><a style=\"background-color:$room20padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.20\">Room20</a></li>
                         <li><a style=\"background-color:$room21padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.21\">Room21</a></li>
                      </ul>
                   </div>
                   ";
                echo "<p>.<br></p>";
           }else if($building_information_array['room_each_floor']==22){
            $room1=$floor_arry[$a.'1'];$room2=$floor_arry[$a.'2'];$room3=$floor_arry[$a.'3'];$room4=$floor_arry[$a.'4'];$room5=$floor_arry[$a.'5'];$room6=$floor_arry[$a.'6'];$room7=$floor_arry[$a.'7'];$room8=$floor_arry[$a.'8'];$room9=$floor_arry[$a.'9'];$room10=$floor_arry[$a.'10'];$room11=$floor_arry[$a.'11'];$room12=$floor_arry[$a.'12'];
            $room13=$floor_arry[$a.'13'];$room14=$floor_arry[$a.'14'];$room15=$floor_arry[$a.'15'];$room16=$floor_arry[$a.'16'];$room17=$floor_arry[$a.'17'];$room18=$floor_arry[$a.'18'];$room19=$floor_arry[$a.'19'];$room20=$floor_arry[$a.'20'];$room21=$floor_arry[$a.'21'];$room22=$floor_arry[$a.'22'];
            if($i==0)$amit_floor="Ground Floor";
                else if($i==1)$amit_floor="First Floor";
                else if($i==2)$amit_floor="Second Floor";
                else if($i==3)$amit_floor="Third Floor";
                else if($i==4)$amit_floor="Forth Floor";
                else if($i==5)$amit_floor="Fifth Floor";
                else if($i==6)$amit_floor="Sixth Floor";
                else if($i==7)$amit_floor="Seventh Floor";
                else if($i==8)$amit_floor="Eight Floor";
                else if($i==9)$amit_floor="Ninth Floor";
                else if($i==10)$amit_floor="Tenth Floor";
                echo " 
                   <div class=\"room_list\" style=\"margin-left: 20px;margin-top: 20px;\">
                      <ul style=\"margin-top:10px;margin-left: 200px;\">
                         <li style=\"background-color:#826145;padding: 0px 70px 0px 70px;margin-left: -300px;color: black;\">$amit_floor  ==></p>
                         <li><a style=\"background-color:$room1;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.1\">Room1</a></li>
                         <li><a style=\"background-color:$room2;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.2\">Room2</a></li>
                         <li><a style=\"background-color:$room3;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.3\">Room3</a></li>
                         <li><a style=\"background-color:$room4;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.4\">Room4</a></li>
                         <li><a style=\"background-color:$room5;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.5\">Room5</a></li>
                         <li><a style=\"background-color:$room6;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.6\">Room6</a></li>
                         <li><a style=\"background-color:$room7;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.7\">Room7</a></li>
                         <li><a style=\"background-color:$room8;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.8\">Room8</a></li>
                         <li><a style=\"background-color:$room9padding:  5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.9\">Room9</a></li>
                         <li><a style=\"background-color:$room10padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.10\">Room10</a></li>
                         <li><a style=\"background-color:$room11padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.11\">Room11</a></li>
                         <li><a style=\"background-color:$room12padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.12\">Room12</a></li>
                         <li><a style=\"background-color:$room13padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.13\">Room13</a></li>
                         <li><a style=\"background-color:$room14padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.14\">Room14</a></li>
                         <li><a style=\"background-color:$room15padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.15\">Room15</a></li>
                         <li><a style=\"background-color:$room16padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.16\">Room16</a></li>
                         <li><a style=\"background-color:$room17padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.17\">Room17</a></li>
                         <li><a style=\"background-color:$room18padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.18\">Room18</a></li>
                         <li><a style=\"background-color:$room19padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.19\">Room19</a></li>
                         <li><a style=\"background-color:$room20padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.20\">Room20</a></li>
                         <li><a style=\"background-color:$room21padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.21\">Room21</a></li>
                         <li><a style=\"background-color:$room22padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.22\">Room22</a></li>
                      </ul>
                   </div>
                   ";
                echo "<p>.<br></p>";
           }else if($building_information_array['room_each_floor']==23){
            $room1=$floor_arry[$a.'1'];$room2=$floor_arry[$a.'2'];$room3=$floor_arry[$a.'3'];$room4=$floor_arry[$a.'4'];$room5=$floor_arry[$a.'5'];$room6=$floor_arry[$a.'6'];$room7=$floor_arry[$a.'7'];$room8=$floor_arry[$a.'8'];$room9=$floor_arry[$a.'9'];$room10=$floor_arry[$a.'10'];$room11=$floor_arry[$a.'11'];$room12=$floor_arry[$a.'12'];
            $room13=$floor_arry[$a.'13'];$room14=$floor_arry[$a.'14'];$room15=$floor_arry[$a.'15'];$room16=$floor_arry[$a.'16'];$room17=$floor_arry[$a.'17'];$room18=$floor_arry[$a.'18'];$room19=$floor_arry[$a.'19'];$room20=$floor_arry[$a.'20'];$room21=$floor_arry[$a.'21'];$room22=$floor_arry[$a.'22'];$room23=$floor_arry[$a.'23'];
            if($i==0)$amit_floor="Ground Floor";
                else if($i==1)$amit_floor="First Floor";
                else if($i==2)$amit_floor="Second Floor";
                else if($i==3)$amit_floor="Third Floor";
                else if($i==4)$amit_floor="Forth Floor";
                else if($i==5)$amit_floor="Fifth Floor";
                else if($i==6)$amit_floor="Sixth Floor";
                else if($i==7)$amit_floor="Seventh Floor";
                else if($i==8)$amit_floor="Eight Floor";
                else if($i==9)$amit_floor="Ninth Floor";
                else if($i==10)$amit_floor="Tenth Floor";
                echo " 
                   <div class=\"room_list\" style=\"margin-left: 20px;margin-top: 20px;\">
                      <ul style=\"margin-top:10px;margin-left: 180px;\">
                         <li style=\"background-color:#826145;padding: 0px 70px 0px 70px;margin-left: -300px;color: black;\">$amit_floor  ==></p>
                         <li><a style=\"background-color:$room1;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.1\">Room1</a></li>
                         <li><a style=\"background-color:$room2;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.2\">Room2</a></li>
                         <li><a style=\"background-color:$room3;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.3\">Room3</a></li>
                         <li><a style=\"background-color:$room4;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.4\">Room4</a></li>
                         <li><a style=\"background-color:$room5;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.5\">Room5</a></li>
                         <li><a style=\"background-color:$room6;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.6\">Room6</a></li>
                         <li><a style=\"background-color:$room7;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.7\">Room7</a></li>
                         <li><a style=\"background-color:$room8;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.8\">Room8</a></li>
                         <li><a style=\"background-color:$room9padding:  5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.9\">Room9</a></li>
                         <li><a style=\"background-color:$room10padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.10\">Room10</a></li>
                         <li><a style=\"background-color:$room11padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.11\">Room11</a></li>
                         <li><a style=\"background-color:$room12padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.12\">Room12</a></li>
                         <li><a style=\"background-color:$room13padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.13\">Room13</a></li>
                         <li><a style=\"background-color:$room14padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.14\">Room14</a></li>
                         <li><a style=\"background-color:$room15padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.15\">Room15</a></li>
                         <li><a style=\"background-color:$room16padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.16\">Room16</a></li>
                         <li><a style=\"background-color:$room17padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.17\">Room17</a></li>
                         <li><a style=\"background-color:$room18padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.18\">Room18</a></li>
                         <li><a style=\"background-color:$room19padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.19\">Room19</a></li>
                         <li><a style=\"background-color:$room20padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.20\">Room20</a></li>
                         <li><a style=\"background-color:$room21padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.21\">Room21</a></li>
                         <li><a style=\"background-color:$room22padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.22\">Room22</a></li>
                         <li><a style=\"background-color:$room23padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.23\">Room23</a></li>
                      </ul>
                   </div>
                   ";
                echo "<p>.<br></p>";
           }else if($building_information_array['room_each_floor']==24){
            $room1=$floor_arry[$a.'1'];$room2=$floor_arry[$a.'2'];$room3=$floor_arry[$a.'3'];$room4=$floor_arry[$a.'4'];$room5=$floor_arry[$a.'5'];$room6=$floor_arry[$a.'6'];$room7=$floor_arry[$a.'7'];$room8=$floor_arry[$a.'8'];$room9=$floor_arry[$a.'9'];$room10=$floor_arry[$a.'10'];$room11=$floor_arry[$a.'11'];$room12=$floor_arry[$a.'12'];
            $room13=$floor_arry[$a.'13'];$room14=$floor_arry[$a.'14'];$room15=$floor_arry[$a.'15'];$room16=$floor_arry[$a.'16'];$room17=$floor_arry[$a.'17'];$room18=$floor_arry[$a.'18'];$room19=$floor_arry[$a.'19'];$room20=$floor_arry[$a.'20'];$room21=$floor_arry[$a.'21'];$room22=$floor_arry[$a.'22'];$room23=$floor_arry[$a.'23'];$room24=$floor_arry[$a.'24'];
            if($i==0)$amit_floor="Ground Floor";
                else if($i==1)$amit_floor="First Floor";
                else if($i==2)$amit_floor="Second Floor";
                else if($i==3)$amit_floor="Third Floor";
                else if($i==4)$amit_floor="Forth Floor";
                else if($i==5)$amit_floor="Fifth Floor";
                else if($i==6)$amit_floor="Sixth Floor";
                else if($i==7)$amit_floor="Seventh Floor";
                else if($i==8)$amit_floor="Eight Floor";
                else if($i==9)$amit_floor="Ninth Floor";
                else if($i==10)$amit_floor="Tenth Floor";
                echo " 
                   <div class=\"room_list\" style=\"margin-left: 20px;margin-top: 20px;\">
                      <ul style=\"margin-top:10px;margin-left: 170px;\">
                         <li style=\"background-color:#826145;padding: 0px 70px 0px 70px;margin-left: -300px;color: black;\">$amit_floor  ==></p>
                         <li><a style=\"background-color:$room1;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.1\">Room1</a></li>
                         <li><a style=\"background-color:$room2;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.2\">Room2</a></li>
                         <li><a style=\"background-color:$room3;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.3\">Room3</a></li>
                         <li><a style=\"background-color:$room4;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.4\">Room4</a></li>
                         <li><a style=\"background-color:$room5;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.5\">Room5</a></li>
                         <li><a style=\"background-color:$room6;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.6\">Room6</a></li>
                         <li><a style=\"background-color:$room7;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.7\">Room7</a></li>
                         <li><a style=\"background-color:$room8;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.8\">Room8</a></li>
                         <li><a style=\"background-color:$room9padding:  5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.9\">Room9</a></li>
                         <li><a style=\"background-color:$room10padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.10\">Room10</a></li>
                         <li><a style=\"background-color:$room11padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.11\">Room11</a></li>
                         <li><a style=\"background-color:$room12padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.12\">Room12</a></li>
                         <li><a style=\"background-color:$room13padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.13\">Room13</a></li>
                         <li><a style=\"background-color:$room14padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.14\">Room14</a></li>
                         <li><a style=\"background-color:$room15padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.15\">Room15</a></li>
                         <li><a style=\"background-color:$room16padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.16\">Room16</a></li>
                         <li><a style=\"background-color:$room17padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.17\">Room17</a></li>
                         <li><a style=\"background-color:$room18padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.18\">Room18</a></li>
                         <li><a style=\"background-color:$room19padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.19\">Room19</a></li>
                         <li><a style=\"background-color:$room20padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.20\">Room20</a></li>
                         <li><a style=\"background-color:$room21padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.21\">Room21</a></li>
                         <li><a style=\"background-color:$room22padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.22\">Room22</a></li>
                         <li><a style=\"background-color:$room23padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.23\">Room23</a></li>
                         <li><a style=\"background-color:$room24padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.24\">Room24</a></li>
                      </ul>
                   </div>
                   ";
                echo "<p>.<br></p>";
           }else if($building_information_array['room_each_floor']==25){
            $room1=$floor_arry[$a.'1'];$room2=$floor_arry[$a.'2'];$room3=$floor_arry[$a.'3'];$room4=$floor_arry[$a.'4'];$room5=$floor_arry[$a.'5'];$room6=$floor_arry[$a.'6'];$room7=$floor_arry[$a.'7'];$room8=$floor_arry[$a.'8'];$room9=$floor_arry[$a.'9'];$room10=$floor_arry[$a.'10'];$room11=$floor_arry[$a.'11'];$room12=$floor_arry[$a.'12'];
            $room13=$floor_arry[$a.'13'];$room14=$floor_arry[$a.'14'];$room15=$floor_arry[$a.'15'];$room16=$floor_arry[$a.'16'];$room17=$floor_arry[$a.'17'];$room18=$floor_arry[$a.'18'];$room19=$floor_arry[$a.'19'];$room20=$floor_arry[$a.'20'];$room21=$floor_arry[$a.'21'];$room22=$floor_arry[$a.'22'];$room23=$floor_arry[$a.'23'];$room24=$floor_arry[$a.'24'];
            $room25=$floor_arry[$a.'25'];
            if($i==0)$amit_floor="Ground Floor";
                else if($i==1)$amit_floor="First Floor";
                else if($i==2)$amit_floor="Second Floor";
                else if($i==3)$amit_floor="Third Floor";
                else if($i==4)$amit_floor="Forth Floor";
                else if($i==5)$amit_floor="Fifth Floor";
                else if($i==6)$amit_floor="Sixth Floor";
                else if($i==7)$amit_floor="Seventh Floor";
                else if($i==8)$amit_floor="Eight Floor";
                else if($i==9)$amit_floor="Ninth Floor";
                else if($i==10)$amit_floor="Tenth Floor";
                echo " 
                   <div class=\"room_list\" style=\"margin-left: 20px;margin-top: 20px;\">
                      <ul style=\"margin-top:10px;margin-left: 160px;\">
                         <li><a style=\"background-color:$room1;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.1\">Room1</a></li>
                         <li><a style=\"background-color:$room2;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.2\">Room2</a></li>
                         <li><a style=\"background-color:$room3;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.3\">Room3</a></li>
                         <li><a style=\"background-color:$room4;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.4\">Room4</a></li>
                         <li><a style=\"background-color:$room5;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.5\">Room5</a></li>
                         <li><a style=\"background-color:$room6;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.6\">Room6</a></li>
                         <li><a style=\"background-color:$room7;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.7\">Room7</a></li>
                         <li><a style=\"background-color:$room8;padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.8\">Room8</a></li>
                         <li><a style=\"background-color:$room9padding:  5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.9\">Room9</a></li>
                         <li><a style=\"background-color:$room10padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.10\">Room10</a></li>
                         <li><a style=\"background-color:$room11padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.11\">Room11</a></li>
                         <li><a style=\"background-color:$room12padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.12\">Room12</a></li>
                         <li><a style=\"background-color:$room13padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.13\">Room13</a></li>
                         <li><a style=\"background-color:$room14padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.14\">Room14</a></li>
                         <li><a style=\"background-color:$room15padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.15\">Room15</a></li>
                         <li><a style=\"background-color:$room16padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.16\">Room16</a></li>
                         <li><a style=\"background-color:$room17padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.17\">Room17</a></li>
                         <li><a style=\"background-color:$room18padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.18\">Room18</a></li>
                         <li><a style=\"background-color:$room19padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.19\">Room19</a></li>
                         <li><a style=\"background-color:$room20padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.20\">Room20</a></li>
                         <li><a style=\"background-color:$room21padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.21\">Room21</a></li>
                         <li><a style=\"background-color:$room22padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.22\">Room22</a></li>
                         <li><a style=\"background-color:$room23padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.23\">Room23</a></li>
                         <li><a style=\"background-color:$room24padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.24\">Room24</a></li>
                         <li><a style=\"background-color:$room25padding: 5px;margin-left: 7px;color: black;\" href=\"proom_description.php?id=$a.25\">Room25</a></li>
                      </ul>
                   </div>
                   ";
                echo "<p>.<br></p>";
           }
           
         }
      ?>





    <div class="prices_and_facilities">
    	<div class="prices">
    		<h2 style="margin-left: 80px">Rend Cost</h2>
    		<p style="margin-left: 20px;"><strong><?php echo $building_information_array['building_rent_cost'];  ?><i></i></strong></p>
    		<p style="margin-left: 10px;"><strong>According to Floor or other condition</strong></p>
    	</div>
    	<div class="facilities">
    		<h2 style="margin-left: 170px">Facilities Of Osthayee Nibash</h2>
    		<p><?php echo $building_information_array['building_facilities'];  ?></p>
    	</div>
    </div>





	<div id="id01" class="modal">
  
  <form class="modal-content animate" action="" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      <img src="img_avatar2.png" alt="Student Form" class="avatar">
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
                  
                  var flag = "<?php echo $_SESSION['loginflag']; ?>"
                  if(flag==="true"){
                         document.getElementById("login_button").style.visibility="hidden";
                         document.getElementById("register_button").style.visibility="hidden";


                         document.getElementById("aa").style.visibility="visible";
                         document.getElementById("ab").style.visibility="visible";
                         document.getElementById("aaa").style.visibility="visible";
         
                  }else{
                          document.getElementById("login_button").style.visibility="visible";
                          document.getElementById("register_button").style.visibility="visible";

                          document.getElementById("aa").style.visibility="hidden";
                          document.getElementById("ab").style.visibility="hidden";
                           document.getElementById("aaa").style.visibility="hidden";
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