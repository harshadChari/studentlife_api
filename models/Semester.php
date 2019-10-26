<?php
  class Semester
  {
      // DB stuff
      private $conn;
      private $table = 'semester';

      // Post Properties
      public $id;
      public $user_id;
      public $title;
      public $start_date;
      public $end_date;
      public $status;

      // Constructor with DB
      public function __construct($db)
      {
          $this->conn = $db;
      }

      // Get Semesters by user_id
      public function read()
      {
          // Create query
          $query = '
          SELECT *
          FROM ' . $this->table . ' 
          WHERE user_id = ?';
      
          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Bind ID
          $stmt->bindParam(1, $this->user_id);

          // Execute query
          $stmt->execute();

          return $stmt;
      }

      // Get Single Post
      public function read_single()
      {
          // Create query
          $query = '
          SELECT c.name as category_name, p.id, p.category_id, p.title, p.body, p.author, p.created_at
          FROM ' . $this->table . ' p
          LEFT JOIN
            categories c ON p.category_id = c.id
          WHERE
            p.id = ?
          LIMIT 0,1';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Bind ID
          $stmt->bindParam(1, $this->id);

          // Execute query
          $stmt->execute();

          $row = $stmt->fetch(PDO::FETCH_ASSOC);

          // Set properties
          $this->title = $row['title'];
          $this->body = $row['body'];
          $this->author = $row['author'];
          $this->category_id = $row['category_id'];
          $this->category_name = $row['category_name'];
      }

      // Create Semester
      public function create()
      {
          // set valid fields
          $fields = ['id','user_id','title','start_date','end_date'];
          $form_fields = ['user_id','title','start_date','end_date'];

          // Create query
          $query = '
          INSERT INTO ' . $this->table . ' SET ';

          foreach ($fields as $field) {
              $query.=$field.' = :'.$field;
              if (next($fields)==true) {
                  $query .= ",";
              }
          }

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          foreach ($form_fields as $field) {
              $this->$field = htmlspecialchars(strip_tags($this->$field));
          }

          // DATA BINDING
          // bind non form data
          $this->id = uniqid('', true);
          $stmt->bindParam(':id', $this->id);
     
          // bind form data
          foreach ($form_fields as $field) {
              $stmt->bindParam(':'.$field, $this->$field);
          }

          // Execute query
          if ($stmt->execute()) {
              return true;
          }

          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);

          return false;
      }
  }
