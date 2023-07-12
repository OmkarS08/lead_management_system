<?php
include('./validate_session.php');
include('../includes/db.php');

 $attachemt_file = $_GET['tn'];
 $file = $_GET['file'];

if($attachemt_file == '1')
{
    echo $sql = "SELECT attachment_file_1 FROM leads WHERE attachment_file_1 ='$file'";
    $result = mysqli_query($conn, $sql);
    
    $row = mysqli_fetch_assoc($result);
     $file_path = '../uploads/' .$row['attachment_file_1'];

    if(file_exists($file_path))
    {
       
        header("Content-type: application/octet-stream");
        header('Content-description: File Transfer');
        header('Content-disposition: attachment; filename='.basename($file_path));
        header('Expires: 0');
        header('Cache-control: must-revalidate');
        header('Pragma: public');
        header('Content-length: '.filesize('../uploads/' .$row['attachment_file_1']));
        readfile('../uploads/' .$row['attachment_file_1']);

        exit;

    }

}
else if($attachemt_file == '2'){
        echo $sql = "SELECT attachment_file_2 FROM leads WHERE attachment_file_2 ='$file'";
        $result = mysqli_query($conn, $sql);

        $row = mysqli_fetch_assoc($result);
        $file_path = '../uploads/' .$row['attachment_file_2'];

        if(file_exists($file_path))
        {
        
            header("Content-type: application/octet-stream");
            header('Content-description: File Transfer');
            header('Content-disposition: attachment; filename='.basename($file_path));
            header('Expires: 0');
            header('Cache-control: must-revalidate');
            header('Pragma: public');
            header('Content-length: '.filesize('../uploads/' .$row['attachment_file_1']));
            readfile('../uploads/' .$row['attachment_file_1']);

            exit;

        }

        }
else
{
            echo $sql = "SELECT attachment_file_3 FROM leads WHERE attachment_file_3 ='$file'";
            $result = mysqli_query($conn, $sql);

            $row = mysqli_fetch_assoc($result);
            $file_path = '../uploads/' .$row['attachment_file_3'];

            if(file_exists($file_path))
            {
            
                header("Content-type: application/octet-stream");
                header('Content-description: File Transfer');
                header('Content-disposition: attachment; filename='.basename($file_path));
                header('Expires: 0');
                header('Cache-control: must-revalidate');
                header('Pragma: public');
                header('Content-length: '.filesize('../uploads/' .$row['attachment_file_1']));
                readfile('../uploads/' .$row['attachment_file_1']);

                exit;

            }

}

?>