<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: Group');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Group.php';  
  include_once '../../models/GroupMember.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog Group object
  $Group = new Group($db);

  // Get raw Grouped data
  $data = json_decode(json_encode($_POST));

  $form_fields = ['name','user_id'];
 
  foreach($form_fields as $field){
    $Group->$field = $data->$field;
   }

  // Create Group
  if($Group->create()) {
	  
	  $GroupMember = new GroupMember($db);
	  $GroupMember->user_id = $data->user_id;
	  $GroupMember->group_id = $Group->id;
	  $GroupMember->admin_state = 1;
	  if($GroupMember->create(true)){
		$response["extra_msg"] = "Group member Created";  
	  }	  

    $response["error"] = false;
    $response["msg"] = "Group Created";
	$response["id"] = $Group->id;	
  } else {
    $response["error"] = true;
    $response["msg"] = 'Group Not Created';    
  }

  echo json_encode($response);

