<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Notice.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate  Notice object
  $Notice = new Notice($db);

    // Get ID
    $Notice->id = isset($_GET['id']) ? $_GET['id'] : die();

 

  // Delete Notice
  if($Notice->delete()) {
    echo json_encode(
      array('message' => 'Notice Deleted')
    );
  } else {
    echo json_encode(
      array('message' => 'Notice Not Deleted')
    );
  }

