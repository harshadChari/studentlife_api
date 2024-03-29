<?php
  class Notice
  {
      // DB stuff
      private $conn;
      private $table = 'notices';

      // Post Properties
      public $id;
      public $user_id;
      public $title;
      public $content;
      public $document_path;
      public $access;
      public $group_id;


      // Constructor with DB
      public function __construct($db)
      {
          $this->conn = $db;
      }

      // Get Notices by user_id
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
	  
	   // Get Notices by group_id
      public function read_by_group()
      {
          // Create query
          $query = '
          SELECT *
          FROM ' . $this->table . ' 
          WHERE group_id = ?';
      
          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Bind ID
          $stmt->bindParam(1, $this->group_id);

          // Execute query
          $stmt->execute();

          return $stmt;
      }

	  public function getCount()
      {
          // Create query
          $query = '
          SELECT count(*) as count
          FROM ' . $this->table;
      
          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Bind ID
          $stmt->bindParam(1, $this->group_id);

          // Execute query
          $stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
          return $row;
      }
      // Get Single Notice
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
          $this->user_id = $row['user_id'];
          $this->title = $row['title'];
          $this->content = $row['content'];
          $this->document_path = $row['document_path'];
          $this->access = $row['access'];
          $this->group_id = $row['group_id'];
      }

      // Create Notice
      public function create($post=null,$image = null)
      {      
      
          // set valid fields
          $fields = ['id','user_id','title','content'];
          $form_fields = ['user_id','title','content'];
		  
		  if($post!=null){
			   $extra_fields = ['access','group_id'];
			   foreach ($extra_fields as $ef) {
				 array_push($fields,$ef); 
				 array_push($form_fields,$ef); 
							 
			   }
		  }
		  
		  if($image!=null){
			   array_push($fields,'document_path'); 
				 array_push($form_fields,'document_path'); 
		  }

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
	  
	
	  
	  

       // Delete Notice
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
