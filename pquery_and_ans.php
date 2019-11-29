<?php
   session_start();

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "project";

    $conn = mysqli_connect($servername, $username, $password, $dbname);


   $a=$_GET['building_tracking'];
   $_SESSION['q_a_table']=$a;
   $building_table="";
   $all_questions=array();
   $all_names=array();
   $all_ids=array();

   for ($i=0; $i < strlen($a); $i++) { 
   	  if($a[$i]==' ')
   	  	$building_table=$building_table."_";
   	  else
   	  	 $building_table=$building_table.$a[$i];
   }

   $question_table=$building_table."_question";
   $answer_table=$building_table."_answer";

   $sql="SELECT * FROM $question_table";

   $result=mysqli_query($conn,$sql);

       if (mysqli_num_rows($result) > 0) {
       	  $i=-1;
          while($row = mysqli_fetch_assoc($result)) {
               $i++;
               $all_questions[$i]=$row['question'];
               $all_names[$i]=$row['name'];
               $all_ids[$i]=$row['id'];
          }
       }

       
   	echo "<div style=\"margin-left: 25px;margin-top: 25px;\">
                 <p style=\"color: red;margin-left: 20px;margin-top:5px;\"><strong style=\"margin-left:0px;\">Question No:</strong><strong style=\"margin-left: 55px;\">User Name<strong style=\"margin-left: 105px;\">Question or Answer</p></br>
            </div>";

   for ($i=0; $i <count($all_ids) ; $i++) {
      //code for showing questions..............................................................
   	  $id=$all_ids[$i];
   	  $question=$all_questions[$i];
   	  $name=$all_names[$i];

      echo "<div style=\"margin-left: 25px;margin-top: 25px;\">
                 <p style=\"color: red;margin-left: 25px;margin-top:5px;\"><strong style=\"margin-left:15px;\">$id</strong><strong style=\"margin-left: 100px;\">$name<strong style=\"margin-left: 80px;\">$question</p></br>
            </div>"; 
   	  $sql="SELECT * FROM $answer_table WHERE id=$id";
   	  $result=mysqli_query($conn,$sql);
   	  $j=0;
   	  if(mysqli_num_rows($result)>0){
   	  	while ($row=mysqli_fetch_assoc($result)) {
   	  		$a=$row['name'];
   	  		$b=$row['answer'];
   	  		echo "<div style=\"margin-left: 150px;margin-top: 10px;\">
                 <p style=\"color: black;margin-left: 20px;margin-top:-35px;\">$a:   $b</p></br>
            </div>"; 

   	  	}
   	  }
   }

   echo "<form action=\"\" method=\"post\">
  		                     <input type=\"submit\" name=\"comment\" value=\"Comment\" style=\"margin-left: 230px;margin-top: 80px;\"> 
  		             </form>";


   echo "<form action=\"\" method=\"post\">
  		                     <input type=\"submit\" name=\"question_ans\" value=\"Question/Ans\" style=\"margin-left: 545px;margin-top: -28px;\"> 
  		             </form>";

   if (!empty($_POST['question_ans'])) {
   	  header("Location: pquestion_ans1.php");
   }else if(!empty($_POST['comment'])){
   	 header("Location: pcomment.php");
   }
?>

