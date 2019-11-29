
<?php
session_start();
$flag='false';

if(!empty($_POST['profile_button'])){
  //code for myprofile button.....................................................................
  header("Location: padmin.php");

}

if(!empty($_POST['logout_button'])){
  //code for logout button........................................................................
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
	<title>This is confarmation page</title>
	<link rel="stylesheet" type="text/css" href="project.css">
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
    <ul id="aa" style="margin-left: 1130px; position: absolute; visibility: visible; margin-top: -96px;padding-top: 37px;list-style: none;">
        <li  class="b"><input type="submit" name="profile_button" value="My Profile" style="width:auto;padding: 19px 21px 18px 20px;background: #3366CC;"></li>
    </ul>
  </form>

  <form action="" method="post">
    <ul id="ab" style="margin-left: 1220px; position: absolute; visibility: visible; margin-top: -96px;padding-top: 37px;list-style: none;">
        <li  class="b"><input type="submit" name="logout_button" value="Logout" style="width:auto; margin-left: 13px;padding: 19px 21px 18px 20px;background: #3366CC;"></li>
    </ul>
  </form>

  
</body>
</html>




<?php  
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "project";
   
      $conn = mysqli_connect($servername, $username, $password, $dbname);

      $sql="SELECT * FROM owner_table_panding";
      $result = mysqli_query($conn, $sql);

      $button_number=-1;
      $button_delete_number=-0.5;
      $button_confarm_array=array();
      $button_delete_array=array();

      $information=array();

      $flag=0;
      $delete_flag="false";
      $confarm_flag="false";

       if (mysqli_num_rows($result) > 0) {
          while($row = mysqli_fetch_assoc($result)) {
          	   $a=$row["owner_name"];
          	   $b=$row["email_id"];
               $c=$row["password"];
               $d=$row["building_name"];
               $e=$row["building_floor_no"];
               $f=$row["room_each_floor"];
               $g=$row["id"];

               echo "<p style=\"margin-left: 500px;margin-top: 20px; color: green\">Owner Name: $a </p>";
               echo "<p style=\"margin-left: 500px;margin-top: 20px; color: green\">Owner Email: $b </p>";
               echo "<p style=\"margin-left: 500px;margin-top: 20px; color: green\">Owner Password: $c </p>";
               echo "<p style=\"margin-left: 500px;margin-top: 20px; color: green\">Owner Building Name: $d </p>";
               echo "<p style=\"margin-left: 500px;margin-top: 20px; color: green\">Number of Floors: $e </p>";
               echo "<p style=\"margin-left: 500px;margin-top: 20px; color: green\">Room each Floor: $f </p>";

               //Code for showing information........................................................................................

               $button_number++;
               $button_delete_number++;
               $button_confarm_value=(string)$button_number;
               //$button_delete_value=(string)$button_delete_number;
               $button_delete_value="d".$button_confarm_value;

               $information[$button_number]=array('owner_name' => $a,'email'=>$b,'password'=>$c,'building_name'=> $d,'building_floor_no'=> $e,'room_each_floor'=>$f );

               $button_confarm_array[$button_number]=$button_confarm_value;
               $button_delete_array[$button_number]=$button_delete_value;

               echo "<form action=\"\" method=\"post\">
  		                     <input type=\"submit\" name=\"$button_confarm_value\" value=\"Confarm\" style=\"margin-left: 700px;margin-top: 5px;\"> 
  		             </form>";


  		         echo "<form action=\"\" method=\"post\">
  		                     <input type=\"submit\" name=\"$button_delete_value\" value=\"Delete\" style=\"margin-left: 393px;margin-top: -40px;\"> 
  		             </form>";
          }
          $flag=1;
          
       }else{
        echo "<p style=\"margin-top: 300px;margin-left: 550px;color: red;\">No Owner Requenst for confarmation</p>";
       }


      for ($i=0,$j=0.5; $i <2 ; $i++,$j++) { 
           $a=(string)$i;
           $b="d".$a;
          if(!empty($_POST[$a]) && $flag==1){
             //This is for confarm button.......................................................................................
              $uname=$information[$i]['owner_name'];
              $email=$information[$i]['email'];
              $house=$information[$i]['building_name'];
              $floor=$information[$i]['building_floor_no'];
              $room=$information[$i]['room_each_floor'];
              $pass1=$information[$i]['password'];

              insert_function_owner($uname,$email,$house,$floor,$room,$pass1);
              //delete code from owner_table_panding.............................................................................
              $sql="DELETE FROM owner_table_panding WHERE building_name='$house'";
              if(mysqli_query($conn,$sql)){
                //echo "successfully deleted from owner_table_panding";
                $delete_flag="false";
                $confarm_flag="true";
                
              }else{
                //echo "something wrong for deletion";
               
              }
              break;
          }else if(!empty($_POST[$b]) && $flag==1){
            //this is for delete button...........................................................................................
              
              $house=$information[$i]['building_name'];

              //delete code from owner_table_panding.............................................................................
              $sql="DELETE FROM owner_table_panding WHERE building_name='$house'";
              if(mysqli_query($conn,$sql)){
                //echo "successfully deleted from owner_table_panding";
                $delete_flag="true";
                $confarm_flag="false";
                
              }else{
                //echo "something wrong for deletion";
                
                
              }
              break;
          }
      }


 function insert_function_owner($uname,$email,$house,$floor,$room,$pass1){
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "project";

      $building_table="";

      for ($i=0; $i <strlen($house) ; $i++) { 
         if($house[$i]==' '){
          $building_table=$building_table."_";        //removing space from the table name.................................
         }else{
          $building_table=$building_table.$house[$i];
         }
      }
      $comment_table=$building_table."_comment";
      $question_table=$building_table."_question";//table name for a building information..................................
      $answer_table=$building_table."_answer";

      $uname="'".$uname."'";
      $email="'".$email."'";
      $house="'".$house."'";
      $ofloor=(int)$floor;
      $oroom=(int)$room;
      $pass1="'".$pass1."'";


      //code for email check...........................................................

     if((strpos($email, "@gmail.com")||strpos($email, "@yeahoo.com"))){
             $conn = mysqli_connect($servername, $username, $password, $dbname);


            $sql="INSERT INTO owner_table(owner_name,email_id,password,building_name)VALUES($uname,$email,$pass1,$house)";
            $sql1="INSERT INTO building_table(building_name,building_floor_no,room_each_floor)VALUES($house,$ofloor,$oroom)";

            if(mysqli_query($conn,$sql) && mysqli_query($conn,$sql1)){

                $_SESSION['flag']='yes';

                 $create="CREATE TABLE $building_table (
                      id INTEGER AUTO_INCREMENT,
                      floor_room VARCHAR(10) NOT NULL,
                      room_flag INTEGER DEFAULT 0,
                      room_rent VARCHAR(50),
                      room_description TEXT,
                      room_image LONGBLOB,
                      student1_name VARCHAR(50),
                      student1_home VARCHAR(50),
                      student1_contact VARCHAR(50),
                      student1_image LONGBLOB,
                      student2_name VARCHAR(50),
                      student2_home VARCHAR(50),
                      student2_contact VARCHAR(50),
                      student2_image LONGBLOB,
                      PRIMARY KEY(id))";

                 if(mysqli_query($conn,$create)){
                        //comment for successfull creation of building table...................................
                 }

                 $create="CREATE TABLE $comment_table (
                      id INTEGER AUTO_INCREMENT,
                      name VARCHAR(50) NOT NULL,
                      comment TEXT NOT NULL,
                      PRIMARY KEY(id)
                    )";

                 if(mysqli_query($conn,$create)){
                        //comment for successful creation of query ans table.....................................
                 }

                 $create="CREATE TABLE $question_table (
                      id INTEGER AUTO_INCREMENT,
                      name VARCHAR(50) NOT NULL,
                      question TEXT NOT NULL,
                      PRIMARY KEY(id)
                    )";

                 if(mysqli_query($conn,$create)){
                        //comment for successful creation of query ans table.....................................
                 }

                 $create="CREATE TABLE $answer_table (
                      id INTEGER NOT NULL,
                      name VARCHAR(50) NOT NULL,
                      answer TEXT NOT NULL
                    )";

                 if(mysqli_query($conn,$create)){
                        //comment for successful creation of query ans table.....................................
                 }

            }
      }

  }
?>

<script type="text/javascript">
    
    var confarm_flag = "<?php echo "$confarm_flag";  ?>";
    var delete_flag= "<?php echo "$delete_flag"; ?>";

    if(confarm_flag=="true"){
      alert("Successfully confarmed");
      location.reload();
    }else if(delete_flag=="true"){
      alert("Successfully deleted");
      location.reload();
    }

  </script>
