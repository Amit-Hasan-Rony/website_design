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
               $c=$row["student_user_name"];
               $d=$row["student_password"];
               $e=$row["student_contact"];
               $f=$row["building_name"];
               $g=$row["buildin_floor_no"];
               $h=$row["id"];
               $s_image=$row["student_image"];
          }
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
               $id=$row['id'];
               $a=$row['owner_name'];
               $b=$row['email_id'];
               $c=$row['password'];
               $d=$row['owner_contact'];
               $e=$row['owner_address'];
               $f=$row['building_name'];
               $o_image=$row['owner_image'];

          }
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
               $id=$row['id'];
               $a=$row['admin_name'];
               $b=$row['email_id'];
               $c=$row['password'];
               $d=$row['admin_contact'];
               $a_image=$row['admin_image'];
          }
      }
   }

?>

<?php 
   
   //this is for update button..................................................................................................................
   if(!empty($_POST['s_udpate_button'])){
       //update code for student table..........................................................................................................
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "project";
   
      $conn = mysqli_connect($servername, $username, $password, $dbname);

      $id=$_SESSION['id'];
      $a=$_POST['s_name'];
      $b=$_POST['s_email'];
      $c=$_POST['s_username'];
      $d=$_POST['s_password'];
      $e=$_POST['s_contact'];


      $tin=$_FILES['pic3']['tmp_name'];
      $cou=strlen($tin);

      //code for image...........................................................................................................................
      if($cou>3){
        $image=addslashes(file_get_contents($_FILES['pic3']['tmp_name']));
        $image_size=getimagesize($_FILES['pic3']['tmp_name']);
      }else{
        $image=NULL;
      }
      
      if($image==NULL){
        $sql="UPDATE student_table SET student_name='$a',student_email='$b',student_user_name='$c',student_password='$d',student_contact='$e' WHERE id=$id";
      }else{
         $sql="UPDATE student_table SET student_name='$a',student_email='$b',student_user_name='$c',student_password='$d',student_contact='$e',student_image='$image' WHERE id=$id"; 
      }
      
      if(mysqli_query($conn,$sql)){
      	//echo "Student table is successfully updated";
        $_SESSION['username']=$c;
        $_SESSION['password']=$d;
        header("Location: padmin_update.php");
      }else{
      	//echo "Something wrong with the update";
      }


   }else if(!empty($_POST['o_update_button'])){
      //update code for owner table...........................................................................................................
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "project";
   
      $conn = mysqli_connect($servername, $username, $password, $dbname);
      
      $id=$_SESSION['id'];
      $a=$_POST['o_username'];
      $b=$_POST['o_email'];
      $c=$_POST['o_password'];
      $d=$_POST['o_contact'];
      $e=$_POST['o_address'];
      $f=$_POST['o_building_name'];

      $tin=$_FILES['pic2']['tmp_name'];
      $cou=strlen($tin);

      //code for image...........................................................................................................................
      if($cou>3){
        $image=addslashes(file_get_contents($_FILES['pic2']['tmp_name']));
        $image_size=getimagesize($_FILES['pic2']['tmp_name']);
      }else{
        $image=NULL;
      }
      
      if($image==NULL){
        $sql="UPDATE owner_table SET owner_name='$a',email_id='$b',password='$c',building_name='$f',owner_contact='$d',owner_address='$e' WHERE id=$id";
      }else{
        $sql="UPDATE owner_table SET owner_name='$a',email_id='$b',password='$c',building_name='$f',owner_contact='$d',owner_address='$e',owner_image='$image' WHERE id=$id";
      }
      
      if(mysqli_query($conn,$sql)){
      	//echo "owner table is successfully updated";
        $_SESSION['username']=$a;
        $_SESSION['password']=$c;
        header("Location: padmin_update.php");
      }else{
      	//echo "Something wrong with the update";
      }


   }else if(!empty($_POST['a_update_button'])){
   	  //update code for admin table............................................................................................................
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "project";
   
      $conn = mysqli_connect($servername, $username, $password, $dbname);

      $id=$_SESSION['id'];
      $a=$_POST['a_user_name'];
      $b=$_POST['a_email'];
      $c=$_POST['a_password'];
      $d=$_POST['a_contact'];

      $tin=$_FILES['pic1']['tmp_name'];
      $cou=strlen($tin);

      //code for image...........................................................................................................................
      if($cou>3){
        $image=addslashes(file_get_contents($_FILES['pic1']['tmp_name']));
        $image_size=getimagesize($_FILES['pic1']['tmp_name']);
      }else{
        $image=NULL;
      }
      
      if($image==NULL){
         $sql="UPDATE admin_table SET admin_name='$a',email_id='$b',password='$c',admin_contact='$d' WHERE id=$id";
      }else{
         $sql="UPDATE admin_table SET admin_name='$a',email_id='$b',password='$c',admin_contact='$d',admin_image='$image' WHERE id=$id"; 
      }
    
      if(mysqli_query($conn,$sql)){
      	//echo "admin_table table is successfully updated";
        $_SESSION['username']=$a;
        $_SESSION['password']=$c;
        header("Location: padmin_update.php");
      }else{
      	//echo "Something wrong with the update";
      }

   }

   //This is for owner confarmation button for admin ..............................................................................................
   if(!empty($_POST['confarm_button'])){
      header("Location: powner_confarm.php");
   }

   //this is for Myprofile button..................................................................................................................
   if(!empty($_POST['profile_button'])){
      header("Location: padmin.php");
   }

   //this is for Logout button......................................................................................................................
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
	    	background: white;display: block;
	    }
		.student_content{
			margin-left: 200px;background: green;color: black;height: 700px;width: 900px;display: block;visibility: hidden;margin-top: 20px;
		}

		.student_information{
			margin-left: 50px;background: red;color: black;height: 580px;width: 390px;display: block;float: left;margin-top: 10px;
		}

		.student_picture{
			margin-left: 50px;background: red;color: black;height: 400px;width: 350px;display: block;float: right;margin-top: 90px;margin-right: 50px;
		}

		.owner_content{
			margin-left: 200px;background: green;color: black;height: 780px;width: 900px;display: block;visibility: hidden;margin-top: -680px;position: absolute;
		}

		.owner_infromation{
			margin-left: 50px;background: red;color: black;height: 690px;width: 390px;display: block;float: left;margin-top: 15px;
		}

		.owner_picture{
			margin-left: 50px;background: red;color: black;height: 400px;width: 350px;display: block;float: right;margin-top: 160px;margin-right: 50px;
		}

		.admin_content{
			margin-left: 200px;background: green;color: black;height: 650px;width: 900px;display: block;visibility: hidden;margin-top: -680px;position: absolute;
		}

		.admin_infromation{
			margin-left: 50px;background: red;color: black;height: 500px;width: 390px;display: block;float: left;margin-top: 35px;
		}

		.admin_picture{
			margin-left: 50px;background: red;color: black;height: 400px;width: 350px;display: block;float: right;margin-top: 90px;margin-right: 50px;
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
    <ul id="ab" style="margin-left: 1203px; position: absolute; visibility: visible; margin-top: -96px;padding-top: 37px;list-style: none;">
        <li  class="b"><input type="submit" name="logout_button" value="Logout" style="width:auto; margin-left: 13px;padding: 19px 21px 18px 20px;background: #3366CC;"></li>
    </ul>
  </form>

	<div class="student_content" id="student_division">
			<div class="student_information">
            <form action="" method="post" enctype="multipart/form-data">
			           <p style="margin-left: 125px;"><strong><i>Student Name</i></strong></p><input type="text" name="s_name" value="<?php echo $a ?>">
			           <P style="margin-left: 125px;"><strong><i>Student User Name</i></strong></P><input type="text" name="s_username" value="<?php echo $c; ?>">
			           <p style="margin-left: 125px;"><strong><i>Student Email</i></strong></p><input type="text" name="s_email" value="<?php echo $b ;?>">
			           <p style="margin-left: 125px;"><strong><i>Student Password</i></strong></p><input type="text" name="s_password" value="<?php echo $d; ?>">
			           <p style="margin-left: 125px;"><strong><i>Student Contact</i></strong></p><input type="text" name="s_contact" value="<?php echo $e; ?>">
                 <input type="file" name="pic3" style="margin-left: 180px;margin-top: 25px; position: absolute"/><br>
			           <input type="submit" name="s_udpate_button" value="Save Changes" style="margin-left: 365px; margin-top: 85px; position: absolute;">
            </form>
		   </div>
		
		
    <div class="student_picture">
			<?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $s_image).'" style="margin-left: 30px;margin-top: 70px;" width="280px" height="250px"/>'; ?>"
		</div>

	</div>

	<div class="owner_content" id="owner_division">
		<div class="owner_infromation">
			<form action="" method="post" enctype="multipart/form-data">
			  <P style="margin-left: 125px;"><strong><i>Owner UserName</i></strong></p><input type="text" name="o_username" value="<?php echo "$a";  ?>">
			  <p style="margin-left: 125px;"><strong><i>Owner Email:</i></strong></p><input type="text" name="o_email" value="<?php echo "$b";  ?>">
			  <p style="margin-left: 125px;"><strong><i>Owner Password</i></strong></p><input type="text" name="o_password" value="<?php echo "$c";  ?>">
			  <p style="margin-left: 125px;"><strong><i>Owner Contact</i></strong></p><input type="text" name="o_contact" value="<?php echo "$d";  ?>">
			  <p style="margin-left: 125px;"><strong><i>Owner Address</i></strong></p><input type="text" name="o_address" value="<?php echo "$e";  ?>">
			  <p style="margin-left: 125px;"><strong><i>Owner Building Name</i></strong></p><input type="text" name="o_building_name" value="<?php echo "$f"; ?>">
        <input type="file" name="pic2" style="margin-left: 180px;margin-top: -15px; position: absolute"/><br>
			  <input type="submit" name="o_update_button" value="Save Changes" style="margin-left: 360px; margin-top: 65px;position: absolute;">
			</form>
			
		</div>

		<div class="owner_picture">
			<?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $o_image).'" style="margin-left: 30px;margin-top: 70px;" width="280px" height="250px"/>'; ?>"
		</div>

	</div>

	<div class="admin_content" id="admin_division">
		<div class="admin_infromation">
      <form action="" method="post" enctype="multipart/form-data">
			     <P style="margin-left: 125px;"><strong><i>Admin UserName:</i></strong></p><input type="text" name="a_user_name" value="<?php echo $a;  ?>">
			     <p style="margin-left: 125px;"><strong><i>Admin Email:</i></strong></p><input type="text" name="a_email" value="<?php echo $b;  ?>">
			     <p style="margin-left: 125px;"><strong><i>Admin Password:</i></strong></p><input type="text" name="a_password" value="<?php echo $c;  ?>">
			     <p style="margin-left: 125px;"><strong><i>Admin Contact:</i></strong></p><input type="text" name="a_contact" value="<?php echo $d;  ?>">
           <input type="file" name="pic1" style="margin-left: 200px;margin-top: 105px; position: absolute"/><br>
           <input type="submit" name="a_update_button" value="Save Changes" style="margin-left: 363px;margin-top: 122px;">
      </form>
		</div>
        
		<div class="admin_picture">
			
       <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $a_image).'" style="margin-left: 30px;margin-top: 70px;" width="280px" height="250px"/>'; ?>"

		</div>

	</div>

	<script type="text/javascript">
		var division_flag="<?php echo $c_type; ?>";
		if(division_flag=="Student"){
			document.getElementById("student_division").style.visibility="visible";
			document.getElementById("owner_division").style.visibility="hidden";
			document.getElementById("admin_division").style.visibility="hidden";
      document.getElementById("aaa").style.visibility="hidden";
			alert("this is inside the stuent divition");
		}else if(division_flag=="Mess_Owner"){
			document.getElementById("student_division").style.visibility="hidden";
			document.getElementById("owner_division").style.visibility="visible";
			document.getElementById("admin_division").style.visibility="hidden";
      document.getElementById("aaa").style.visibility="hidden";
			alert("this is inside the owner divition");
		}else{
			document.getElementById("student_division").style.visibility="hidden";
			document.getElementById("owner_division").style.visibility="hidden";
			document.getElementById("admin_division").style.visibility="visible";
      document.getElementById("aaa").style.visibility="visible";
      alert("this is inside the admin divition");
		}
	</script>

</body>
</html>