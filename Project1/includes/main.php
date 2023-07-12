<?php include('db.php');
define('SITEURL','http://localhost/PROJECT1/');
    function convertDate($date_str) {
        $date_timestamp = strtotime($date_str);
        $date_new_format = date('Y/m/d', $date_timestamp);
        return $date_new_format;
    }

    function convertDateTime($date_time){
        $dateTime = date('Y-m-d H:i:s', strtotime($date_time));
        return $dateTime;
    }

    function checkPlatform($platform) {
      $platform_no = 0;
  
      switch ($platform) {
          case 'Instagram':
              $platform_no = 1;
              break;
          case 'Facebook':
              $platform_no = 2;
              break;
          case 'Twitter':
              $platform_no = 3;
              break;
          case 'Email':
              $platform_no = 4;
              break;
          default:
              $platform_no = 5;
              break;
      }
  
      return $platform_no;
    }


    function checkBranch($branch) {
      $count = 0;
  
      switch ($branch) {
          case 'Emirates Hospital Jumerah':
              $count = 1;
              break;
          case 'Emirates Speciality Hospital DHC':
              $count = 2;
              break;
          case 'Emirates Hospital Day Surgery Motor city':
              $count = 3;
              break;
          default:
              $count = NULL;
              break;
      }
  
      return $count;
    }  

    function checkResponse($text) {
      include('db.php');
      // Query the table to find the ID for the specified text
        $query = "SELECT lead_response_id FROM lead_response WHERE lead_response_comment = '$text'";
      $result = mysqli_query($conn, $query);
  
      // Check if the query was successful
      if ($result && mysqli_num_rows($result) > 0) {
          // Fetch the ID from the query result
          $row = mysqli_fetch_assoc($result);
          echo $id = $row['lead_response_id'];
  
          // Return the ID
          return $id;
      }

  
      // Return null if the text was not found
      return 19;
  }
  function checkResponseComment($id) {
    include('db.php');
    // Query the table to find the ID for the specified text
      $query = "SELECT lead_response_comment FROM lead_response WHERE lead_response_id = '$id'";
    $result = mysqli_query($conn, $query);

    // Check if the query was successful
    if ($result && mysqli_num_rows($result) > 0) {
        // Fetch the ID from the query result
        $row = mysqli_fetch_assoc($result);
         $comment = $row['lead_response_comment'];

        // Return the ID
        return $comment;
    }


    // Return null if the text was not found
    return 19;
}
  function CheckAgent($name){
    include('db.php');
    // Query the table to find the ID for the specified text
    $query = "SELECT user_id FROM users WHERE user_name = '$name'";
    $result = mysqli_query($conn, $query);

    // Check if the query was successful
    if ($result && mysqli_num_rows($result) > 0) {
        // Fetch the ID from the query result
        $row = mysqli_fetch_assoc($result);
        echo $id = $row['user_id'];

        // Return the ID
        return $id;
    }


    // Return null if the text was not found
    return null;

  }

  function checkNull($value) {
    if($value){
        return $value;
    }
    else{
        return 'NULL';
    }
}

function getPatientAnswers($conn) {
    $sql_patient_answer = 'SELECT lead_response_id, lead_response_comment FROM lead_response';
    $res_patient_answer = $conn->query($sql_patient_answer);
    
    if ($res_patient_answer->num_rows > 0) {
        $result_patient_answer = mysqli_fetch_all($res_patient_answer, MYSQLI_ASSOC);
        return $result_patient_answer;
    }
    
    return 19; // Return an empty array if no results found
  }
      
    ?>