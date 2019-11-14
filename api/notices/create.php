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
    echo $field.":".$data->$field."\n";
    $Notice->$field = $data->$field;
   }

  // Create Notice
  if($Notice->create()) {
    echo json_encode(
      array('message' => 'Notice Created')
    );
  } else {
    echo json_encode(
      array('message' => 'Notice Not Created')
    );
  }

