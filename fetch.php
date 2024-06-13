<?php
  include_once "db/db.php";
  $id = $_POST['id'];
  $sql = "SELECT vandor.id, vandor.vandor_name, project.project_name FROM project INNER JOIN vandor ON project.id = vandor.project_id  WHERE project.id= '$id'; ";
  $result = mysqli_query($conn,$sql);
 
  $out='';
  while($row = mysqli_fetch_assoc($result)) 
  {   
     $out .=  '<option value="'.$row['id'].'">'.$row['vandor_name']."-" .$row['project_name']."-ID" .$row['id'] .'</option>'; 
  }
   echo $out;
?>