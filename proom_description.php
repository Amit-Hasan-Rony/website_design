<?php
 session_start();
  $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "project";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

 $a=$_GET['id'];
 $floor_room="";
 $b="";$c="";
 $flag=0;

 list($b,$c)=explode('.', $a);// determining the room number..........................................................
 $floor_room=$b.$c;
 $_SESSION['floor_room']=$floor_room;//save floor_room in the session veriable..........................

 $a=$_SESSION['building_name_table'];
 //$a="osthayee_nibash";
 $table_name="";
 for ($i=0; $i <strlen($a) ; $i++) { 
 	if($a[$i]==' ')
 		$table_name=$table_name."_";            //removing space from building name...............................
 	else
 		$table_name=$table_name.$a[$i];
 }

 
 $sql="SELECT * FROM $table_name WHERE floor_room='$floor_room'";
 
 $result=mysqli_query($conn,$sql);

 $number_student=0;

 $r_image=NULL;
 $s1_image=NULL;
 $s2_image=NULL;
 $number_student=NULL;
 $r_des=NULL;
 $r_rent=NULL;

 if (mysqli_num_rows($result) > 0) {
          while($row = mysqli_fetch_assoc($result)) {
               $number_student=$row['room_flag'];
               $r_des=$row['room_description'];
               $r_image=$row['room_image'];
               $room_rent=$row['room_rent'];
               $s1_name=$row['student1_name'];
               $s1_home=$row['student1_home'];
               $s1_contact=$row['student1_contact'];
               $s1_image=$row['student1_image'];
               $s2_name=$row['student2_name'];
               $s2_home=$row['student2_home'];
               $s2_contact=$row['student2_contact'];
               $s2_image=$row['student2_image'];
               break;
          }
      }

  if($number_student==0){
      $color_flag="green";
  }else if($number_student==1){
  	  $color_flag="yellow";
  }else if($number_student==2){
       $color_flag="red";
  }


  if($number_student==NULL)$number_student=0;
  if($r_des==NULL)$r_des=$r_des="Room Description is not Available";
  if($r_rent==NULL)$r_rent="0000";

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
  if(!empty($_POST['booking_button'])){
    header("Location: pbooking_form.php");
  }

  //Code for room_update Button.............................................................................................
  if(!empty($_POST['update_room_information'])){
  	header("Location: proom_update.php");
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
		.greenroom_content{
			margin-left: 200px;background: green;color: black;height: 700px;width: 900px;display: block;visibility: hidden;margin-top: 20px;
		}

		.greenroom_information{
			margin-left: 30px;background: red;color: black;height: 400px;width: 390px;display: block;float: left;margin-top: 50px;
		}

		.greenroom_update_division{
			margin-left: 345px;background: red;color: black;height: 70px;width: 250px;display: block;float: left;margin-top: 30px;
		}

		.greenroom_picture{
			margin-left: 50px;background: red;color: black;height: 400px;width: 350px;display: block;float: right;margin-top: 50px;margin-right: 50px;
		}

		.yellowroom_content{
			margin-left: 200px;background: green;color: black;height: 1290px;width: 900px;display: block;visibility: visible;margin-top: -650px;position: absolute;
		}

		.yellowroomr_infromation{
			margin-left: 50px;background: red;color: black;height: 400px;width: 390px;display: block;float: left;margin-top: 50px;
		}

		.yellowroom_picture{
			margin-left: 50px;background: red;color: black;height: 400px;width: 350px;display: block;float: right;margin-top: 50px;margin-right: 50px;
		}

		.yellowroom_update_division{
			margin-left: 345px;background: red;color: black;height: 70px;width: 250px;display: block;float: left;margin-top: 30px;
		}

		.yellowroomr_student_infromation{
			margin-left: 50px;background: red;color: black;height: 400px;width: 390px;display: block;float: left;margin-top: 160px;
		}

		.yellowroom_student_picture{
			margin-left: 50px;background: red;color: black;height: 400px;width: 350px;display: block;float: right;margin-top: 160px;margin-right: 50px;
		}

		.redroom_content{
			margin-left: 200px;background: green;color: black;height: 1900px;width: 900px;display: block;visibility: hidden;margin-top: -600px;position: absolute;
		}

		.redroom_infromation{
			margin-left: 50px;background: red;color: black;height: 400px;width: 390px;display: block;float: left;margin-top: 50px;
		}

		.redroom_picture{
			margin-left: 50px;background: red;color: black;height: 400px;width: 350px;display: block;float: right;margin-top: 50px;margin-right: 50px;
		}

		.redroom_update_division{
            margin-left: 345px;background: red;color: black;height: 70px;width: 250px;display: block;float: left;margin-top: 30px;
		}

		.redroomr_student_infromation{
            margin-left: 50px;background: red;color: black;height: 400px;width: 390px;display: block;float: left;margin-top: 160px;
		}

		.redroom_student_picture{
            margin-left: 50px;background: red;color: black;height: 400px;width: 350px;display: block;float: right;margin-top: 160px;margin-right: 50px;
		}

		.redroomr_student_infromation2{
            margin-left: 50px;background: red;color: black;height: 400px;width: 390px;display: block;float: left;margin-top: 160px;
		}

		.redroom_student_picture2{
            margin-left: 50px;background: red;color: black;height: 400px;width: 350px;display: block;float: right;margin-top: 160px;margin-right: 50px;
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
    <ul id="aaa" style="margin-left: 1003px; position: absolute; visibility: visible; margin-top: -96px;padding-top: 37px;list-style: none;">
        <li  class="b"><input type="submit" name="booking_button" value="Book Room" style="width:auto;padding: 19px 21px 18px 20px;background: #3366CC;"></li>
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

	<div class="greenroom_content" id="student_division">

		<div class="update_button_class" id="update_button_id">
			<p><strong><i style="margin-left: 330px;">If you want to update Room Information</i></strong></p>
		    <form action="" method="post">
			     <input type="submit" name="update_room_information" value="Click Me" style="margin-left: 425px;">
		    </form>
		</div>
		
		<h2 style="margin-left: 370px;margin-top: 20px;"><strong><i>Room Information</i></strong></h2>

		<div class="greenroom_information">
			<p style="margin-top: 60px;margin-left: 85px;"><strong><i>Room Description and Facilities:</i></strong></p>
			<P style="margin-left: 35px;"><strong><i><?php echo $r_des; ?></i></strong></p>
		</div>

		<div class="greenroom_picture">
			<?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $r_image).'" style="margin-left: 30px;margin-top: 70px;" width="280px" height="250px"/>'; ?>"
		</div>

		<div class="greenroom_update_division">
			<p style="margin-left: 55px;margin-top: 25px;"><strong>rent cost :<?php echo $r_rent; ?></strong></p>			
		</div>

	</div>




	<div class="yellowroom_content" id="owner_division">

		<div class="update_button_class" id="update_button_id">
			<p><strong><i style="margin-left: 330px;">If you want to update Room Information</i></strong></p>
		    <form action="" method="post">
			     <input type="submit" name="update_room_information" value="Click Me" style="margin-left: 425px;">
		    </form>
		</div>

		<h2 style="margin-left: 370px;margin-top: 20px;"><strong><i>Room Information</i></strong></h2>
		<div class="yellowroomr_infromation">
			<p style="margin-top: 60px;margin-left: 85px;"><strong><i>Room Description and Facilities:</i></strong></p>
			<P style="margin-left: 35px;"><strong><i><?php echo $r_des; ?></i></strong></p>
		</div>

		<div class="yellowroom_picture">
			 <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $r_image).'" style="margin-left: 30px;margin-top: 70px;" width="280px" height="250px"/>'; ?>"
		</div>

		<div class="yellowroom_update_division">
			<p style="margin-left: 55px;margin-top: 25px;"><strong>rent cost :3000TK</strong></p>
		</div>

		<h2 style="margin-left: 377px;margin-top: 646px;position: absolute;"><strong><i>Renter Information</i></strong></h2>

		<div class="yellowroomr_student_infromation">
			<P style="margin-top: 60px;margin-left: 35px;"><strong><i>Student UserName: <?php echo $s1_name;  ?></i></strong></p>
			<p style="margin-left: 35px;"><strong><i>Student Email:    <?php echo $s1_name;  ?></i></strong></p>
			<p style="margin-left: 35px;"><strong><i>Student Contact:  <?php echo $s1_contact;  ?></i></strong></p>
			<p style="margin-left: 35px;"><strong><i>Student Address:  <?php echo $s1_home;  ?></i></strong></p>
		</div>

		<div class="yellowroom_student_picture">
			 <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $s1_image).'" style="margin-left: 30px;margin-top: 70px;" width="280px" height="250px"/>'; ?>"
		</div>
	</div>


    

	<div class="redroom_content" id="admin_division">

		<div class="update_button_class" id="update_button_id">
			<p><strong><i style="margin-left: 330px;">If you want to update Room Information</i></strong></p>
		    <form action="" method="post">
			     <input type="submit" name="update_room_information" value="Click Me" style="margin-left: 425px;">
		    </form>
		</div>

		<h2 style="margin-left: 370px;margin-top: 20px;"><strong><i>Room Information</i></strong></h2>
		<div class="redroom_infromation">
			<p style="margin-top: 60px;margin-left: 85px;"><strong><i>Room Description and Facilities:</i></strong></p>
			<P style="margin-left: 35px;"><strong><i><?php echo $r_des; ?></i></strong></p>
		</div>

		<div class="redroom_picture">
			<?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $r_image).'" style="margin-left: 30px;margin-top: 70px;" width="280px" height="250px"/>'; ?>"
		</div>

		<div class="redroom_update_division">
			<p style="margin-left: 55px;margin-top: 25px;"><strong>rent cost :3000TK</strong></p>
		</div>

		<h2 style="margin-left: 377px;margin-top: 616px;position: absolute;"><strong><i>Renter Information</i></strong></h2>
		<h2 style="margin-left: 410px;margin-top: 666px;position: absolute;"><strong><i>Student One</i></strong></h2>

		<div class="redroomr_student_infromation">
			<P style="margin-top: 60px;margin-left: 35px;"><strong><i>Student UserName: <?php echo $s1_name;  ?></i></strong></p>
			<p style="margin-left: 35px;"><strong><i>Student Email:    <?php echo $s1_name;  ?></i></strong></p>
			<p style="margin-left: 35px;"><strong><i>Student Contact:  <?php echo $s1_contact;  ?></i></strong></p>
			<p style="margin-left: 35px;"><strong><i>Student Address:  <?php echo $s1_home;  ?></i></strong></p>
		</div>

		<div class="redroom_student_picture">
			 <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $s1_image).'" style="margin-left: 30px;margin-top: 70px;" width="280px" height="250px"/>'; ?>"
		</div>
         
        <h2 style="margin-left: 420px;margin-top: 1199px;position: absolute;"><strong><i>Student Two</i></strong></h2>
		<div class="redroomr_student_infromation2">
			<P style="margin-top: 60px;margin-left: 35px;"><strong><i>Student UserName: <?php echo $s2_name;  ?></i></strong></p>
			<p style="margin-left: 35px;"><strong><i>Student Email:    <?php echo $s2_name;  ?></i></strong></p>
			<p style="margin-left: 35px;"><strong><i>Student Contact:  <?php echo $s2_contact;  ?></i></strong></p>
			<p style="margin-left: 35px;"><strong><i>Student Address:  <?php echo $s2_home;  ?></i></strong></p>
		</div>

		<div class="redroom_student_picture2">
			 <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $s2_image).'" style="margin-left: 30px;margin-top: 70px;" width="280px" height="250px"/>'; ?>"
		</div>

	</div>



	<script type="text/javascript">
		var meno_flag="<?php echo $_SESSION['loginflag'] ?>"
		var division_flag="<?php echo $number_student; ?>";
		var c_type="<?php echo $_SESSION['c_type']; ?>";
		var building_name="<?php echo $_SESSION['house_name']; ?>";
		var user_building="<?php echo $_SESSION['building_name_table']; ?>";
		if(meno_flag=="true"){
			document.getElementById("aaa").style.visibility="visible";
			document.getElementById("aa").style.visibility="visible";
			document.getElementById("ab").style.visibility="visible";
			document.getElementById("login_button").style.visibility="hidden";
			document.getElementById("register_button").style.visibility="hidden";
		}else{
			document.getElementById("aaa").style.visibility="hidden";
			document.getElementById("aa").style.visibility="hidden";
			document.getElementById("ab").style.visibility="hidden";
			document.getElementById("login_button").style.visibility="visible";
			document.getElementById("register_button").style.visibility="visible";
		}
		if(c_type=="Mess_Owner" && building_name==user_building){
			document.getElementById("update_button_id").style.visibility="visible";
		}else{
            document.getElementById("update_button_id").style.visibility="hidden";
		}
		if(division_flag==0){
			document.getElementById("student_division").style.visibility="visible";
			document.getElementById("owner_division").style.visibility="hidden";
			document.getElementById("admin_division").style.visibility="hidden";
			alert("this is inside the green divition");
		}else if(division_flag==1){
			document.getElementById("student_division").style.visibility="hidden";
			document.getElementById("owner_division").style.visibility="visible";
			document.getElementById("admin_division").style.visibility="hidden";
			alert("this is inside the yellow divition");
		}else {
			document.getElementById("student_division").style.visibility="hidden";
			document.getElementById("owner_division").style.visibility="hidden";
			document.getElementById("admin_division").style.visibility="visible";
			alert("this is inside the red divition");
		}
	</script>

</body>
</html>
