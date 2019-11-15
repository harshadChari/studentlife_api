<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: Notice');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Notice.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog Notice object
  $Notice = new Notice($db);

  // Get raw Noticeed data
  $data = json_decode(json_encode($_POST));

  $form_fields = ['user_id','title','content'];
 
  foreach($form_fields as $field){
    $Notice->$field = $data->$field;
   }

  // Create Notice
  if($Notice->create()) {

    $response["error"] = false;
    $response["msg"] = "Notice Created";
	$response["id"] = $Notice->id;	
  } else {
    $response["error"] = true;
    $response["msg"] = 'Notice Not Created';    
  }

  echo json_encode($response);

