<?php

if(isset($_POST["action"]))
{
 $connect = mysqli_connect("localhost", "root", "", "mega_project");
 $output = '';
 if($_POST["action"] == "class")
 { 
  $query = "SELECT student_id,roll,name FROM students WHERE class_id 
 = '".$_POST["query"]."'";
  $result = mysqli_query($connect, $query);
  $output .= '<option value="">Select Student</option>';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '<option value="'.$row["student_id"].'">'.$row["name"].'</option>';
  }
 }
 echo $output;
}
?>