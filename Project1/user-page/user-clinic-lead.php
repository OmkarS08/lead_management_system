<?php include('../includes/main.php');
include('../actions/validate_session.php');
$user_branch = $_SESSION['user_branch'];
$url_status =$_GET['status'];
include('../includes/user-header.php');
$sql_clinic_name = "SELECT clinic FROM clinic WHERE clinic_id = '$user_branch'";
$res= mysqli_query($conn,$sql_clinic_name);
$rows=mysqli_fetch_assoc($res);

$clinic_name = $rows['clinic'];

?>
<h1>Clinic Leads</h1>
<div class='clinic-name-container'>
    <h1><?php echo $clinic_name ?></h1>
</div>

<div class ="filter-buttons text-center">
    <h5>Status</h5>
    <a href= "<?php echo SITEURL; ?>user-page/user-clinic-lead.php?status=<?php echo 'All';?>"><button class="btn-white">All</button></a>
    <a href= "<?php echo SITEURL; ?>user-page/user-clinic-lead.php?status=<?php echo 'New';?>"><button class="btn-primary">New</button></a>
    <a href= "<?php echo SITEURL; ?>user-page/user-clinic-lead.php?status=<?php echo 'Working'; ?>"><button class="btn-info">Working</button></a>
    <a href= "<?php echo SITEURL; ?>user-page/user-clinic-lead.php?status=<?php echo 'Contacted'; ?>"><button class="btn-warning">Contacted</button></a>
    <a href= "<?php echo SITEURL; ?>user-page/user-clinic-lead.php?status=<?php echo 'Qualified'; ?>"><button class="btn-success">Qualified</button></a>
    <a href= "<?php echo SITEURL; ?>user-page/suser-clinic-lead.php?status=<?php echo 'Failed'; ?>"><button class="btn-danger">Failed</button></a>
</div>


<table class='tbl-full'>
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
            $sql2 = "SELECT * FROM leads WHERE lead_status = '$url_status'";
            }
           else
            {
                $sql2 = "SELECT * FROM leads WHERE lead_clinic = '$user_branch'" ;
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
                            <a href="<?php echo SITEURL; ?>/user-page/user-lead-info.php?id=<?php echo $id; ?>" ><button type="button" class="btn btn-warning">More Info</button></a>
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

















<?php include('../includes/footer.php'); ?>