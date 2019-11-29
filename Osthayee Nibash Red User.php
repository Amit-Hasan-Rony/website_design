
<?php

session_start();
if(!empty($_POST['logout_button'])){
  $_SESSION['loginflag']="false";
  header("Location:Osthayee Nibash.php");
}

//code for myprofile button............................

?>


<?php
///this is for login ............................................................................................
if(!empty($_POST['submit1'])){

  $name=$_POST['uname'];
  $pass=$_POST['psw'];

  $savevalue=get_information($name,$pass);
 
  $_SESSION['loginflag']="false";

  if($savevalue=="null"){
   $_SESSION['flag']="lno";
   header("Location: registration.php");
  }else {
    $_SESSION['username']=$savevalue["name"];
    $_SESSION['password']=$savevalue['password'];

    $login_flag="true";
    $_SESSION['loginflag']=$login_flag;
    header("Location:Osthayee Nibash.php");
  }
}

function get_information($n,$p){
  $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "amit";

    $name="'".$n."'";
    $pass="'".$p."'";

    $conn = mysqli_connect($servername, $username, $password, $dbname);
  $sql="SELECT * FROM ltable WHERE username=$name AND password=$pass";


    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
      while($row = mysqli_fetch_assoc($result)) {
        $a=$row["username"];
        $b=$row["password"];
        $save= array('name' =>$a,
                     'password' =>$b );
      }
      return $save;
    }else {
      return "null";
    }
}

?>


<?php
//this is for registration.................................................................................................................................

if(!empty($_POST['submit2'])){
  $name=$_POST['uname'];
  $email=$_POST['ename'];
  $house=$_POST['house'];
  $pass1=$_POST['psw1'];
  $pass2=$_POST['psw2'];
  
  insert_function($name,$email,$house,$pass1,$pass2);
}else{
  
}

function insert_function($name,$email,$house,$pass1,$pass2){
  $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "amit";

    $name="'".$name."'";
    $email="'".$email."'";
    $house="'".$house."'";
    $pass1="'".$pass1."'";
    $pass2="'".$pass2."'";

    if($pass1===$pass2){
          $conn = mysqli_connect($servername, $username, $password, $dbname);


          $sql="INSERT INTO ltable(username,email_id,house_name,password)VALUES($name,$email,$house,$pass2)";

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

    $floor_room=$_GET['id'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "amit";

    $floor_room="'".$floor_room."'";

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    $sql="SELECT * FROM osthayee_room WHERE floor_room=$floor_room";


    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {

      $row = mysqli_fetch_assoc($result);
      $room_description=$row['room_description'];
      $room_facilities=$row['room_facilities'];
      $room_image=$row['room_image'];
      $room_rent=$row['room_rent'];
      $student_name=$row['student_name'];
      $student_home=$row['student_home'];
      $student_contact=$row['student_contact'];
      $student_image=$row['student_image'];

    }else {
      // Green page but still don't have nessery data..............................................................................
    }


?>




<!DOCTYPE html>
<html>
<head>
	<title>Osthayee Nibash Green User</title>
	<link rel="stylesheet" type="text/css" href="project.css">
	<style type="text/css">
		body{
			background-color: #018B67;
		}

    .student_information{
      width: 100%;height: 350px;background: #826145;display: block;overflow: hidden;
    }

    .s_information{
      width: 50%;height: 350px;background: #826145;display: block;overflow: hidden;float: left;margin-left: 170px;position: absolute;margin-top: 136px;
    }
    .student_image{
      width: 50%;height: 350px;background: #826145;display: block;overflow: hidden;float: right;position: absolute;margin-left: 658px;
    }

		.main_content{
			width: 100%;height: 400px;background: #826145;display: block;overflow: hidden;
		}

		.description{
            width: 50%;height: 400px;background: #826145;display: block;overflow: hidden;float: left;
		}
		.room_image{
            width: 50%;height: 400px;background: #826145;display: block;overflow: hidden;float: right;
		}
		.room_facilities{
            width: 100%;height: 400px;background: #826145;display: block;overflow: hidden;
		}
		.cost_owner{
            width: 100%;height: 400px;background: #826145;display: block;overflow: hidden;
		}
		.room_cost{
            width: 50%;height: 400px;background: #826145;display: block;overflow: hidden;float: left;
          }
		.owner_information{
            width: 50%;height: 400px;background: #826145;display: block;overflow: hidden;float: right;
          }

	</style>
</head>
<body>
    
    <div class="login">
		<ul>
			<li><a href="project.php">Home</a></li>
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


    <div class="student_information">
      <h2 style="margin-left: 152px;margin-top: 54px;position: absolute;">Here is the Student Information</h2>
      <div class="s_information">
        <h2>Name:<?php echo $student_name; ?></h2>
        <h2>Home Town:<?php echo $student_home; ?></h2>
        <h2>Contact Number:<?php echo $student_contact; ?></h2>
      </div>

      <div class="student_image">
        <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $student_image).'" style="margin-left: 190px;margin-top: 65px;" width="300px" height="250px"/>'; ?>" 
      </div>
    </div>

    <div class="main_content">
    	
        <div class="description">
        	<h2 style="margin-top: 125px;margin-left: 115px;">This is the room description</h2>
        	<p style="width: 70%;margin-left: 43px"> <?php echo $room_description; ?> </p>
        </div>

        <div class="room_image">
        	<h2 style="margin-top: 555px;position: absolute;margin-left: 257px;">This is the room Image</h2>
        	<?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $room_image).'" style="margin-left: 180px;margin-top: 165px;position: absolute;" width="400px" height="375px"/>'; ?>" 
        </div>

    </div>

    <div class="room_facilities">
    	<h2 style="margin-left: 150px;margin-top: 100px;">This is the room Facilities</h2>
    	<p style="width: 40%;margin-left: 40px"> <?php echo $room_facilities; ?></p>
    </div>

    <div class="cost_owner">
    	<div class="room_cost">
    		<h2 style="margin-left: 75px;margin-top: 26px;">this is the cost for the selected room.</h2>
    		<h2 style="margin-left: 203px;color: red"><?php echo $room_rent; ?></h2>
    	</div>

    	<div class="owner_information">
    		<h2 style="margin-left: 179px;margin-top: 5px;position: absolute;">This is the owner Information</h2>
    		<p style="margin-left: 247px;margin-top: 39px;position: absolute;">Name:<?php echo $student_name; ?></p>
    		<p style="margin-left: 244px;margin-top: 74px;position: absolute;">Contact No:<?php echo $student_home; ?></p>
    		<p style="margin-left: 105px;position: absolute;margin-top: 111px;">Address:House E2/2 B.M.T.F Residential Area, Gazipur Shadar,Gazipur-1703</p>
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
      <img src="img_avatar2.png" alt="registration Form" class="avatar">
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

<script type="text/javascript">
	
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
     alert("Hello! I am an alert box!!");
</script>

</body>
</html>