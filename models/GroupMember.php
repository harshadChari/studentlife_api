<?php
  class GroupMember 
  {
      // DB stuff
      private $conn;
      private $table = 'group_members';

      // Post Properties
      public $user_id;
      public $group_id;
      public $admin_state;


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
          FROM ' . $this->table . ' LEFT JOIN groups ON ' .  $this->table . '.group_id = groups.id
          WHERE ' . $this->table . '.user_id = ?';
      
          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Bind ID
          $stmt->bindParam(1, $this->user_id);

          // Execute query
          $stmt->execute();

          return $stmt;
      }

      

      // add group member
      public function create($adminState = null)
      {        
      
          // set valid fields
          $fields = ['user_id','group_id'];
          $form_fields = ['user_id','group_id'];
		  if($adminState!=null){
			  array_push($fields,'admin_state');
			  array_push($form_fields,'admin_state');
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
           $query = 'DELETE FROM ' . $this->table . ' WHERE user_id = :id AND group_id = :gid';
 
           // Prepare statement
           $stmt = $this->conn->prepare($query);
 
           // Clean data
           $this->id = htmlspecialchars(strip_tags($this->id));
 
           // Bind data
           $stmt->bindParam(':id', $this->user_id);
		   $stmt->bindParam(':gid', $this->group_idg);
 
           // Execute query
           if ($stmt->execute()) {
               return true;
           }
 
           // Print error if something goes wrong
           printf("Error: %s.\n", $stmt->error);
 
           return false;
       }
  }
