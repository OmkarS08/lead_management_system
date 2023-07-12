<?include('./validate_session.php');
 include('../includes/main.php');  

 if(isset($_POST['submit'])) {

    $filename = $_FILES["file"]["name"];

//check if file is allowed
if (allowed_file($_FILES["file"]["name"])) {
    //get database connection

    //upload the csv file to database
upload_csv_to_database($_FILES["file"]["tmp_name"], $conn);
    //close database connection

    // redirect to current page
    
} else {
    // handle error
    echo "<script'>alert('Invalid file type. Only CSV and XLSX files are allowed.')</script>";
}
}

 function allowed_file($filename) {
    $allowed_extensions = array('csv', 'xlsx');
    $file_extension = pathinfo($filename, PATHINFO_EXTENSION);
    return in_array($file_extension, $allowed_extensions);   
}
function upload_csv_to_database($file, $conn) {
    // Open the CSV file
    if (($handle = fopen($file, "r")) !== FALSE) {
        // Loop through each row in the CSV file
        
        while (($data = fgetcsv($handle,1000,",")) !== FALSE) {
            if(count($data))
            {
                if ($data[0] =="ID") {
                    continue;   
                    }
                 // Check if the lead already exists in the database
       
                $check_query = "SELECT leads_id FROM leads WHERE lead_name = '".$data[7]."'";
                $check_result = mysqli_query($conn, $check_query);
                $num_rows = mysqli_num_rows($check_result);
                if ($num_rows > 0) {
                    // Lead already exists, skip insertion
                   echo "skipping already present in the lead!";
                    continue;
                } else {
                    $social_media_platform = checkPlatform($data[3]);
                    $lead_clinic = checkBranch($data[9]);
                    $lead_response = checkResponse($data[15]);
                    $lead_agent_id = checkAgent($data[14]);
                    // Lead doesn't exist, insert into the database
                    echo $query = "INSERT INTO leads 
                    (lead_date , lead_camp , lead_platform , lead_medical_insurance ,
                     UAE_mob_no ,lead_initials, lead_name,lead_email  ,
                      lead_clinic ,lead_created_time ,
                    call_center_attempt_1_time , call_center_attempt_1_agent_name , call_center_attempt_1_patient_answer ,
                    lead_status ,current_patient_response)
                    VALUES (curdate(), '$data[2]','$social_media_platform', '$data[4]',
                     '$data[5]' , '$data[6]','$data[7]','$data[8]'
                     ,'$lead_clinic', curtime(),
                     NOW(),'$lead_agent_id','$lead_response',
                     'Open','$lead_response')";
                         //query2   
                                            
                    $res = mysqli_query($conn,$query);
                    if($res==true)
                    {
                        $_SESSION['add-lead']="<div class='text-center success'>User added successfully</div><script> alert('Imported succesfully')</script>    ";
                        header("location:".SITEURL.'manage-lead.php?status=All');
            
                    }
                    else{
                        $Failed_import = 1;
                    }
        }}
        else{
            echo "<script> alert('csv coloums exceeds the database')</script>";
        }
        }
        fclose($handle);
        if($Failed_import == 1)
        {
            echo "alert('Failed To import')";
        }
    }
}


    

  

 ?>