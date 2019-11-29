<?php
    session_start();
    $building_name=$_SESSION['house_name'];//name of the building.....................
    $user_type=$_SESSION['c_type'];
    $floor_room=$_SESSION['floor_room'];//track floor and room number from previous page..............

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "project";

    $table_name="";
    for ($i=0; $i <strlen($building_name) ; $i++) { 
      if($building_name[$i]==" ")
        $table_name=$table_name."_";
      else
        $table_name=$table_name.$building_name[$i];
    }
   
    $conn = mysqli_connect($servername, $username, $password, $dbname);
   
    //get information from $building_name table..................................................................
     $sql="SELECT * FROM $table_name WHERE floor_room='$floor_room'";

     $image=NULL;
     $a=NULL;
     $b=NULL;

     $result=mysqli_query($conn,$sql);

     if (mysqli_num_rows($result) > 0) {
          while($row = mysqli_fetch_assoc($result)) {
          	   $a=$row["room_description"];
          	   $b=$row["room_rent"];
               $image=$row["room_image"];
               break;   
          }  
       }else{
         $sql="INSERT INTO $table_name (floor_room)VALUES ('$floor_room')";
         mysqli_query($conn,$sql);
       }

     if($a==NULL)$a="Not Available";
     if($b==NULL)$b="Not Available";

    if(!empty($_POST['oo_update_button'])){
       //update code for student table..........................................................................................................
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "project";
   
      $conn = mysqli_connect($servername, $username, $password, $dbname);

      $a=$_POST['b_description'];
      $b=$_POST['building_rent'];
      $image=$_POST['pic2'];


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
        $sql="UPDATE $table_name SET room_description='$a',room_rent='$b' WHERE floor_room='$floor_room'";
      }else{
         $sql="UPDATE $table_name SET room_description='$a',room_rent='$b',room_image='$image' WHERE floor_room='$floor_room'";
      }
      
      if(mysqli_query($conn,$sql)){
      	//echo "Student table is successfully updated";
        header("Location: proom_update.php");
      }else{
      	//echo "Something wrong with the update";
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
	<title>Update Building Information</title>
	<link rel="stylesheet" type="text/css" href="project.css">
	<style type="text/css">
	    body{
	    	background: white;
	    }
		.owner_content{
			margin-left: 200px;background: green;color: black;height: 680px;width: 900px;display: block;visibility: visible;margin-top: 30px;position: absolute;
		}

		.owner_infromation{
			margin-left: 50px;background: red;color: black;height: 400px;width: 390px;display: block;float: left;margin-top: 130px;
		}

		.owner_picture{
			margin-left: 50px;background: red;color: black;height: 400px;width: 350px;display: block;float: right;margin-top: 130px;margin-right: 50px;
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
    <ul id="aa" style="margin-left: 1114px; position: absolute; visibility: visible; margin-top: -96px;padding-top: 37px;list-style: none;">
        <li  class="b"><input type="submit" name="profile_button" value="My Profile" style="width:auto;padding: 19px 21px 18px 20px;background: #3366CC;"></li>
    </ul>
  </form>

  <form action="" method="post">
    <ul id="ab" style="margin-left: 1203px; position: absolute; visibility: visible; margin-top: -96px;padding-top: 37px;list-style: none;">
        <li  class="b"><input type="submit" name="logout_button" value="Logout" style="width:auto; margin-left: 13px;padding: 19px 21px 18px 20px;background: #3366CC;"></li>
    </ul>
  </form>

  <div class="owner_content" id="owner_division">
		<div class="owner_infromation">
			<form action="" method="post" enctype="multipart/form-data">
			  <p style="margin-left: 125px;margin-top: 50px;"><strong><i>Building Description:</i>
			  	  <textarea name="b_description" cols="46" rows="7"  style="margin-left: -125px;margin-top: 30px;"><?php echo $a; ?></textarea><br>
			  <p style="margin-left: 125px;margin-top: 20px;"><strong><i>Rent Cost:</i></strong></p>
			      <input type="text" name="building_rent" value="<?php echo $b;  ?>">
              <input type="file" name="pic2" style="margin-left: 155px;margin-top: 200px; position: absolute"/><br>
			  <input type="submit" name="oo_update_button" value="Save Changes" style="margin-left: 365px; margin-top: 210px;position: absolute;">
			</form>
			
		</div>

		<div class="owner_picture">
			<?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $image).'" style="margin-left: 30px;margin-top: 70px;" width="280px" height="250px"/>'; ?>"
		</div>


</body>
</html>