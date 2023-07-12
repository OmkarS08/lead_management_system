<?php include('./actions/validate_session.php');
 include('./includes/main.php'); // always include db connection in main.php


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
                if(count($data) <= 17)
                {
                    if ($data[0] =="ID") {
                        continue;   
                        }
                     // Check if the lead already exists in the database
           
                    $check_query = "SELECT leads_id FROM leads WHERE lead_name = '".$data[7]."' ";
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
                         $query = "INSERT INTO leads 
                        (leads_id,lead_date , lead_camp , lead_platform , lead_medical_insurance ,
                         UAE_mob_no ,lead_initials, lead_name,lead_email  ,
                          lead_clinic ,lead_created_time ,
                        call_center_attempt_1_time , call_center_attempt_1_agent_name , call_center_attempt_1_patient_answer ,
                        lead_status ,current_patient_response)
                        VALUES ('$data[0]',curdate(), '$data[2]','$social_media_platform', '$data[4]',
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

    $url_status = $_GET['status'];
        

        if(isset($_POST['submit'])) {

                $filename = $_FILES["file"]["name"];
                echo $filename;
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

        $result_patient_answer_1 = getPatientAnswers($conn); // for drop down filter

include('./includes/header.php');?>

<h1>Manage Leads</h1>
<br/><br/><br/>
    <?php 
        if(isset($_SESSION['lead-add']))
            {
                echo $_SESSION['lead-add'];
                unset($_SESSION['lead-add']);
            }
            if(isset($_SESSION['add-lead']))
            {
                echo $_SESSION['add-lead'];
                unset($_SESSION['add-lead']);
            }
            if(isset($_SESSION['delete-lead']))
            {
                echo $_SESSION['delete-lead'];
                unset($_SESSION['delete-lead']);
            }
        
    ?>

<div class="manage-lead-buttons">
    <a href ="<?php echo SITEURL;?>create-lead.php"><button class='btn btn-primary'>Create Lead</button></a>
    <button class = 'btn btn-success' id='Import-div'>Import Lead</button>
</div>   

<div class="lead-input-container" >
    <form action="manage-lead.php?status=All" method="POST" enctype ='multipart/form-data' id='import_excel_form'>
    <div class="form-group">
        <label>Add file:</label>
        <input type="file" name="file"  class='form-control-file' required >
    </div>
    <input type="submit" value="Import" name="submit" class="btn btn-success">

    </form>
</div>
<script>
  $('.lead-input-container').hide();   
$('#Import-div').click(function(){
    $('.lead-input-container').toggle(500);
})

</script>
<div class ="filter-button-lead-response text-center">
        <h5>lead Response</h5>
        <select name='Patient_answer' id="leadCategory">
            <option value='19'selected  disabled>lead Response</option>
              <?php foreach($result_patient_answer_1 as $result_patient_answer_1){ ?>
              <option value=<?php echo $result_patient_answer_1['lead_response_id'];?>>
              <?php echo $result_patient_answer_1['lead_response_comment']; ?>
              </option>
              <?php }
              ?>
            </select>
</div>

<div class ="filter-buttons text-center">
    <h5>Status</h5>
    <button type='button' class="leadStatusButton btn-white" data-status ="All" >All</button>
    <button type='button' class="leadStatusButton btn-primary" data-status ="Open">Open</button>
    <button type='button' class="leadStatusButton btn-info" data-status ="Working" >Working</button>
    <button type='button' class="leadStatusButton btn-success" data-status ="Booked" >Booked</button>
    <button type='button' class="leadStatusButton btn-warning" data-status ="Not_a_target" >Not a target</button>
    <button type='button' class="leadStatusButton btn-danger" data-status ="Disqualified" >Disqualified</button>
</div>



    
</script>

    
     <table id='tbl' class='tbl-full' >
        <tr>
            <th>S.No</th>
            <th>Date</th>
            <th>Name</th>
            <th>E-mail</th>
            <th>Camp</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
      

     <?php
            if($url_status!= 'All')
            {
            $sql2 = "SELECT * FROM leads WHERE lead_status = '$url_status' AND lead_deleted_flag != 1";
            }
            else
            {
                $sql2 = "SELECT * FROM leads WHERE lead_deleted_flag != 1" ;
            }
            $res2 = mysqli_query($conn,$sql2);

            if($res2 == TRUE)
            {
                $count = mysqli_num_rows($res2);// to get all the rows in in the database
                // if num_rows>0 we have data in database
                if($count>0)
                {
                    $sn=1;
                    while($rows=mysqli_fetch_assoc($res2))
                    {
                    // using whileloop to get data as long as we have data in rows

                    //get data
                    $id =$rows['leads_id'];
                    $date=$rows['lead_date'];
                    $email=$rows['lead_email'];
                    $name=$rows['lead_name'];
                    $camp=$rows['lead_camp'];
                    $status=$rows['lead_status'];
                    ?>
                    <tr>
                        <td><?php echo $sn++ ?></td>
                        <td><?php echo $date ?></td>
                        <td><?php echo $name ?></td>
                        <td><?php echo $email ?></td>
                        <td><?php echo $camp ?></td>
                        <td>
                            <div class='status-field <?php echo $status ?>'>
                                <?php echo $status ?>
                            </div>
                        </td>
                        <td> 
                            <a href="<?php echo SITEURL; ?>lead-info.php?id=<?php echo $id; ?>" ><button type="button" class="btn btn-warning">More Info</button></a>
                        </td>
                    </tr>
                    
                    <?php
                    }}
                    else
                    {
                        echo "<script type='text/javascript'>alert('We dont have Leads in database')</script>";
                    }} 
                   ?>
            </table>


<script>
    $('.leadStatusButton').on('click', function() {
  var status = $(this).data('status');
  fetchLeadInfo(status, $('#leadCategory').val());

});

// Handle lead category filter change
$('#leadCategory').on('change', function() {
  var status = $('.leadStatusButton').data('status');
  fetchLeadInfo(status, $(this).val());
   
});

// Function to fetch lead information based on filter values
function fetchLeadInfo(status, category) {
  // Send an AJAX request to the server with the filter values
  $.ajax({
    url: 'ajax/fetch_table_lead.php', // Replace with your server-side script to fetch lead information
    method: 'POST',
    data: { status: status, category: category },
    success: function(response) {
      // Update the lead information display section with the fetched data
      console.log(response);
      $('#tbl').html(response);
    },
    error: function(xhr, status, error) {
      // Handle error if any
      console.log(error);
    }
  });
}

</script> 


<?php include('./includes/footer.php') ?>