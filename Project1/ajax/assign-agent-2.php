<?php
include('../includes/db.php');
if(isset($_POST['selectedAgentValue'])) {
   $selectedValue = $_POST['selectedAgentValue'];
   $id = $_POST['id'];

  $sql_name = "SELECT user_name FROM users WHERE user_id = '$selectedValue'";
  $res= mysqli_query($conn,$sql_name);
  $rows=mysqli_fetch_assoc($res);
  $name = $rows['user_name'];
  
    
  // Process the selected value as needed

  $sql = "UPDATE leads SET lead_assigned = '$selectedValue' WHERE leads_id = '$id'";
  if (mysqli_query($conn, $sql)) {
  
    // header("location:".SITEURL.'lead-update-agent-info.php?id='.$id);
    echo "$name";
  } else {
    
    // header("location:".SITEURL.'lead-update-agent-info.php?id='.$id);
    echo "Failed";
  }
} else {
  // Handle case where selectedValue parameter is missing
  echo "Invalid request. Selected value is missing.";
}
?>