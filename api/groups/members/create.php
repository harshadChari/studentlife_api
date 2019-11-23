<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../../config/Database.php';
  include_once '../../../models/GroupMember.php';
  include_once '../../../models/User.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog GroupMember object
  $GroupMember = new GroupMember($db);
  $User = new User($db);

  // Get raw GroupMembered data
  $data = json_decode(json_encode($_POST));
  $User->email = $data->email;
  $User->read_by_email();
  
 
 $GroupMember->user_id = $User->unique_id;
 $GroupMember->group_id = $data->group_id;

  // Create GroupMember
  if($GroupMember->create()) {

    $response["error"] = false;
    $response["msg"] = "GroupMember Created";
	$response["id"] = $GroupMember->user_id;	
  } else {
    $response["error"] = true;
    $response["msg"] = 'GroupMember Not Created';    
  }

  echo json_encode($response);

