<?php
    session_start();
    $building_name=$_SESSION['house_name'];
    $user_type=$_SESSION['c_type'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "project";
   
    $conn = mysqli_connect($servername, $username, $password, $dbname);
   
    //get information from $building_name table................................................................................................
     $sql="SELECT * FROM building_table WHERE building_name='$building_name'";
     $result=mysqli_query($conn,$sql);

     if (mysqli_num_rows($result) > 0) {
          while($row = mysqli_fetch_assoc($result)) {
          	   $a=$row["building_name"];
          	   $b=$row["building_floor_no"];
               $c=$row["room_each_floor"];
               $d=$row["building_description"];
               $image=$row["building_picture"];
               $f=$row["building_rent_cost"];
               $g=$row["building_facilities"]; 
               $id=$row["id"];

               break;   
          }  
       }

     if($d==NULL)$d="Not Available";
     if($f==NULL)$f="Not Available";
     if($g==NULL)$g="Not Available";

    if(!empty($_POST['oo_update_button'])){
       //update code for student table..........................................................................................................
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "project";
   
      $conn = mysqli_connect($servername, $username, $password, $dbname);

      $id=$_SESSION['id'];
      $a=$_POST['building_name'];
      $d=$_POST['b_description'];
      $bb=$_POST['number_floors'];
      $b=(int)$bb;
      $cc=$_POST['number_rooms'];
      $c=(int)$cc;
      $g=$_POST['b_facilities'];
      $f=$_POST['building_rent'];
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
        $sql="UPDATE building_table SET building_name='$a',building_floor_no='$b',room_each_floor='$c',building_description='$d',building_rent_cost='$f',building_facilities='$g' WHERE id=$id";
      }else{
         $sql="UPDATE building_table SET building_name='$a',building_floor_no='$b',room_each_floor='$c',building_description='$d',building_rent_cost='$f',building_facilities='$g',building_picture='$image' WHERE id=$id";
      }
      
      if(mysqli_query($conn,$sql)){
      	//echo "Student table is successfully updated";
        $_SESSION['house_name']=$a;
        header("Location: pupdate_building_information.php");
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
	    	background: black;
	    }
		.owner_content{
			margin-left: 200px;background: green;color: black;height: 880px;width: 900px;display: block;visibility: visible;margin-top: 30px;position: absolute;
		}

		.owner_infromation{
			margin-left: 50px;background: red;color: black;height: 790px;width: 390px;display: block;float: left;margin-top: 15px;
		}

		.owner_picture{
			margin-left: 50px;background: red;color: black;height: 400px;width: 350px;display: block;float: right;margin-top: 170px;margin-right: 50px;
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
			  <P style="margin-left: 125px;"><strong><i>Building Name:</i></strong></p>
			  	  <input type="text" name="building_name" value="<?php echo $a;  ?>">
			  <p style="margin-left: 125px;"><strong><i>Building Description:</i>
			  	  <textarea name="b_description" cols="46" rows="7"  style="margin-left: -125px;"><?php echo $d; ?></textarea><br>
			  <p style="margin-left: 125px;"><strong><i>Number of Floors:</i></strong></p>
			      <input type="text" name="number_floors" value="<?php echo $b;  ?>">
			  <p style="margin-left: 125px;"><strong><i>Number of Rooms in each Floor:</i></strong></p>
			      <input type="text" name="number_rooms" value="<?php echo $c;  ?>">
			  <p style="margin-left: 125px;"><strong><i>Building Facilities:</i></strong></p>
			      <textarea name="b_facilities" cols="46" rows="7"><?php echo $g;  ?></textarea><br>
			  <p style="margin-left: 15px;"><strong><i>Rent Cost(Range between minimum and maximum):</i></strong></p>
			      <input type="text" name="building_rent" value="<?php echo $f;  ?>">
              <input type="file" name="pic2" style="margin-left: 155px;margin-top: -135px; position: absolute"/><br>
			  <input type="submit" name="oo_update_button" value="Save Changes" style="margin-left: 360px; margin-top: 40px;position: absolute;">
			</form>
			
		</div>

		<div class="owner_picture">
			<?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $image).'" style="margin-left: 30px;margin-top: 70px;" width="280px" height="250px"/>'; ?>"
		</div>


</body>
</html>