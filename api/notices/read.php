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

  // Get raw Noticeed data
  $data = json_decode(json_encode($_GET));
  $Notice->user_id = $data->user_id;

  // Blog Notice query
  $result = $Notice->read();
  // Get row count
  $num = $result->rowCount();

  // Check if any Notices
  if($num > 0) {
    // Notice array
    $Notices_arr = array();
    // $Notices_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $Notice_item = array(
        'id' => $id,
        'user_id'=>$user_id,
        'title' => $title,
        'content' => $content,
        'document_path' => $document_path,
        'access' => $access,
        'group_id' => $group_id
      );

      // Push to "data"
      array_push($Notices_arr, $Notice_item);
      // array_push($Notices_arr['data'], $Notice_item);
    }

    // Turn to JSON & output
    $response["error"] = false;
    $response["notices"] = $Notices_arr;
    echo json_encode($response);

  } else {
    // No Notices
    $response["error"] = true;
    $response["msg"] = 'No Notices Found';
    echo json_encode($response);
  }
