<?php
session_start();
///this is for login ............................................................................................
$_SESSION['loginflag']="false";
$_SESSION['q_a_table']="";
if(!empty($_POST['submit1'])){

  $name=$_POST['uname'];
  $pass=$_POST['psw'];
  $c_type=$_POST['c_type'];

  $savevalue=get_information($name,$pass,$c_type);
  
 
  $_SESSION['loginflag']="false";
  $_SESSION['building_name']=NULL;

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

  // This is for MyProfile button....................................................................................................................
  if(!empty($_POST['profile_button'])){
    header("Location: padmin.php");
  }

?>

<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "project";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    $building_name_array=array();

    $sql="SELECT * FROM building_table";
    $result=mysqli_query($conn,$sql);              //this is for drop down content.............................................

     if (mysqli_num_rows($result) > 0) {
          $i=-1;
          while($row = mysqli_fetch_assoc($result)) {
               $i++;
               $building_name_array[$i]=$row['building_name'];
          }
      }

?>

<?php
//code for query and answer portion.............................................................................................
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "project";

    $conn = mysqli_connect($servername, $username, $password, $dbname);


?>

<!DOCTYPE html>
<html>
<head>
	<title>Welcome to mess booking website</title>
	<link rel="stylesheet" type="text/css" href="project.css">
</head>
<body>

  <p id="extra"></p>


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
                                echo "<a href=\"pquestion_ans1.php?building_tracking=$building_name_array[$i]\">$building_name_array[$i]</a>";
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
    <ul id="aa" style="margin-left: 1113px; position: absolute; visibility: hidden; margin-top: -96px;padding-top: 37px;list-style: none;">
        <li  class="b"><input type="submit" name="profile_button" value="My Profile" style="width:auto;padding: 19px 21px 18px 20px;background: #3366CC;"></li>
    </ul>
  </form>

  <form action="" method="post">
    <ul id="ab" style="margin-left: 1202px; position: absolute; visibility: hidden; margin-top: -96px;padding-top: 37px;list-style: none;">
        <li  class="b"><input type="submit" name="logout_button" value="Logout" style="width:auto; margin-left: 13px;padding: 19px 21px 18px 20px;background: #3366CC;"></li>
    </ul>
  </form>

  
	<div class="image">
		<img src="images\rony.jpg" alt="Image of house rent" width="1400px" height="510px">

		<div class="search">
		    <h2 style="color: red;margin-left: 60px;margin-top: -35px;position: absolute">Search For Your Home</h2>

		    <form class="example" action="/action_page.php" style="margin:auto;max-width:400px;height: 1000px">
               <input type="text" placeholder="Search For House/Building Name.." name="search2" style="width: 300px;height:30px;background: #55271C;color: #C670E9">
               <button type="submit" style="width: 80px;height: 30px;background: #204E8A"><i class="search-button fa-search">submit</i></button>
            </form>
	    </div>
	</div>

	<div class="text_left">
		<h2 style="color: black;margin-left: 25px"><i> <strong>Website to</strong></i></h3>
		<h2 style="color: blue"><i><strong> Find Your New Home</strong></i></h3>
		<h2 style="color: black;margin-left: 25px"><strong><i> Online...</i></strong></h3>
	</div>


    <div class="header">
           <h1 style="color: black"><i><strong>Welcome To Mess Booking Website For KUTEian</strong></i></h1>    	
    </div>

		<div class="slide_show" style="width: 100%;">
			<ul>
				<li><a href="">Osthayee Nibash</a></li>
				<li><a href="#">Fox House</a></li>
                <li><a href="#">Sakib Chatrabash</a></li>
                <li><a href="#">Amina Monjil</a></li>
                <li><a href="#">Dalan Kuthir</a></li>
			</ul>
	    </div>


	    
        <div class="slide_show1">
	    	<ul>
	    		<li><a href="#">New Mese</a></li>
                <li><a href="#">Amena Villa</a></li>
                <li><a href="#">R.S.Moljil</a></li>
                <li><a href="#">Bismillah</a></li>
                <li><a href="#">Bristy Mansion</a></li>
	    	</ul>
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

      <label for="c_type"><b>Select the Loging type:</b></label>
      <select name="c_type" id="c_type">
        <option value="Student">Student</option>
        <option value="Mess_Owner">Mess_Owner</option>
        <option value="Admin">Admin</option>
      </select>
      <p></b></p>
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
      <img src="img_avatar2.png" alt="Registration Form for student" class="avatar">
    </div>

    <div class="container">

      <label for="s_name"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="s_name" required>

      <label for="s_uname"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="s_uname" required>

      <label for="s_ename"><b>Email @ Address</b></label>
      <input type="text" placeholder="Enter User Email @ address" name="s_ename" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="s_psw1" required>

      <label for="psw"><b>Confarm Password</b></label>
      <input type="password" placeholder="Enter Password" name="s_psw2" required>
        
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


<div id="id03" class="modal1">
  
  <form class="modal-content animate" action="" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id03').style.display='none'" class="close" title="Close Modal">&times;</span>
      <img src="img_avatar2.png" alt="Registration Form" class="avatar">
    </div>

    <div class="container">
      <label for="o_uname"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="o_uname" required>

      <label for="o_ename"><b>Email @ Address</b></label>
      <input type="text" placeholder="Enter User Email @ address" name="o_ename" required>

      <label for="o_house"><b>House/Building Name</b></label>
      <input type="text" placeholder="Enter House/Building Name" name="o_house" required>

      <label for="o_floor"><b>Number of floors</b></label>
      <input type="text" placeholder="Number of floors" name="o_floor" required>

      <label for="o_room"><b>No of rooms in each floor</b></label>
      <input type="text" placeholder="No of rooms in each floor" name="o_room" required>

      <label for="o_psw1"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="o_psw1" required>

      <label for="o_psw2"><b>Confarm Password</b></label>
      <input type="password" placeholder="Enter Password" name="o_psw2" required>
        
      <input type="submit" name="submit3" value="Register">
      <label>
        <input type="checkbox" checked="checked" name="remember"> Remember me
      </label>
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id03').style.display='none'" class="cancelbtn">Cancel</button>
      <span class="psw">Forgot <a href="#">password?</a></span>
    </div>
  </form>
</div>


<div id="id04" class="modal1">
  
  <form class="modal-content animate" action="" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id04').style.display='none'" class="close" title="Close Modal">&times;</span>
      <img src="img_avatar2.png" alt="Registration Form" class="avatar">
    </div>

    <div class="container">
      <label for="a_uname"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="a_uname" required>

      <label for="a_ename"><b>Email @ Address</b></label>
      <input type="text" placeholder="Enter User Email @ address" name="a_ename" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="a_psw1" required>

      <label for="psw"><b>Confarm Password</b></label>
      <input type="password" placeholder="Enter Password" name="a_psw2" required>
        
      <input type="submit" name="submit4" value="Register">
      <label>
        <input type="checkbox" checked="checked" name="remember"> Remember me
      </label>
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id04').style.display='none'" class="cancelbtn">Cancel</button>
      <span class="psw">Forgot <a href="#">password?</a></span>
    </div>
  </form>
</div>





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


    var flag = "<?php echo $_SESSION['loginflag']; ?>";

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


</body>
</html>