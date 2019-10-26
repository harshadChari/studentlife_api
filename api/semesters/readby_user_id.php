<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Semester.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog Semester object
  $Semester = new Semester($db);

  // Get ID
  $Semester->user_id = isset($_GET['user_id']) ? $_GET['user_id'] : die();

  // Blog Semester query
  $result = $Semester->read();
  // Get row count
  $num = $result->rowCount();

  // Check if any Semesters
  if($num > 0) {
    // Semester array
    $Semesters_arr = array();
    // $Semesters_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $Semester_item = array(
        'id' => $id,
        'user_id' => $user_id,
        'title' => $title,
        'start_date' => $start_date,
        'end_date' => $end_date,
        'status' => $status
      );

      // Push to "data"
      array_push($Semesters_arr, $Semester_item);
      // array_push($Semesters_arr['data'], $Semester_item);
    }

    // Turn to JSON & output
    echo json_encode($Semesters_arr);

  } else {
    // No Semesters
    echo json_encode(
      array('message' => 'No Semesters Found')
    );
  }
