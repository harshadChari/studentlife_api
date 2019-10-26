<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: Semester');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Semester.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog Semester object
  $Semester = new Semester($db);

  // Get raw Semestered data
  #$data = json_decode(file_get_contents("php://input"));
  $data = json_decode(json_encode($_POST));

  $form_fields = ['user_id','title','start_date','end_date']; 
 
  foreach($form_fields as $field){
    echo $field.":".$data->$field."\n";
    $Semester->$field = $data->$field;
   }

  // Create Semester
  if($Semester->create()) {
    echo json_encode(
      array('message' => 'Semester Created')
    );
  } else {
    echo json_encode(
      array('message' => 'Semester Not Created')
    );
  }

