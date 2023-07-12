<?php include('../actions/validate_session.php');
include('../includes/main.php'); 
$active_user = $_SESSION['userName'];
$user_id = $_SESSION['user_id'];
$user_clinic = $_SESSION['user_branch'];
$active_user = strtoupper(str_replace('+', ' ', $active_user));

/**********Total Leads************************** */
$sql_total_leads = "SELECT COUNT(*) FROM leads WHERE lead_clinic = $user_clinic";
$res_total_leads = mysqli_query($conn,$sql_total_leads);
$row = mysqli_fetch_row($res_total_leads);
$total_leads = $row[0];

/*************Total New Leads***************************** */
function getLeadCountByStatus($conn, $leadStatus ,$user_id) {
  $sql = "SELECT COUNT(*) AS total_leads FROM leads WHERE lead_status = '$leadStatus' AND lead_clinic = $user_id";
  $result = mysqli_query($conn, $sql);
  
  if ($result && mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      return $row['total_leads'];
  } else {
      return 0;
  }
}
$total_new_leads = getLeadCountByStatus($conn,'new',$user_id);
$total_Working_leads = getLeadCountByStatus($conn,'Working',$user_id);
$total_Contacted_leads = getLeadCountByStatus($conn,'Contacted',$user_id);
$total_Qualified_leads = getLeadCountByStatus($conn,'Qualified',$user_id);
$total_Failed_leads = getLeadCountByStatus($conn,'Failed',$user_id);
/*************Total Instagram Leads***************************** */

function get_platform_leads($platformName, $conn){
  $query = "SELECT COUNT(*) AS lead_count
              FROM leads
              JOIN social_media_platform ON leads.lead_platform = social_media_platform.social_media_platform_id
              WHERE social_media_platform.social_media_platform = '$platformName'";

    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $leadCount = $row['lead_count'];
        return $leadCount;
    } else {
        echo "Error executing query: " . mysqli_error($conn);
        return 0;
    }

}
$Facebook_leads = get_platform_leads('facebook',$conn);
$Intagram_leads = get_platform_leads('instagram',$conn);
$Twitter_leads = get_platform_leads('twitter',$conn);
$Email_leads = get_platform_leads('email',$conn);
$Other_leads = get_platform_leads('Other',$conn);



include('../includes/user-header.php'); ?>
 <?php 
        if(isset($_SESSION['login']))
            {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
            ?>
        
<div class='user-name-container'><h4>HELLO , <?php echo $active_user?></h4></div>
<h1 class='center'>Dashboard</h1>
<div class="dashboard-items">
<div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">Total Leads</h5>
    <p class="card-text "><?php echo $total_leads ?></p>
  </div>
</div>
<div class="card text-white bg-warning mb-3" style="max-width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">New Leads</h5>
    <p class="card-text"><?php echo $total_new_leads ?></p>
  </div>
</div>
<div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">Working Leads</h5>
    <p class="card-text"><?php echo $total_Working_leads ?></p>
  </div>
</div>
<div class="card text-white bg-info mb-3" style="max-width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">Contacted Leads</h5>
    <p class="card-text"><?php echo $total_Contacted_leads ?></p>
  </div>
</div>
<div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">Failed Leads</h5>
    <p class="card-text"><?php echo $total_Failed_leads ?></p>
  </div>
</div>
<div class="card text-white bg-success mb-3" style="max-width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">Qualified Leads</h5>
    <p class="card-text"><?php echo $total_Qualified_leads ?></p>
  </div>
</div>

</div>
<div class='dashboard-graph'>
<div id="donut-example" style="height: 250px;" class='dahboard-pie-graph'></div>  
<div id="bar-example" style="height: 250px;" class='dahboard-line-graph'></div>
<div id="myfirstchart" style="height: 250px;" class='dahboard-line-graph'></div>
</div>


<script>

Morris.Donut({
  element: 'donut-example',
  data: [
    {label: "New Leads", value: <?php echo $total_new_leads ?>},
    {label: "Contacted Leads", value:<?php echo $total_Contacted_leads ?> },
    {label: "Working Leads", value: <?php echo $total_Working_leads ?>},
    {label: "Qualified Leads", value: <?php echo $total_Qualified_leads ?>},
    {label: "Failed Leads", value: <?php echo $total_Failed_leads ?>},
  ]
});

Morris.Bar({
  element: 'bar-example',
  data: [
    { y: 'Facebook', a: <?php echo $Facebook_leads ?> },
    { y: 'Insta', a: <?php echo $Intagram_leads ?> },
    { y: 'Twitter', a: <?php echo $Twitter_leads ?>},
    { y: 'Mail', a: <?php echo $Email_leads ?> },
    { y: 'Other', a: <?php echo $Other_leads ?>},
  ],
  xkey: 'y',
  ykeys: ['a'],
  labels: ['No. of leades']
});
</script>



<?php include('../includes/footer.php'); ?>