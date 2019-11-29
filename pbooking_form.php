<?php
 session_start();
 //all value from previous page..................................................

?>

<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "project";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    $image=NULL;

    if(!empty($_POST['o_update_button'])){
    	$name=$_POST['o_username'];
        $email=$_POST['o_email'];
        $home=$_POST['o_address'];
        $contact=$_POST['o_contact'];
        $transection=$_POST['transection'];

        $tin=$_FILES['pic2']['tmp_name'];
        $cou=strlen($tin);

        //code for image...........................................................................................................................
        if($cou>3){
           $image=addslashes(file_get_contents($_FILES['pic2']['tmp_name']));
           $image_size=getimagesize($_FILES['pic2']['tmp_name']);
        }else{
           $image=NULL;
        }

        $a=$_SESSION['building_name_table'];
        $table_name="";
        for ($i=0; $i <strlen($a) ; $i++) { 
        	if($a[$i]==" ")
        		$table_name=$table_name."_";
        	else
        		$table_name=$table_name.$a[$i];
        }

        $floor_room=$_SESSION['floor_room'];
        $number_student=0;

        echo $table_name;
        echo $floor_room;

        //here is the code for geting number of room member in the specific room...........................................
        $sql="SELECT * FROM $table_name WHERE floor_room='$floor_room'";
        echo $sql;
        $result=mysqli_query($conn,$sql);
        if(mysqli_num_rows($result)>0){
           while($row = mysqli_fetch_assoc($result)) {
                 $number_student=$row['room_flag'];
                 break;
            }

        }else {
    	   $sql="INSERT INTO $table_name(floor_room)VALUES('$floor_room')";
    	   mysqli_query($conn,$sql);
        }


     


       $sql="SELECT * FROM transection WHERE transection_id='$transection'";
       $result=mysqli_query($conn,$sql);

       $transection_flag=mysqli_num_rows($result);
       if($transection_flag>0){
    	   //insert code into building_table(for a room);
    	   $number_student++;
    	   $sql="UPDATE $table_name SET student1_name='$name',student1_home='$home',room_flag='$number_student',student1_contact='$contact',student1_image='$image' WHERE floor_room='$floor_room'";
    	   mysqli_query($conn,$sql);
       }
    }

    
?>
<!DOCTYPE html>
<html>
<head>
	<title>Room Booking Page</title>
	<link rel="stylesheet" type="text/css" href="project.css">
	<style type="text/css">
	    body{
	    	background: white;display: block;
	    }
		
		.owner_content{
			margin-left: 200px;background: green;color: black;height: 780px;width: 900px;display: block;visibility: visible;margin-top: 50px;position: absolute;
		}

		.owner_infromation{
			margin-left: 50px;background: red;color: black;height: 600px;width: 390px;display: block;float: left;margin-top: 15px;
		}

		.owner_picture{
			margin-left: 50px;background: red;color: black;height: 400px;width: 350px;display: block;float: right;margin-top: 140px;margin-right: 50px;
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
    <ul id="aa" style="margin-left: 1113px; position: absolute; visibility: visible; margin-top: -96px;padding-top: 37px;list-style: none;">
        <li  class="b"><input type="submit" name="profile_button" value="My Profile" style="width:auto;padding: 19px 21px 18px 20px;background: #3366CC;"></li>
    </ul>
  </form>

  <form action="" method="post">
    <ul id="ab" style="margin-left: 1203px; position: absolute; visibility: visible; margin-top: -96px;padding-top: 37px;list-style: none;">
        <li  class="b"><input type="submit" name="logout_button" value="Logout" style="width:auto; margin-left: 13px;padding: 19px 21px 18px 20px;background: #3366CC;"></li>
    </ul>
  </form>

	
	<div class="owner_content" id="owner_division">
		<div class="show_information">
			<p><strong><i style="margin-left: 200px;margin-bottom: 50px;">If you want to book the room you have to pay <i style="color: red;"> One Month</i> advance rent through <i style="color: red"> bkash</i></i></strong></p>
		</div>


		<div class="owner_infromation">
			<form action="" method="post" enctype="multipart/form-data">
			  <P style="margin-left: 125px;"><strong><i>Student Name</i></strong></p><input type="text" name="o_username" value="<?php echo "";  ?>">
			  <p style="margin-left: 125px;"><strong><i>Student Email:</i></strong></p><input type="text" name="o_email" value="<?php echo "";  ?>">
			  <p style="margin-left: 125px;"><strong><i>Student Contact</i></strong></p><input type="text" name="o_contact" value="<?php echo "";  ?>">
			  <p style="margin-left: 120px;"><strong><i>Student Parmanent Address</i></strong></p><input type="text" name="o_address" value="<?php echo "";  ?>">
			  <p style="margin-left: 125px;"><strong><i>Payment Transection ID</i></strong></p><input type="text" name="transection" value="<?php echo ""; ?>">
              <input type="file" name="pic2" style="margin-left: 180px;margin-top: 75px; position: absolute"/><br>
			  <input type="submit" name="o_update_button" value="Submit" style="margin-left: 380px; margin-top: 75px;position: absolute;">
			</form>
			
		</div>

		<div class="owner_picture">
			<?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $image).'" style="margin-left: 30px;margin-top: 70px;" width="280px" height="250px"/>'; ?>"
		</div>

	</div>

</body>
</html>