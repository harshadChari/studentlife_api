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
  $Semester->id = 5;

  $class_vars = get_class_vars(get_class($Semester));

foreach ($class_vars as $name => $value) {
    #echo "$name : $value\n";
    echo $Semester->$name;
}

$Semester->create();