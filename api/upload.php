<?php
date_default_timezone_set('Asia/Kolkata');
header('Content-Type: application/json');
require_once '../include/database.php';
$database = new Database(); //object created for database class
$db = $database->getConnection();

// variable initialization
$response = array();
$response['status'] = 'error';
$response['msg'] = '';
$userID = 1;
$status = 1;

if (!empty($_FILES['files']) && $_FILES['files']['error'] == 0) {
	$file = trim($_FILES['files']['name']);
	$parts = explode('.',$file);
	$fileName = ucwords($parts[0]);
	$tmpName = trim($_FILES['files']['tmp_name']);
	$fileSize = $_FILES['files']['size'];
	$extension = end($parts);
	$allowedExts = ['pdf'];

	//file type pdf validation
	if (($_FILES["files"]["type"] != "application/pdf") && in_array($extension, $allowedExts)){
		$response['msg'] .= '<li> Not Valid File Type! Please upload only pdf files!</li>';
	}

	//2 MB file size validation
	if ($_FILES["files"]["size"] >= 2097152){
		$response['msg'] .= '<li> File size is more than 2 MB. </li>';
	}

	if(empty($response['msg'])){
		// check existing doc
		$stmt1 = $db->prepare("SELECT `file_name` FROM `documents` WHERE `file` = '$file'");
		$stmt1->execute(); 
		$rows = $stmt1->fetchAll();

		if(count($rows) == 0){
			if(move_uploaded_file($tmpName, "../assets/uploads/".$file)){
			 	$stmt = $db->prepare("INSERT INTO `documents` (`file`, `file_name`, `status`, `created_by`) VALUES ('$file', '$fileName', $status, $userID)");
			    if ($stmt->execute()) 
			    {
				    $response['status'] = 'success';
				    $response['msg'] = 'Document Added Successfully!';
			    } else {
			    	unlink("../assets/uploads/".$file);
			    	$response['msg'] = 'Document not added! Please try again later!';
			    }
			} else {
			 	$response['msg'] = "Problem uploading file";
			}
		} else {
			$response['msg'] = 'Document Already exist!';
		}
	}
}
// response in json encoded format.
echo json_encode($response);
?>