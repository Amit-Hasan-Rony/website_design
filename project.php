<?php
session_start();
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

    $loginflag="true";
    $_SESSION['loginflag']=$loginflag;
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

    //code for email check...........................................................

    if($pass1===$pass2 &&(strpos($email, "@gmail.com")||strpos($email, "@yeahoo.com"))){
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

  if(!empty($_POST['logout_button'])){
    $_SESSION['loginflag']="false";
  }

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