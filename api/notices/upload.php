<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Notice.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog Notice object
  $Notice = new Notice($db);
  
  //this is our upload folder 
	$upload_path = './../uploads/';
	
	//Getting the server ip 
	$server_ip = gethostbyname(gethostname());
	
	//creating the upload url 
	$upload_url = 'http://'.$server_ip.'/studentlife_api/api/'.$upload_path; 
	
	//response array 
	$response = array(); 
	  $form_fields = ['user_id','title','content'];
	if(isset($_FILES['image']['name']))
		$image_status = true;
	else
		$image_status = false;
	
	
	if(isset($_POST['group_id'])){
		$post_status = true;
		array_push($form_fields,'access');
		array_push($form_fields,'group_id');
	}
	else
		$post_status = false;
		
		//checking the required parameters from the request 
		if(isset($_FILES['image']['name'])){					
			
			//getting file info from the request 
			$fileinfo = pathinfo($_FILES['image']['name']);
			
			//getting the file extension 
			$extension = $fileinfo['extension'];
			
			//file url to store in the database 
			$file_url = $upload_url . getFileName($Notice) . '.' . $extension;
			
			//file path to upload in the server 
			$file_path = $upload_path . getFileName($Notice) . '.'. $extension; 
			
			//trying to save the file in the directory 
			try{
				//saving the file 
				move_uploaded_file($_FILES['image']['tmp_name'],$file_path);
				//adding the path and name to database 
				// Get raw Noticeed data
				  $data = json_decode(json_encode($_POST));

				
				 
				  foreach($form_fields as $field){
					$Notice->$field = $data->$field;
				   }
				   $Notice->document_path = $file_url;
				// Create Notice
				  if($Notice->create($post_status,$image_status)) {

					$response["error"] = false;
					$response["msg"] = "Notice Created";
					$response["id"] = $Notice->id;	
					$response["title"] = $Notice->title;	
					$response["content"] = $Notice->content;	
					$response["document_path"] = $Notice->document_path;	
				  } else {
					$response["error"] = true;
					$response["msg"] = 'Notice Not Created';    
				  }

					echo json_encode($response);
			//if some error occurred 
			}catch(Exception $e){
				$response['error']=true;
				$response['message']=$e->getMessage();
			}		
			//displaying the response 
			echo json_encode($response);
			
		}else{
			$response['error']=true;
			$response['message']='Please choose a file';
		}
	
	
	/*
		We are generating the file name 
		so this method will return a file name for the image to be upload 
	*/
	function getFileName($Notice){
		$result = $Notice->getCount();
		if($result['count']==0)
			return 1; 
		else 
			return ++$result['count']; 
	}