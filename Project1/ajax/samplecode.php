// if($res2 == TRUE)
            // {
            //     $count = mysqli_num_rows($res2);// to get all the rows in in the database
            //     // if num_rows>0 we have data in database
            //     if($count>0)
            //     {
            //         $sn=1;
            //         while($rows=mysqli_fetch_assoc($res2))
            //         {
            //         // using whileloop to get data as long as we have data in rows

            //         //get data
            //         $id =$rows['leads_id'];
            //         $date=$rows['lead_date'];
            //         $email=$rows['lead_email'];
            //         $name=$rows['lead_name'];
            //         $camp=$rows['lead_camp'];
            //         $status=$rows['lead_status'];
            //         ?>
            //         <tr>
            //             <td><?php echo $sn++ ?></td>
            //             <td><?php echo $date ?></td>
            //             <td><?php echo $name ?></td>
            //             <td><?php echo $email ?></td>
            //             <td><?php echo $camp ?></td>
            //             <td>
            //                 <div class='status-field <?php echo $status ?>'>
            //                     <?php echo $status ?>
            //                 </div>
            //             </td>
            //             <td> 
            //                 <a href="<?php echo SITEURL; ?>lead-info.php?id=<?php echo $id; ?>" ><button type="button" class="btn btn-warning">More Info</button></a>
            //             </td>
            //         </tr>
                    
            //         <?php
            //         }}
            //         else
            //         {
            //             echo "<script type='text/javascript'>alert('We dont have Leads in database')</script>";
            //         }} 

            echo "<tr>
            <td>$sn++</td>
            <td>$date</td>
            <td>$name</td>
            <td>$email</td>
            <td>$camp</td>
            <td>
                <div class='status-field $status'>
                    $status
                </div>
            </td>
            <td>
                <a href='" . SITEURL . "lead-info.php?id=$id'><button type='button' class='btn btn-warning'>More Info</button></a>
            </td>
        </tr>";
}
} else {
echo "<script type='text/javascript'>alert('We dont have Leads in the database')</script>";
}
