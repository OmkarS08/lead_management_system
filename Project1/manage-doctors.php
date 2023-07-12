<?php
include('./actions/validate_session.php');
include('./includes/main.php'); 

 include('./includes/header.php'); ?>


<h1>Manage Doctors</h1>
    <br/><br/>
    <?php  
           if(isset($_SESSION['add-doctor']))
            {
                echo $_SESSION['add-doctor'];
                unset($_SESSION['add-doctor']);
            } 
            if(isset($_SESSION['delete-doctor']))
            {
                echo $_SESSION['delete-doctor'];
                unset($_SESSION['delete-doctor']);
            } 
    ?>
    <br/>

    <div class="add_doctor">
    <a href="create-doctor.php"><button type="button" class="btn btn-primary" id='Add'>Add Doctor</button></a>
    </div>

    <br/><br/><br/>
    <table class='tbl-full'>
        <tr>
            <th>S.No</th>
            <th>Doctor Name</th>
            <th>Doctor Department</th>
            <th>Doctor clinic</th>
            <th>Actions</th>
        </tr>
        <?php
            $sql = "SELECT * FROM doctors INNER JOIN doctor_department d on doctors.doctor_department = d.doctor_department_id
            INNER JOIN clinic c on doctors.doctor_clinic = c.clinic_id  WHERE doctor_delete !='1'";
            $res = mysqli_query($conn,$sql);

            if($res == TRUE)
            {
                $count = mysqli_num_rows($res);// to get all the rows in in the database
                // if num_rows>0 we have data in database
                if($count>0)
                {
                    $sn=1;
                    while($rows=mysqli_fetch_assoc($res))
                    {
                    // using whileloop to get data as long as we have data in rows

                    //get data
                    $doctor_id =$rows['doctor_id'];
                    $name =$rows['doctor_name'];
                    $department=$rows['doctor_department_name'];
                    $doctor_clinic = $rows['clinic']
                    ?>
                    <tr>
                        <td><?php echo $sn++ ?></td>
                        <td>Dr.<?php echo $name ?></td>
                        <td><?php echo $department ?></td>
                        <td><?php echo $doctor_clinic ?></td>
                        <td> 
                            <a href="<?php echo SITEURL; ?>change-password-user.php?" ><button type="button" class="btn btn-warning">Edit</button></a>
                            <a href= "<?php echo SITEURL; ?>/actions/delete-doctor.php?id=<?php echo $doctor_id ?>" ><button type="button" class="btn btn-danger">Delete</button></a>
                        </td>
                    </tr>
                    <?php
                    }
                

                }
                else
                {
                    echo "We dont have data in database";
                }
            }
            ?>   
    </table>
<?php include('./includes/footer.php'); ?>