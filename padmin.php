<?php
   session_start();
   $c_type=$_SESSION['c_type'];
   $a="";

   if($c_type=='Student'){
      
      //information for student login type.................................................................................................
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "project";
   
      $conn = mysqli_connect($servername, $username, $password, $dbname);
      $s_user=$_SESSION['username'];
      $s_pass=$_SESSION['password'];
      
      $sql="SELECT * FROM student_table WHERE student_user_name='$s_user' AND student_password='$s_pass'";

      $result = mysqli_query($conn, $sql);

       if (mysqli_num_rows($result) > 0) {
          while($row = mysqli_fetch_assoc($result)) {
          	   $a=$row["student_name"];
          	   $b=$row["student_email"];
               $c=$row["building_name"];
               $d=$row["buildin_floor_no"];
               $e=$row["id"];
               $f=$row["student_contact"];
               $s_image=$row["student_image"];
          }
          $_SESSION['id']=$e;
       }

   }else if($c_type=='Mess_Owner'){
      
      //information for Owner login type...................................................................................................
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "project";
   
      $conn = mysqli_connect($servername, $username, $password, $dbname);
      $o_user=$_SESSION['username'];
      $o_pass=$_SESSION['password'];

      $sql="SELECT * FROM owner_table WHERE owner_name='$o_user' AND password='$o_pass'";

      $result = mysqli_query($conn, $sql);

      if (mysqli_num_rows($result) > 0) {
          while($row = mysqli_fetch_assoc($result)) {
               $a=$row["email_id"];
               $b=$row["owner_contact"];
               $c=$row["id"];
               $d=$row["building_name"];
               $e=$row["owner_address"];
               $o_image=$row["owner_image"];
          }
          $_SESSION['id']=$c;
      }

   }else{

      //information for Admin login type...................................................................................................
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "project";
   
      $conn = mysqli_connect($servername, $username, $password, $dbname);
      $o_user=$_SESSION['username'];
      $o_pass=$_SESSION['password'];

      $sql="SELECT * FROM admin_table WHERE admin_name='$o_user' AND password='$o_pass'";

      $result = mysqli_query($conn, $sql);

      if (mysqli_num_rows($result) > 0) {
          while($row = mysqli_fetch_assoc($result)) {
          	   $a=$row["admin_name"];
               $b=$row["email_id"];
               $d=$row["password"];
               $e=$row["admin_contact"];
               $c=$row["id"];
               $a_image=$row['admin_image'];
          }
          $_SESSION['id']=$c;
      }
   }

?>

<?php 
   
   //this is for update button..................................................................................................................
   if(!empty($_POST['s_change_button'])){
       header("Location: padmin_update.php");
   }else if(!empty($_POST['o_change_button'])){
      header("Location: padmin_update.php");
   }else if(!empty($_POST['a_change_button'])){
   	  header("Location: padmin_update.php");
   }


   //This is for owner confarmation button for admin ..............................................................................................
   if(!empty($_POST['confarm_button'])){
      header("Location: powner_confarm.php");
   }


   //this is for Myprofile Button................................................................................................................
   if(!empty($_POST['profile_button'])){
      //header("Location: padmin.php")
   }

   //this is for Logout button...................................................................................................................
   if(!empty($_POST['logout_button'])){
        $_SESSION['loginflag']="false";
        header("Location: pproject.php");
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

<!DOCTYPE html>
<html>
<head>
	<title>This is My Profile Page</title>
	<link rel="stylesheet" type="text/css" href="project.css">
	<style type="text/css">
	    body{
	    	background: black;display: block;
	    }
		.student_content{
			margin-left: 200px;background: green;color: black;height: 600px;width: 900px;display: block;visibility: hidden;margin-top: 20px;
		}

		.student_information{
			margin-left: 50px;background: red;color: black;height: 400px;width: 390px;display: block;float: left;margin-top: 90px;
		}

		.student_picture{
			margin-left: 50px;background: red;color: black;height: 400px;width: 350px;display: block;float: right;margin-top: 90px;margin-right: 50px;
		}

		.owner_content{
			margin-left: 200px;background: green;color: black;height: 600px;width: 900px;display: block;visibility: hidden;margin-top: -600px;position: absolute;
		}

		.owner_infromation{
			margin-left: 50px;background: red;color: black;height: 400px;width: 390px;display: block;float: left;margin-top: 100px;
		}

		.owner_picture{
			margin-left: 50px;background: red;color: black;height: 400px;width: 350px;display: block;float: right;margin-top: 100px;margin-right: 50px;
		}

		.admin_content{
			margin-left: 200px;background: green;color: black;height: 600px;width: 900px;display: block;visibility: hidden;margin-top: -600px;position: absolute;
		}

		.admin_infromation{
			margin-left: 50px;background: red;color: black;height: 400px;width: 390px;display: block;float: left;margin-top: 100px;
		}

		.admin_picture{
			margin-left: 50px;background: red;color: black;height: 400px;width: 350px;display: block;float: right;margin-top: 100px;margin-right: 50px;
		}

	</style>
</head>
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

		</ul>
	</div>


  <form action="" method="post">
    <ul id="aaa" style="margin-left: 1017px; position: absolute; visibility: visible; margin-top: -96px;padding-top: 37px;list-style: none;">
        <li  class="b"><input type="submit" name="confarm_button" value="Confarm" style="width:auto;padding: 19px 21px 18px 20px;background: #3366CC;"></li>
    </ul>
  </form>

  <form action="" method="post">
    <ul id="aa" style="margin-left: 1113px; position: absolute; visibility: visible; margin-top: -96px;padding-top: 37px;list-style: none;">
        <li  class="b"><input type="submit" name="profile_button" value="My Profile" style="width:auto;padding: 19px 21px 18px 20px;background: #3366CC;"></li>
    </ul>
  </form>

  <form action="" method="post">
    <ul id="ab" style="margin-left: 1202px; position: absolute; visibility: visible; margin-top: -96px;padding-top: 37px;list-style: none;">
        <li  class="b"><input type="submit" name="logout_button" value="Logout" style="width:auto; margin-left: 13px;padding: 19px 21px 18px 20px;background: #3366CC;"></li>
    </ul>
  </form>

	<div class="student_content" id="student_division">
		<div class="student_information">
			<p style="margin-top: 60px;margin-left: 35px;"><strong><i>Student Name:     <?php echo "$a";  ?></i></strong></p>
			<P style="margin-left: 35px;"><strong><i>Student UserName: <?php echo "$s_user";  ?></i></strong></p>
			<p style="margin-left: 35px;"><strong><i>Student Email:    <?php echo "$b";  ?></i></strong></p>
			<p style="margin-left: 35px;"><strong><i>Student Password: <?php echo "$s_pass";  ?></i></strong></p>
			<p style="margin-left: 35px;"><strong><i>Student Contact:  <?php echo "$f";  ?></i></strong></p>
			<p style="margin-left: 35px;"><strong><i>Student Building Name:   <?php echo "$c";  ?></i></strong></p>
			<p style="margin-left: 35px;"><strong><i>Floor No:   <?php echo "$d"; ?></i></strong></p>
			<p style="margin-left: 35px;"><strong><i>Room No:    <?php echo "$d"; ?></i></strong></p>
		</div>

		<div class="student_picture">
			<?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $s_image).'" style="margin-left: 30px;margin-top: 70px;" width="280px" height="250px"/>'; ?>"
		</div>

		<div class="s_update_division">
			<p style="margin-left: 300px;"><strong>If you want to change your Information</strong></p>
			<form action="" method="post" style="margin-left: 400px; margin-top: 20px;">
				<input type="submit" name="s_change_button" value="Click Me">
			</form>
		</div>

	</div>

	<div class="owner_content" id="owner_division">
		<div class="owner_infromation">
			<P style="margin-top: 60px;margin-left: 35px;"><strong><i>Owner UserName: <?php echo "$o_user";  ?></i></strong></p>
			<p style="margin-left: 35px;"><strong><i>Owner Email:    <?php echo "$a";  ?></i></strong></p>
			<p style="margin-left: 35px;"><strong><i>Owner Password: <?php echo "$o_pass";  ?></i></strong></p>
			<p style="margin-left: 35px;"><strong><i>Owner Contact:  <?php echo "$b";  ?></i></strong></p>
			<p style="margin-left: 35px;"><strong><i>Owner Address:  <?php echo "$e";  ?></i></strong></p>
			<p style="margin-left: 35px;"><strong><i>Owner Building Name   <?php echo "$d";  ?></i></strong></p>
		</div>

		<div class="owner_picture">
			 <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $o_image).'" style="margin-left: 30px;margin-top: 70px;" width="280px" height="250px"/>'; ?>"
		</div>

		<div class="o_update_division">
			<p style="margin-left: 300px;margin-top: 100px;"><strong>If you want to change your Information</strong></p>
			<form action="" method="post" style="margin-left: 400px; margin-top: 20px;">
				<input type="submit" name="o_change_button" value="Click Me">
			</form>
		</div>
	</div>

	<div class="admin_content" id="admin_division">
		<div class="admin_infromation">
			<P style="margin-top: 125px;margin-left: 35px;"><strong><i>Admin UserName: <?php echo "$a";  ?></i></strong></p>
			<p style="margin-left: 35px;"><strong><i>Admin Email:    <?php echo "$b";  ?></i></strong></p>
			<p style="margin-left: 35px;"><strong><i>Admin Password: <?php echo "$d";  ?></i></strong></p>
			<p style="margin-left: 35px;"><strong><i>Admin Contact:  <?php echo "$e";  ?></i></strong></p>
		</div>

		<div class="admin_picture">
			<?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $a_image).'" style="margin-left: 30px;margin-top: 70px;" width="280px" height="250px"/>'; ?>"
		</div>

		<div class="a_update_division">
			<p style="margin-left: 300px;margin-top: 100px;"><strong>If you want to change your Information</strong></p>
			<form action="" method="post" style="margin-left: 400px; margin-top: 20px;">
				<input type="submit" name="a_change_button" value="Click Me">
			</form>
		</div>

	</div>

	<script type="text/javascript">
		var division_flag="<?php echo $c_type; ?>";
		if(division_flag=="Student"){
			document.getElementById("student_division").style.visibility="visible";
			document.getElementById("owner_division").style.visibility="hidden";
			document.getElementById("admin_division").style.visibility="hidden";
			alert("this is inside the stuent divition");
		}else if(division_flag=="Mess_Owner"){
			document.getElementById("student_division").style.visibility="hidden";
			document.getElementById("owner_division").style.visibility="visible";
			document.getElementById("admin_division").style.visibility="hidden";
			alert("this is inside the owner divition");
		}else{
			document.getElementById("student_division").style.visibility="hidden";
			document.getElementById("owner_division").style.visibility="hidden";
			document.getElementById("admin_division").style.visibility="visible";
		}
	</script>

</body>
</html>