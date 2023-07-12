<?php
include('../includes/db.php');
$department_id = $_POST['department'];

$sql = "SELECT * FROM doctors WHERE doctor_department = $department_id AND doctor_delete !=1";

$result = mysqli_query($conn,$sql);

$output = "<option value='46' Selected> Select Doctor </option>";

 while($row = mysqli_fetch_assoc($result)){
    $output .= '<option value="' .$row['doctor_id']. '">'.$row['doctor_name'].'</option>';
 } 

 echo $output;
?>