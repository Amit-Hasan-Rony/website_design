<?php
  session_start();
  if(!empty($_POST['logout_button'])){
    $_SESSION['loginflag']="false";

    header("Location:Osthayee Nibash.php");
  }

?>


<?php

$placeholder="I dont know what will happen next time.This is the place you can insert something int database.";
$floor_room=$_GET['id'];
$floor_room="'".$floor_room."'";

$servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "amit";

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    $action_flag=0;

$sql="SELECT * FROM osthayee_room WHERE floor_room=$floor_room";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0){
	$action_flag=1;
}else{
	//code for insertion:................................................................
	$action_flag=0;
	$sql="INSERT INTO osthayee_room(floor_room)VALUES($floor_room)";
	if(mysqli_query($conn,$sql)){
		//echo "Insert Successfully";
	}else{
		//echo "Insertion failed.";
	}
}

if($action_flag==0){
	///code for insertion;
	
}else{
	//code for update;
	$servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "amit";

    $floor_room=$floor_room;
    $room_flag="";
    $room_rent="";
    $room_description="";
    $room_facilities="";
    $room_image="";
    $student_name="";
    $student_home="";
    $student_contact="";
    $student_image="";

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    
    if(!empty($_POST['submit1'])){
    	$room_description=$_POST['text1'];
    	$room_description="'".$room_description."'";

    	$sql="UPDATE osthayee_room SET room_description=$room_description WHERE floor_room=$floor_room";
    	//echo $sql;
        if(mysqli_query($conn,$sql)){
        }else{
        }
    }

    if(!empty($_POST['picture1'])){
    	$image=addslashes(file_get_contents($_FILES['pic1']['tmp_name']));
        $image_size=getimagesize($_FILES['pic1']['tmp_name']);


        if(!$image_size){
    	    echo "<p>Selected File is not an image</p>";
       }else{

            $sql= "UPDATE osthayee_room SET room_image='$image' WHERE floor_room=$floor_room";

            if(mysqli_query($conn,$sql)){
                  $lastid=mysql_insert_id();
            }else{
            }
        
        }
    }

    if(!empty($_POST['submit2'])){
    	$room_facilities=$_POST['text2'];
    	$room_facilities="'".$room_facilities."'";

    	$sql="UPDATE osthayee_room SET room_facilities=$room_facilities WHERE floor_room=$floor_room";
        if(mysqli_query($conn,$sql)){
        }else{
        }
    }

    if(!empty($_POST['rent_room'])){
    	$room_rent=$_POST['rent_cost'];
    	$room_rent="'".$room_rent."'";

    	$sql="UPDATE osthayee_room SET room_rent=$room_rent WHERE floor_room=$floor_room";
        if(mysqli_query($conn,$sql)){
        }else{
        }
    }


    if(!empty($_POST['student1_submit'])){
         $s_name=$_POST['name1'];
         $s_town=$_POST['home_town1'];
         $s_cont=$_POST['contact1'];

         $s_name="'".$s_name."'";
         $s_town="'".$s_town."'";
         $s_cont="'".$s_cont."'";

         $sql="UPDATE osthayee_room SET student_name=$s_name,student_home=$s_town,student_contact=$s_cont,room_flag=1 WHERE floor_room=$floor_room";
         if(mysqli_query($conn,$sql)){
        }else{
        }
    }


    if(!empty($_POST['picture2'])){
        echo "What is going on?";

    	$image=addslashes(file_get_contents($_FILES['amit1']['tmp_name']));
        $image_size=getimagesize($_FILES['amit1']['tmp_name']);


        if(!$image_size){
    	    echo "<p>Selected File is not an image</p>";
       }else{

            $sql= "UPDATE osthayee_room SET student_image='$image' WHERE floor_room=$floor_room";;

            if(mysqli_query($conn,$sql)){
                  $lastid=mysql_insert_id();
            }else{
            }
        
        }
    }
    

}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Osthayee Nibash Green Room</title>
	<link rel="stylesheet" type="text/css" href="project.css">

    <style type="text/css">
    	body{
    		background-color: #018B67;
    	}

    	.room_description{
    		width: 100%;height: 400px;background: #826145;display: block;overflow: hidden;
    	}

    	.description{
    		width: 50%;height:400px;background-color: #826145;display: block;overflow: hidden;float: left;  
    	}

    	.picture1{
    		width: 50%;height: 400px;background-color: #826145;display: block;overflow: hidden;float: right;position: absolute;margin-left: 750px;margin-top: 235px;
    	}


        .room_facilities{
    		width: 100%;height: 400px;background: #826145;display: block;overflow: hidden;
    	}

    	.facilities{
    		width: 50%;height:400px;background-color: #826145;display: block;overflow: hidden;float: left;  
    	}

    	.picture2{
    		width: 50%;height: 400px;background-color: #826145;display: block;overflow: hidden;float: right;
    	}

    	.rentcost_owner{
    		width: 100%;height: 300px;background-color: #826145;display: block;overflow: hidden;
    	}

    	.rentcost{
            width: 50%;height: 200px;background-color: #826145;display: block;overflow: hidden;float: left;margin-top: 160px;
    	}

    	.owner{
    		width: 50%;height: 200px;background-color: #826145;display: block;overflow: hidden;float: right;margin-top: 75px;
    	}




    	.student{
    		width: 100%;height: 900px;background-color: #826145;display: block;overflow: hidden;
    	}

    	.s1_information{
    		width: 100%;height: 450px;background-color: #826145;display: block;overflow: hidden;margin-top: 77px;
    	}

    	.info1{
    		width: 50%;height: 250px;background-color: #826145;display: block;overflow: hidden;float: left;margin-left: 30px;
    	}

    	.sp1{
    		width: 50%;height: 250px;background-color: #826145;display: block;overflow: hidden;float: right;position: absolute;margin-left: 657px;margin-top: -357px;
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
		</ul>
	</div>


	<form action="" method="post">
    <ul id="aa" style="margin-left: 1113px; position: absolute; visibility: hidden; margin-top: -96px;padding-top: 37px;list-style: none;">
        <li  class="b"><input type="submit" name="profile_button" value="My Profile" style="width:auto;padding: 19px 21px 18px 20px;background: #3366CC;"></li>
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


     <div class="room_description">

     	<div class="description">
     		<h2 style="margin-left: 195px;margin-top: 41px;position: absolute;">Room Description</h2>
     		<form action="" method="post" enctype="multipart/form-data" style="margin-left: 45px;margin-top: 101px;position: absolute">
     	        <textarea name="text1" cols="60" rows="7" placeholder="<?php echo $placeholder; ?>"></textarea><br>
     	        <input type="submit" name="submit1" value="Upload" style="margin-left: 192px;margin-top: 37px">
     		</form>	
     	</div>

     	<div class="picture1">
     		<img src="images/greenroom.png" alt="this is the image" width="350px" height="275px">
     		<form action="" method="post" enctype="multipart/form-data">
     		    <input type="file" name="pic1" style="margin-left: 404px;margin-top: -153px; position: absolute"/><br>
     		    <input type="submit" name="picture1" value="submit" style="margin-left: 460px;margin-top: -136px;position: absolute">
     		</form>
     		
     	</div>
     	
     </div>

     <div class="room_facilities">
     	
     	<div class="facilities">
     		<h2 style="margin-left: 195px;margin-top: 41px;position: absolute;">Room Facilities</h2>
     		<form action="" method="post" enctype="multipart/form-data" style="margin-left: 45px;margin-top: 101px;position: absolute">
     	        <textarea name="text2" cols="60" rows="7" placeholder="<?php echo $placeholder; ?>"></textarea><br>
     	        <input type="submit" name="submit2" value="Upload" style="margin-left: 192px;margin-top: 37px">
     		</form>
     	</div>

     </div>

        <div class="rentcost_owner">
     	   <div class="rentcost">
     	   <h2 style="margin-left: 100px;position: absolute;display: block;margin-top: -40px;color: red">Rent Cost</h2>
     	   <form action="" method="post">
     	   	  <input type="text" name="rent_cost" placeholder="5000TK" style="width: 50%;margin-left: 20px"><br>
     	      <input name="rent_room" value="Change" style="margin-left: 120px;" type="submit">
     	   </form>
        </div>

        <div class="owner">
        	<h2 style="margin-left: 250px;position: absolute;display: block;margin-top: 11px;color: red">Owner Information</h2>
        	<p style="margin-left: 275px;margin-top: 75px">Name:amit hasan rony</p>
        	<p style="margin-left: 270px">Contact:01551811949</p>
        	<p style="margin-left: 275px">Address:hkghaskhs khaklfh skdgkhasi kajklfhk.</p>
        </div>

     </div>


     <div class="student1">
     	
     	<div class="s1_information">
     		<h2 style="margin-left: 570px;margin-top: 10px;margin-bottom: 50px">Student's Information</h2>
     		<div class="info1">
     			<form action="" method="post" enctype="multipart/form-data">
     				<label for="name">Enter Student Name</label>
     			    <input type="text" name="name1">

     			    <label for="home_town1">Enter Home Town</label>
     			    <input type="text" name="home_town1">

     			    <label for="contact1">Enter Contact Number</label>
     			    <input type="text" name="contact1">

     			    <input name="student1_submit" value="Upload Student Information" style="margin-left: -463px;margin-top: 97px;position: absolute;" type="submit">
     		    </form>
     		</div>
        </div>

     	<div class="sp1">
            <img src="images/greenroom.png" alt="Image Of Student" style="margin-left: 194px;margin-top: 60px;" width="200px" height="150px">
     		<form accept="" method="post" enctype="multipart/form-data">
     			<input name="amit1" style="margin-left: 445px;margin-top: -83px;position: absolute" type="file">
     			<input name="picture2" value="upload picture" style="margin-left: 498px;margin-top: -43px;position: absolute" type="submit">
     		</form>
     	</div>	

     </div>


<script>
    
    var flag = "<?php echo $_SESSION['loginflag']; ?>";

     if(flag==="true"){
         document.getElementById("aa").style.visibility="visible";
         document.getElementById("ab").style.visibility="visible";
         
     }else{
         document.getElementById("aa").style.visibility="hidden";
         document.getElementById("ab").style.visibility="hidden";
     }
</script>

</body>
</html>