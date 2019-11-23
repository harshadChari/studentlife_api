<?php
  class User 
  {
      // DB stuff
      private $conn;
      private $table = 'users';

      // Post Properties
      public $unique_id;
      public $email;


      // Constructor with DB
      public function __construct($db)
      {
          $this->conn = $db;
      }

      // Get user by email
      public function read_by_email()
      {
          // Create query
          $query = '
          SELECT *
          FROM ' . $this->table .'
          WHERE ' . $this->table . '.email = ? 
		  LIMIT 0,1';
      
          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Bind ID
          $stmt->bindParam(1, $this->email);

          // Execute query
          $stmt->execute();
		 
          $row = $stmt->fetch(PDO::FETCH_ASSOC);

          $this->unique_id = $row['unique_id'];
      }

      
  }
