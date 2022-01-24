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
$user_id = 1;
$current_date = date('Y-m-d H:i:s');

if (isset($_POST['Employee_Name'])) 
{
	$Employee_ID = trim($_POST['Employee_ID']);
	$Employee_Name = trim($_POST['Employee_Name']);
	$Employee_No = trim($_POST['Employee_No']);
	$Employee_Mobile = trim($_POST['Employee_Mobile']);
	$Employee_Email = trim($_POST['Employee_Email']);
	$Employee_Gender = trim($_POST['Employee_Gender']);
	$Employee_Roll_ID = $_POST['Employee_Roll_ID'];

	if(!empty($Employee_Roll_ID))
	{
		$Employee_Roll_ID = implode(',', $Employee_Roll_ID);
	}

	$Employee_Department_head = $_POST['Employee_Department_head'];
	$Employee_Password = base64_encode(base64_encode(base64_encode($_POST['Employee_Password'])));
	$Employee_Status = trim($_POST['Employee_Status']);

	if(empty($Employee_Name))
	{
		$response['msg'] = 'Employee Name can not empty!';
	}

	if (!empty($Employee_ID)) 
	{
		// update query take place

		// checking existing employees
		$stmt1 = $db->prepare("SELECT `Employee_ID` FROM `master_employee` WHERE `Employee_No` = '$Employee_No' AND `Employee_Name` = '$Employee_Name' AND Employee_ID != $Employee_ID");
		$stmt1->execute(); 
		$rows = $stmt1->fetchAll();

		if(count($rows) == 0)
		{
			if(empty($response['msg']))
			{
        		$stmt = $db->prepare("UPDATE 
        			`master_employee` SET 
        			`Employee_Name`= '$Employee_Name', 
        			`Employee_Email` = '$Employee_Email' ,
        			`Employee_No` = '$Employee_No' ,
        			`Employee_Mobile` = '$Employee_Mobile', 
        			`Employee_Gender` = $Employee_Gender,
        			`Employee_Status` = '$Employee_Status',
        			`Employee_Password` = '$Employee_Password',
        			`Employee_Roll_ID` = '$Employee_Roll_ID'
        			WHERE `Employee_ID` = $Employee_ID");

			    if ($stmt->execute()) 
			    {
			    	// first delete all records of employee from department head table
			    	$sql_d = "DELETE FROM master_department_head WHERE DH_Head_ID = $Employee_ID";
					// use exec() because no results are returned
					$db->exec($sql_d);

			    	// then insert new row of records in department head table 
					if(!empty($Employee_Department_head) && count($Employee_Department_head) > 0)
			    	{
			    		foreach ($Employee_Department_head as $key => $rec) 
			    		{
			    			$stmt2 = $db->prepare("INSERT INTO 
								`master_department_head`(
								`DH_Department_ID`, 
								`DH_Head_ID`) 
								VALUES (
								$rec, 
								$Employee_ID)");
							$stmt2->execute();
			    		}
			    	}

				    $response['status'] = 'success';
				    $response['msg'] = 'Employee Updated Successfully!';
			    }else{
			    	$response['msg'] = 'Employee not updated! Please try again later!';
			    }
			}
		} else {
			$response['msg'] = 'Employee Already exist!';
		}
	
	}else{

		// insert query take place

		// checking existing employees
		$stmt1 = $db->prepare("SELECT `Employee_ID` FROM `master_employee` WHERE `Employee_No` = '$Employee_No' AND `Employee_Name` = '$Employee_Name' ");
		$stmt1->execute(); 
		$rows = $stmt1->fetchAll();

		if(count($rows) == 0)
		{
			if(empty($response['msg']))
			{
				$stmt = $db->prepare("INSERT INTO 
					`master_employee`(
					`Employee_Roll_ID`, 
					`Employee_No`, 
					`Employee_Name`, 
					`Employee_Gender`, 
					`Employee_Mobile`, 
					`Employee_Email`, 
					`Employee_Password`, 
					`Employee_Created_By`, 
					`Employee_Created_Date`, 
					`Employee_Status`) 
					VALUES (
					'$Employee_Roll_ID', 
					'$Employee_No', 
					'$Employee_Name', 
					$Employee_Gender, 
					$Employee_Mobile, 
					'$Employee_Email', 
					'$Employee_Password', 
					$user_id, 
					'$current_date', 
					'$Employee_Status')");

			    if ($stmt->execute()) 
			    {
			    	$Employee_ID =$db->lastInsertId(); //last inserted eployee id

			    	//  save multiple records of department head 
			    	if(!empty($Employee_Department_head) && count($Employee_Department_head) > 0)
			    	{
			    		foreach ($Employee_Department_head as $key => $rec) 
			    		{
			    			$stmt2 = $db->prepare("INSERT INTO 
								`master_department_head`(
								`DH_Department_ID`, 
								`DH_Head_ID`) 
								VALUES (
								$rec, 
								$Employee_ID)");
							$stmt2->execute();
			    		}
			    	}

				    $response['status'] = 'success';
				    $response['msg'] = 'Employee Added Successfully!';
			    } else {
			    	$response['msg'] = 'Employee not added! Please try again later!';
			    }
			}
		} else {
			$response['msg'] = 'Employee Already exist!';
		}
	}
}
// response in json encoded format.
echo json_encode($response);
?>