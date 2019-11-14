<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Notice.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog Notice object
  $Notice = new Notice($db);

  // Get ID
  $Notice->id = isset($_GET['id']) ? $_GET['id'] : die();

  // Get Notice
  $Notice->read_single();

  // Create array
  $Notice_arr = array(
    'id' => $Notice->id,
    'title' => $Notice->title,
    'content' => $Notice->content,
    'document_path' => $Notice->document_path,
    'access' => $Notice->access,
    'group_id' => $Notice->group_id
  );


  // Make JSON
  print_r(json_encode($Notice_arr));