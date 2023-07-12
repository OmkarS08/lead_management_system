<?php  
include('./actions/validate_session.php');
include('./includes/main.php'); 

$id = $_GET['id'];


include('./includes/header.php');

?>

<div class='leads-buttons-holder'>
  <a href="lead-info.php?id=<?php echo $id; ?>"><button class ='btn btn-info'> Back</button></a>
  <a href="lead-update-info.php?id=<?php echo $id; ?>"><button class ='btn btn-primary' >Lead Personal Info</button></a>
  <a href="lead-update-agent-info.php?id=<?php echo $id; ?>"><button class ='btn btn-primary'>Lead Agent info</button></a>
  <a href="lead-update-attachment.php?id=<?php echo $id; ?>"><button class ='btn btn-primary' disabled>Attachments</button></a>
</div>

<h1>Lead Attachments</h1>

<form action='actions/lead-update-attachment-action.php?id=<?php echo $id ?>'  method="post" enctype="multipart/form-data">
<table class='tbl-full'>
  <tr>
    <th>  <label for="Attachment-file-1">Attachment file 1 <small>only .pdf</small></label></th>
    <th>  <label for="Attachment-file-2">Attachment file 2 <small>only .pdf </small></label></th>
    <th>  <label for="Attachment-file-3">Attachment file 3 <small>only .pdf </small> </label></th>
  </tr>
  <tr>
    <td> <input type="file" class="form-control" id="Attachment-file-1"  value='Import' name="Attachment_file_1"></td>
    <td> <input type="file" class="form-control" id="Attachment-file-2"  value='Import' name="Attachment_file_2"> </td>
    <td> <input type="file" class="form-control" id="Attachment-file-3"  value='Import' name="Attachment_file_3"></td>
  </tr>
</table>

<div class='update-button'>
  <button type='submit' class="btn btn-success" name ='update-button'>Update</button>
</div>
</form>














<?php include('./includes/footer.php'); ?>