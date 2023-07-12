<?php
include('../includes/main.php');
$status = $_POST['status']; //lead_status
$category = $_POST['category']; //patient_response
$categoryResponse = checkResponseComment($category);

if ($status != 'All') {
    $query = "SELECT * FROM leads WHERE lead_status = '$status' AND current_patient_response = '$category' AND lead_deleted_flag != 1";
} else {
    $query = "SELECT * FROM leads WHERE current_patient_response = '$category' AND lead_deleted_flag != 1";
}

$result = mysqli_query($conn, $query);

$output = " <tr>
<th>S.No</th>
<th>Date</th>
<th>Name</th>
<th>E-mail</th>
<th>Camp</th>
<th>Status</th>
<th>Actions</th>
</tr>";

if($result == true) {
    $sn = 1;
    while ($rows = mysqli_fetch_assoc($result)) {
        // using while loop to get data as long as we have data in rows

        // get data
        $id = $rows['leads_id'];
        $date = $rows['lead_date'];
        $email = $rows['lead_email'];
        $name = $rows['lead_name'];
        $camp = $rows['lead_camp'];
        $status = $rows['lead_status'];

        $output.= "<tr>";

        $output .= "<td>".$sn++."</td>
                    <td>".$date."</td>
                    <td>".$email."</td>
                    <td>".$name."</td>
                    <td>".$camp."</td>
                    <td><div class='status-field ".$status."'>".$status."</div></td>
                    <td><a href='".SITEURL."lead-info.php?id= ".$id."'><button type='button' class='btn btn-warning'>More Info</button></a></td></tr>
                   ";


    }
}
else if($result == false)
{
        $output.= "<tr><td>Data not available</td></tr>";
}
    
    echo $output.=" <tr><i><td colspan='7'><b><i>status = (".$status.") patient Response = (".$categoryResponse.")</i></b> </td></tr>";
?>


    
                
