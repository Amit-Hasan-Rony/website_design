<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>
   <p>this is new html code first part</p>
</body>
</html>

<?php
   $o_user="Amit Hasan Rony";
?>

<?php
  if(!empty($_POST['test'])){
  	$a=$_POST['o_username'];
  	echo "$a";
  	/*for ($i=0; $i <10 ; $i++) { 
  		$a=(string)$i;
  		echo "<p style=\"margin-left: 40px\">Ground Floor:=></p>";

  		echo "<form action=\" \" method=\"post\">
  		   <input type=\"submit\" name=\"amit\" value=\"Confarm Owner\" style=\"margin-left: 10px;margin-top: 5px;\"> 
  		      </form>";

  		echo "$a";

  	}*/

    echo "<form action=\"test1.php\" method=\"post\">
  		      <input type=\"submit\" name=\"amit\" value=\"tintin\" style=\"margin-left: 10px;margin-top: 5px;\"> 
  		  </form>";
  }
  if(!empty($_POST['amit'])){
  		echo "I am successful";
  	}else{
  		echo "failour";
  	}

    $arrayName = array();
    $arrayName[0]='Amit';
    $arrayName[1]='Hasan';
    $arrayName[2]='Rony';

    echo $arrayName[1];

    $double_button=0.5;
    $double_button++;
    echo $double_button;
    $double_button++;
    echo $double_button;

    $a=(string)$double_button;
    echo "$a";

    $test_array=array();
    $test_array[0]=array('name' =>"amit" ,'roll'=>"1507088" );
    $test_array[1]=array('name' =>"monny" ,'roll'=>"809" );

    echo $test_array[1]['name'];

    $tin=strlen($a);
    echo "$tin  what is going on???????????????????????????????";
//style=\"background-color:<a style=\"background-color:$room_array['fo1']\"  href=\"$dest_array['fo1']?id=41\"
    /*$servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "project";
   
      $conn = mysqli_connect($servername, $username, $password, $dbname);

    $create="CREATE TABLE tintin (
                      id INTEGER AUTO_INCREMENT,
                      floor_room VARCHAR(10) NOT NULL,
                      room_flag INTEGER DEFAULT 0,
                      room_rent VARCHAR(50),
                      room_description TEXT,
                      room_facilities TEXT,
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
      echo "<P>fox_house table created</P>";
}else{
      echo "<P>fox_house table not created</P>";
}*/

  $amit="piccho  babu";
  echo "$amit";
  
  for ($i=0; $i <strlen($amit) ; $i++) { 
     if($amit[$i]==' '){
      $amit[$i]='_';
     }
  }

  echo "$amit";

  /*if ($_GET['building_tracking']=="Osthaye Nibash") {
     echo "This is in the osthayee nibash!";
  }*/

  $arrayName = array('id' => 1,'roll'=>5 );

  echo $arrayName['id'];

  $arrayName['name']="Amit Hasan Rony";

  echo $arrayName['name'];

  $room_array=array();
  $dest_array=array();

  $amit='red';

  $room_array["fo1"]="jpad";
  $room_array['fo2']='yellow';
  $room_array['fo3']='green';

  $dest_array['fo1']="pproject.php";
  $dest_array['fo1']="pproject.php";
  $dest_array['fo1']="pproject.php";

  
  for ($i=0; $i < 5; $i++) { 
     for ($j=0; $j <3 ; $j++) {
           echo " 
             <div class=\"login\" style=\"margin-left: 20px;margin-top: 20px;\">
             <ul>
               <li><a style=\"background-color:$amit;float: left;\" href=\"pproject.php?id=$amit.'rony'\">Room1</a></li>
               <li><a style=\"background-color:$amit;float: right;\" href=\"pproject.php?id=$amit\">Room2</a></li>
               <li><a style=\"background-color:$amit;float: right;\" href=\"pproject.php?id=$amit\">Room3</a></li>
              </ul>
              </div>
               ";
     }
     break;
  }
$a="f";
  echo $room_array[$a.'o1'];
  echo "alhklahklfhklahfklashfkhaklhklfhaklhfklh";

  if($_GET['id']=='0.1'){
    echo "floor No 0";
    echo "room no 1";
  }

  if($_GET['id']=='0.2'){
    echo "floor No 0";
    echo "room no 2";
  }

  $i=0;

  if($i==0)
    echo "0";
  else if($i==1)
    echo "1";


  echo "<div style=\"margin-left: 25px;margin-top: 25px;\">
                 <p style=\"float:left;color:red;\">question:  1 :   Amit Hasan Rony</p>
                 <p style=\"float:right:color:yellow;\">What is your Name?</p>
            </div>"; 
  	
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
  <style type="text/css">
    .login ul li{
      float: left;padding:20px;list-style: none;text-align: center;height: 100%;padding-top: 1px;
        }
  </style>
  
</head>
<body>
	<div class="">
		<form action="" method="post">
			<P style="margin-left: 125px;"><strong><i>Owner UserName</i></strong></p><input type="text" name="<?php echo "what is going on?" ?>" value="<?php echo "$o_user";  ?>">
				<input type="submit" name="test" value="change save">
		</form>
	</div>
</body>
</html>