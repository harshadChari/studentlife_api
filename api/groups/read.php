<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/GroupMember.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog GroupMember object
  $GroupMember = new GroupMember($db);

  // Get raw GroupMembered data
  $data = json_decode(json_encode($_GET));
  $GroupMember->user_id = $data->user_id;

  // Blog GroupMember query
  $result = $GroupMember->read();
  // Get row count
  $num = $result->rowCount();

  // Check if any GroupMembers
  if($num > 0) {
    // GroupMember array
    $GroupMembers_arr = array();
    // $GroupMembers_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $GroupMember_item = array(        
        'user_id'=>$user_id,
        'group_id' => $group_id,
        'admin_state' => $admin_state,
		'name'=>$name,
		'created_at'=>$created_at	
      );

      // Push to "data"
      array_push($GroupMembers_arr, $GroupMember_item);
      // array_push($GroupMembers_arr['data'], $GroupMember_item);
    }

    // Turn to JSON & output
    $response["error"] = false;
    $response["groups"] = $GroupMembers_arr;
    echo json_encode($response);

  } else {
    // No GroupMembers
    $response["error"] = true;
    $response["msg"] = 'No GroupMembers Found';
    echo json_encode($response);
  }
