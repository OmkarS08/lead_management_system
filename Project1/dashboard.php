<?php include('./actions/validate_session.php');
include('./includes/main.php'); 
$active_user = $_SESSION['userName'];
$active_user = strtoupper(str_replace('+', ' ', $active_user));

/**********Total Leads************************** */
$sql_total_leads = "SELECT COUNT(*) FROM leads";
$res_total_leads = mysqli_query($conn,$sql_total_leads);
$row = mysqli_fetch_row($res_total_leads);
$total_leads = $row[0];

/*************Total New Leads***************************** */
function getNewLeadsCount($conn, $leadStatus) {
  $sql_new_leads = "SELECT COUNT(*) AS total_leads FROM leads WHERE lead_status = '$leadStatus'";
  $res_new_leads = mysqli_query($conn, $sql_new_leads);
  $row = mysqli_fetch_assoc($res_new_leads);
  $total_new_leads = $row['total_leads'];
  return $total_new_leads;
}

$total_open_leads = getNewLeadsCount($conn,'Open');
$total_Working_leads = getNewLeadsCount($conn,'Working');
$total_Booked_leads = getNewLeadsCount($conn,'Booked');
$total_Not_a_target_leads = getNewLeadsCount($conn,'Not_a_target');
$total_Disqualified_leads = getNewLeadsCount($conn,'Disqualified');


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



include('./includes/header.php'); ?>
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
<div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">Open Leads</h5>
    <p class="card-text"><?php echo $total_open_leads ?></p>
  </div>
</div>
<div class="card text-white bg-info mb-3" style="max-width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">Working Leads</h5>
    <p class="card-text"><?php echo $total_Working_leads ?></p>
  </div>
</div>
<div class="card text-white bg-success mb-3" style="max-width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">Booked Leads</h5>
    <p class="card-text"><?php echo $total_Booked_leads ?></p>
  </div>
</div>
<div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">Disqualified Leads</h5>
    <p class="card-text"><?php echo $total_Disqualified_leads ?></p>
  </div>
</div>
<div class="card text-white bg-warning mb-3" style="max-width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">Not a target</h5>
    <p class="card-text"><?php echo $total_Not_a_target_leads ?></p>
  </div>
</div>

</div>
<div class='dashboard-graph'>
<div id="donut-example" style="height: 250px;" class='dahboard-pie-graph'></div>  
<div id="bar-example" style="height: 250px;" class='dahboard-line-graph'></div>

</div>


<script>


Morris.Donut({
  element: 'donut-example',
  data: [
    {label: "Open Leads", value: <?php echo $total_open_leads ?>},
    {label: "Working Leads", value:<?php echo $total_Working_leads ?> },
    {label: "Booked", value: <?php echo $total_Booked_leads ?>},
    {label: "Disqualified Leads", value: <?php echo $total_Disqualified_leads ?>},
    {label: "Not a target", value: <?php echo $total_Not_a_target_leads ?>},
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
  labels: ['No. of leades'],
  horizontal: true
  
});
</script>





<?php include('./includes/footer.php'); ?>