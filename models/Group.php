<?php
  class Group
  {
      // DB stuff
      private $conn;
      private $table = 'groups';

      // Post Properties
      public $id;
      public $name;
      public $created_at;
      public $user_id;


      // Constructor with DB
      public function __construct($db)
      {
          $this->conn = $db;
      }

      // Get Groups by user_id
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

      // Get Single Group
      public function read_single()
      {
          // Create query
          $query = '
          SELECT *
          FROM ' . $this->table . ' 
          WHERE id = ?';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Bind ID
          $stmt->bindParam(1, $this->id);

          // Execute query
          $stmt->execute();

          $row = $stmt->fetch(PDO::FETCH_ASSOC);

          // Set properties
          $this->id = $row['id'];
          $this->name = $row['name'];
          $this->created_at = $row['created_at'];
          $this->user_id = $row['user_id'];
      }

      // Create Group
      public function create()
      {        
      
          // set valid fields
          $fields = ['id','name','user_id'];
          $form_fields = ['name','user_id'];

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

       // Delete Group
       public function delete()
       {
           // Create query
           $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
 
           // Prepare statement
           $stmt = $this->conn->prepare($query);
 
           // Clean data
           $this->id = htmlspecialchars(strip_tags($this->id));
 
           // Bind data
           $stmt->bindParam(':id', $this->id);
 
           // Execute query
           if ($stmt->execute()) {
               return true;
           }
 
           // Print error if something goes wrong
           printf("Error: %s.\n", $stmt->error);
 
           return false;
       }
  }
